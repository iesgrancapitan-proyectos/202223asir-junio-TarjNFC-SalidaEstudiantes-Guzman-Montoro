<?php

require_once 'model/tarjeta.php';
require_once 'model/usuario.php';

class UsuarioController
{
    public $page_title;
    public $page_error;
    public $page_success;
    public $view;

    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php');
        }
        $this->view = 'user_list';
        $this->tarjetaObj = new Tarjeta();
        $this->usuarioObj = new Usuario();
    }

    /**
     * Listado de usuarios
     */
    public function listado()
    {
        $this->select = $_POST['select'] ?? null;
        $this->listado = [];

        if (null !== $this->select) {
            $type = explode('_', $this->select)[0];
            $value = explode('_', $this->select)[1];
            $this->listado = $this->usuarioObj->getFilterUser($type, $value);
        }

        $this->departamentos = $this->usuarioObj->getDepartamentos();
        $this->unidades = $this->usuarioObj->getUnidades();
        $this->page_title = 'BORRADO DE TARJETA ASOCIADA';
    }

    public function motivoBaja()
    {
        $this->usuarios = $_POST['usuarios'] ?? null;

        if (null == $this->usuarios) {
            $this->page_error = 'No ha seleccionado ningún usuario';
            return $this->listado();
        }

        $this->view = 'motivo_baja';
        $this->page_title = 'MOTIVO DE LA BAJA';
    }

    public function eliminarDeVerdad()
    {
        $this->usuarios = $_POST['usuarios'] ?? null;
        if (null !== $this->usuarios) {
            $this->listado = $this->usuarioObj->delete($this->usuarios);
        }
        $this->page_success = 'Se ha eliminado la asociación';
        $this->listado();
    }

    //llamada a la vista importar CSV
    public function importar()
    {
        $this->usuarioObj->borradoInicioCurso();

        $this->view = 'importarCSV';
        $this->page_title = 'Comienzo de Curso';
    }

    public function importarUsuarios()
    {
        if ($_FILES['alumnos']['size'] == 0 || $_FILES['profesores']['size'] == 0) {
            $this->page_error = "Selecciona archivos válidos";
            $this->view = 'importarCSV';
            $this->page_title = 'de Curso';
            $this->page_error = 'Tiene que introducir ambos archivos';
            return;
        }

        $this->importarProfesores($_FILES['profesores']);
        $this->importarAlumnos($_FILES['alumnos']);

        $this->page_success = "Ha salido todo bien";
        $this->view = 'index_admin';
        $this->page_title = 'Comienzo de Curso';
    }

    //lectura de csv e insercion de datos en la BBDD(alumnos)
    public function importarAlumnos($file)
    {
        $this->files = $file;

        $filename = $file["name"];
        $info = new SplFileInfo($filename);
        $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

        if ($extension == 'csv') {
            $filename = $file['tmp_name'];
            $handle = fopen($filename, "r");

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $this->usuarioObj->insertUsuariosAlumnos($data);
            }

            fclose($handle);
        } else {
            echo "El archivo no es correcto";
        }
    }

    //lectura de csv e insercion de datos en la BBDD(profesores)
    public function importarProfesores($file)
    {
        $this->files = $file;

        $filename = $file["name"];
        $info = new SplFileInfo($filename);
        $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

        if ($extension == 'csv') {
            $filename = $file['tmp_name'];
            $handle = fopen($filename, "r");

            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $this->usuarioObj->insertUsuariosProfesores($data);
            }
            fclose($handle);
        } else {
            echo "El archivo no es correcto";
        }
    }

    public function borradoUsuarios()
    {
        $this->view = 'importarCSV';
        $this->usuarioObj->borradoInicioCurso();
        $this->page_title = 'Administracion';
    }

    public function redireccionShikoba()
    {
        $this->view = 'shikoba';

        //$this->page_title = 'Consultar puntos';

        // $userNIE=$this->usuarioObj->nieUser($_SESSION['user']['idUsuario']);
    }

    public function redireccionsanciones()
    {
        $this->view = 'sanciones';

        //$this->page_title = 'Consultar puntos';

        // $userNIE=$this->usuarioObj->nieUser($_SESSION['user']['idUsuario']);
    }

    public function redireccionsancionact()
    {
        $this->view = 'sancionact';

        //$this->page_title = 'Consultar puntos';

        // $userNIE=$this->usuarioObj->nieUser($_SESSION['user']['idUsuario']);
    }
}