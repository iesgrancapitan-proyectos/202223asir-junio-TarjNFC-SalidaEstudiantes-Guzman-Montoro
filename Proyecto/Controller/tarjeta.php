<?php

require_once 'model/tarjeta.php';
require_once 'model/usuario.php';

class TarjetaController
{
    public $page_title;
    public $page_error;
    public $page_success;
    public $view;

    public function __construct()
    {
        $this->view = 'login_principal';
        $this->tarjetaObj = new Tarjeta();
        $this->usuarioObj = new Usuario();
    }

    /**
     * Formulario de insertar tarjeta
     */
    public function form()
    {
        if (isset($_SESSION['idTarjeta'])) {
            return $this->login();
        }
        $this->page_title = 'INSERTE TARJETA';
    }

    /**
     * Realizar login y redireccionar a la zona según idPerfil
     */
    public function login(): void
    {
        if ((!isset($_POST["idTarjeta"]) || !is_numeric($_POST["idTarjeta"])) && !isset($_SESSION['idTarjeta'])) {
            $this->view = 'login_principal';
            $this->page_title = 'INSERTE TARJETA';
            $this->page_error = 'Introduce un número correcto';
            return;
        }
        try {
            $user = $this->tarjetaObj->login($_POST);
        } catch (\Throwable $th) {
            $this->view = 'login_principal';
            $this->page_title = 'INSERTE TARJETA';
            $this->page_error = $th->getMessage();
            return;
        }
        if ($user === '') {
            $this->view = 'login_principal';
            $this->page_title = 'INSERTE TARJETA';
        } else {
            if ($this->usuarioObj->isAdmin($user['idUsuario'])) {
                $this->view = 'index_admin';
                $this->page_title = 'ADMINISTRACIÓN';
            } else {
                $this->getPerfilView($user['idPerfil']);
            }
        }
        $_GET["response"] = true;
    }


	public function permiso_salida(){
            $this->profesor = $_SESSION['user']['email'];
            $this->idTarjeta = $_POST['idTarjeta'];
            if ($this->idTarjeta){
                $nieAlumno = $this->tarjetaObj->comprobarUserBano($this->idTarjeta);
                // Comprobar si se encontr   un registro para la tarjeta RFID
                if ($nieAlumno["nie"] !== NULL) {
                    $tiempo = $this->tarjetaObj->permiso_salida_tiempo($this->idTarjeta);
                    $mayoredad = $this->tarjetaObj->comprobarmayoredad($this->idTarjeta);
                    
                    if ($mayoredad == "no"){
                        // Mostrar un mensaje de error en la pantalla del m  vil
                        $this->view = 'permiso_salida_no';
                        $this->page_title = 'CONSERJE';
                    } 
                    
                    else {
                        // Obtener la fecha actual
                    // Obtener la hora actual en formato "H:i:s"
                    $horaActual = date("H:i:s");

                    // Convertir la hora de la variable y la hora actual en segundos
                    $segundosVariable = strtotime($tiempo);
                    $segundosActual = strtotime($horaActual);

                    // Calcular la diferencia en segundos
                    $diferenciaSegundos = $segundosVariable - $segundosActual;
                    if (abs($diferenciaSegundos) < (30 * 60)) {
                        // Mostrar un mensaje de error indicando que se debe esperar antes de presentar la tarjeta de nuevo
                        $this->view = 'permiso_salida_no_tiempo';
                        $this->page_title = 'CONSERJE';
                    } else {
                        // Actualizar la base de datos con el nuevo tiempo de presentaci  n
                        $update = $this->tarjetaObj->permiso_salida_update($this->idTarjeta);
                        if ($update === true) {
                            if ($mayoredad == NULL){
                                $url = "http://cpd.iesgrancapitan.org:9280/api.php?nie={$nieAlumno['nie']}&profe=$this->profesor&consulta=2";
                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_URL, $url);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                                curl_setopt($curl, CURLOPT_HTTPGET, true);
                                $data = curl_exec($curl);
                                $data = substr($data, 1, -1);
                                $fecha_nacimiento = substr($data,0,10);

                                // Obtener la fecha de nacimiento del cliente
                                $hoy =  date('Y-m-d');
                                // Convertir las fechas en timestamps
                                $timestamp_hoy = strtotime($hoy);
                                $timestamp_nacimiento = strtotime($fecha_nacimiento);

                                // Calcular la diferencia en segundos entre las dos fechas
                                $diferencia_segundos = $timestamp_hoy - $timestamp_nacimiento;

                                // Calcular la edad en años
                                $edad = floor($diferencia_segundos / (365 * 24 * 60 * 60));
                                // Comprobar si el cliente es mayor de edad
                                if ($edad >= 18) {
                                    $mayoredadsi = $this->tarjetaObj->mayoredadsi($this->idTarjeta);
                                    // Mostrar un mensaje de   xito en la pantalla del m  vil
                                    $this->view = 'permiso_salida_si';
                                    $this->page_title = 'CONSERJE';
                                } else {
                                    $mayoredadno = $this->tarjetaObj->mayoredadno($this->idTarjeta);
                                    // Mostrar un mensaje de error en la pantalla del m  vil
                                    $this->view = 'permiso_salida_no';
                                    $this->page_title = 'CONSERJE';
                                }
                            }
                            elseif ($mayoredad == "si"){
                                // Mostrar un mensaje de   xito en la pantalla del m  vil
                                $this->view = 'permiso_salida_si';
                                $this->page_title = 'CONSERJE';
                            }
                        }
                    }
                }   
                } else {
                    $this->view = 'salida_recreo';
                    $this->page_title = 'CONSERJE';
                    $this->page_error = 'Introduce una tarjeta valida';
                 }
            
            } else {
                $this->view = 'salida_recreo';
                $this->page_title = 'CONSERJE';
                $this->page_error = 'Introduce una tarjeta valida';
            }
        }




	public function salidaRecreo()
    {
        $this->conserje = $_SESSION['user']['email'];
        $this->view = 'salida_recreo';
        $this->page_title = 'Salida Recreo';
    }


    public function logout()
    {
        session_unset();
        session_destroy();
        $this->view = 'login_principal';
        $this->page_title = 'INSERTE TARJETA';
    }

    /**
     * Función que determina la vista para redireccionar al usuario
     * 
     * @param int $idPerfil
     * 
     * @return void
     */
    private function getPerfilView(int $idPerfil): void
    {
        switch ($idPerfil) {
            case '1':
                $this->view = 'index_admin';
                $this->page_title = 'ADMINISTRACIÓN';
                break;
            case '2':
                $this->view = 'index_profesor';
                $this->page_title = 'ZONA PROFESOR';
                break;
            case '3':
                $this->view = 'index_alumno';
                $this->page_title = 'ZONA ALUMNO';
                break;
	    case '4':
                $this->view = 'index_conserje';
                $this->page_title = 'ZONA CONSERJE';
                break;
            default:
                $this->view = 'login_principal';
                $this->page_title = 'INSERTE TARJETA';
                break;
        }
    }

    public function selectUsersType()
    {
        $this->view = 'seleccionar_tipo_usuario';
        $this->page_title = 'ADMINISTRACIÓN';
    }

    public function getDepart()
    {
        $this->view = 'selectDepar';
        $this->page_title = 'ADMINISTRACIÓN';
        $this->departamentos = $this->usuarioObj->getDepartamentos();
    }

    public function getUnidad()
    {
        $this->view = 'selectUnidad';
        $this->page_title = 'ADMINISTRACIÓN';
        $this->unidades = $this->usuarioObj->getUnidades();
    }

    public function getUnidadconserje()
    {
        $this->view = 'selectUnidadrecogida';
        $this->page_title = 'CONSERJE';
        $this->unidades = $this->usuarioObj->getUnidades();
    }

    public function getUnidadconserjeinformes()
    {
        $this->view = 'selectUnidadrecogidainformes';
        $this->page_title = 'CONSERJE';
        $this->unidades = $this->usuarioObj->getUnidades();
    }




    public function listadoUsuarios()
    {
        $this->select = $_POST['select'] ?? null;
        $this->listado = [];

        if (null !== $this->select) {
            $type = explode('_', $this->select)[0];
            $value = explode('_', $this->select)[1];
            $this->listado = $this->tarjetaObj->getTarjetaUsuario($type, $value);
            $this->view = 'lista_usuarios_tarjeta';
            $this->page_title = 'ADMINISTRACIÓN';
            return;
        }

        $this->view = 'seleccionar_tipo_usuario';
        $this->page_title = 'ADMINISTRACIÓN';
    }

    public function listadoUsuarios_recogida()
    {
        $this->select = $_POST['select'] ?? null;
        $this->listado = [];

        if (null !== $this->select) {
            $type = explode('_', $this->select)[0];
            $value = explode('_', $this->select)[1];
            $this->listado = $this->tarjetaObj->getTarjetaUsuarioRecogida($type, $value);
            $this->view = 'lista_usuarios_tarjeta_recogida';
            $this->page_title = 'CONSERJE';
            return;
        }

        $this->view = 'selectUnidadrecogida';
        $this->page_title = 'CONSERJE';
    }

   public function listadoUsuarios_recogidainformes()
    {
        $this->select = $_POST['select'] ?? null;
        $this->listado = [];

        if (null !== $this->select) {
            $type = explode('_', $this->select)[0];
            $value = explode('_', $this->select)[1];
            $this->listado = $this->tarjetaObj->getTarjetaUsuarioRecogida($type, $value);
            $this->view = 'lista_usuarios_tarjeta_informe';
            $this->page_title = 'CONSERJE';
            return;
        }

        $this->view = 'selectUnidadrecogidainformes';
        $this->page_title = 'CONSERJE';
    }


   public function informessalida()
   {
      $this->conserje = $_SESSION['user']['email'];
      $this->view = 'seleccionar_tipo_informe';
      $this->page_title = 'CONSERJE';
   }


    public function informealumno()
   {
      $this->conserje = $_SESSION['user']['email'];
      $this->view = 'lista_usuarios_tarjeta_informe';
      $this->page_title = 'CONSERJE';
   }

   public function informes_recogida()
   {
	$this->usuario = $_POST['usuario'];
	$this->listado = [];

        if (null !== $this->usuario) {
            $usuario = $this->usuario;
            $this->listado = $this->tarjetaObj->getTarjetainformerecogidauser($usuario);
            $this->view = 'lista_usuarios_tarjeta_informe_usuario';
            $this->page_title = 'CONSERJE';
            return;
       }

        $this->view = 'seleccionar_tipo_informe';
        $this->page_title = 'CONSERJE';
	$this->page_error = 'Selecciona un usuario';
    }

  public function informefechas()
  {
	$this->conserje = $_SESSION['user']['email'];
        $this->view = 'informefechas';
        $this->page_title = 'CONSERJE';

  }



  public function listadoinforme_fechas()
    {
        $this->select1 = $_POST['fecha_inicio'] ?? null;
	$this->select2 = $_POST['fecha_fin'] ?? null;
        $this->listado = [];

        if (null !== $this->select1 and null !== $this->select2) {
            $fecha_ini = $this->select1;
            $fecha_fin = $this->select2;
            if ($this->select1 < $this->select2) {
                $this->listado = $this->tarjetaObj->getTarjetainformerecogida($fecha_ini, $fecha_fin);
                $this->view = 'lista_usuarios_tarjeta_informe_fecha';
                $this->page_title = 'CONSERJE';
                return;
            }
            else {
                $this->view = 'informefechas';
                $this->page_title = 'CONSERJE';
                $this->page_error = 'La fecha de inicio debe ser mas pequeña que la fecha de fin';
            }
            
       }

        $this->view = 'informefechas';
        $this->page_title = 'CONSERJE';
    }




    public function recogida_update()
    {
        $this->POST = $_SERVER['REQUEST_METHOD'];
        $this->relacion_familiar['relacion_familiar'];
        $this->otro_familiar = $_POST['otro_familiar'];
	    $this->nombre_padre = $_POST['nombre_padre'];
    	$this->dni_padre = $_POST['dni_padre'];
    	$this->alumno = $_POST['alumno'];
    	$this->curso = $_POST['curso'];
   	    $this->fecha_salida = $_POST['fecha_salida'];
    	$this->motivo_salida = $_POST['motivo_salida'];
    	$this->otro_motivo = $_POST['otro_motivo'];
    	$this->opciones = $_POST['opciones'];
    	$this->otra_opcion = $_POST['otra_opcion'];

	if (null !== $this->POST) {
	    $this->consulta = $this->tarjetaObj->updaterecogida($this->relacion_familiar, $this->otro_familiar, $this->nombre_padre, $this->dni_padre, $this->alumno, $this->curso, $this->fecha_salida, $this->motivo_salida, $this->otro_motivo, $this->opciones, $this->otra_opcion);
        if ($this->consulta == true){
            $this->view = 'index_conserje';
            $this->page_title = 'CONSERJE';
	    }
            return;
        }

        $this->view = 'formulario_recogida';
        $this->page_title = 'CONSERJE';
	    $this->page_error = 'Error en el formulario';
    }



    public function setTarjeta()
    {
        $this->select = $_POST['select'] ?? null;
        $this->usuario = $_POST['usuario'] ?? null;
        var_dump($this->usuario);
            if ('' == $this->usuario) {
            $type = explode('_', $this->select)[0];
            $value = explode('_', $this->select)[1];
            $this->listado = $this->tarjetaObj->getTarjetaUsuario($type, $value);
            $this->view = 'lista_usuarios_tarjeta';
            $this->page_title = 'ADMINISTRACIÓN';
            $this->page_error = 'Selecciona un usuario válido';
            return;
        }

        $this->datos = explode('_', $this->usuario)[0];
        $this->idUsuario = explode('_', $this->usuario)[1];
        $this->view = 'get_tarjeta';
        $this->page_title = 'ADMINISTRACIÓN';
    }


    public function setUserTarje()
    {
        $this->idUsuario = $_POST['idUsuario'] ?? null;
        $this->idTarjeta = $_POST['idTarjeta'] ?? null;
        $this->datos = $_POST['nombre'] ?? null;

        if ((!$this->idUsuario && !$this->idTarjeta) || !preg_match("/^[0-9]+$/", $this->idTarjeta)) {
            $this->view = 'get_tarjeta';
            $this->page_title = 'ADMINISTRACIÓN';
            $this->page_error = 'Introduce una tarjeta válida';
            return;
        }

        /* https://www.php.net/manual/es/function.preg-match.php */
        $prueba = $this->tarjetaObj->setUserTarjeta($this->idUsuario, $this->idTarjeta);
        $this->view = 'seleccionar_tipo_usuario';
        $this->page_title = 'ADMINISTRACIÓN';
        if ($prueba == FALSE){
            $this->page_error = 'Tarjeta no asociada';
        } else {
            $this->page_success = 'Tarjeta asociada';
        }
        
        
    }

    public function accesoBano()
    {
        $this->profesor = $_SESSION['user']['email'];
        $this->view = 'acceso_bano';
        $this->page_title = 'Acceso al Baño';
    }


    public function formulario_recogida()
    {
        $this->conserje = $_SESSION['user']['email'];
        $this->view = 'formulario_salida';
        $this->page_title = 'Recogida Alumno';
    }



    public function permiso_bano()
    {
        $this->profesor = $_SESSION['user']['email'];
        $tarjeta = $_POST['idTarjeta'];

        if (!$tarjeta) {
            $this->view = 'acceso_bano';
            $this->page_title = 'Acceso al Baño';
            $this->page_error = 'Introduce una tarjeta correcta';
            return;
        }

        $nieAlumno = $this->tarjetaObj->comprobarUserBano($tarjeta);

        if (!$nieAlumno) {
            $this->view = 'acceso_bano';
            $this->page_title = 'Acceso al Baño';
            $this->page_error = 'El usuario no existe';
            return;
        }

        $url = "http://cpd.iesgrancapitan.org:9280/api.php?nie={$nieAlumno['nie']}&profe=$this->profesor&consulta=1";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        $data = curl_exec($curl);

        if (trim($data) == '"SI"') {
            $this->view = 'aseo_libre';
            $this->page_title = 'Acceso Concedido';
        } else {
            $this->view = 'aseo_ocupado';
            $this->page_title = 'Acceso Denegado';
        }
    }

    public function estado_tarjeta()
    {
        $this->view = 'estado_tarjeta';
        $this->page_title = 'Estado de la tarjeta';
    }

    public function borradoAsociacion()
    {
        $usuarios = $_POST['usuarios'] ?? null;
        $motivo = $_POST['motivo'] ?? null;

        $this->tarjetaObj->borradoAsociacion($usuarios, $motivo);

        header('Location: index.php?controller=usuario&action=listado');
    }
}
