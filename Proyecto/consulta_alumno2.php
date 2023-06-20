<?php
//Inicio la sesión
session_start();?> 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_menuadmin.css">
    <title>Consulta Servicio</title>
    <link rel="shortcut icon" href="IMG/favicon2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet"></head>

</head>

<body id="page" onload="acceso.idtarjeta.focus()">
    <div class="container-btn-mode">
        <div id="id-sun" class="btn-mode sun active">
            <i class="fas fa-sun"></i>
        </div>
        <div id="id-moon" class="btn-mode moon">
            <i class="fas fa-moon"></i>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div id="divnav" class="container px-4 px-lg-5">
            <img id="logonav" src="IMG/logonav.png" alt="IES GRAN CAPITÁN" alt="" />
        </div>
    </nav>
    <header id="medio" class="masthead">
        <div id="divcentral" class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div id="divcentral2" class="text-center">
                    <h1 id="letra" class="mx-auto my-0 text-uppercase">Solicitud de Acceso a Aseos</h1>
                    <h2 id="letra2" class="mx-auto mt-2 mb-5 letradedia">Pasa la tarjeta del alumno o escribe su código
                    </h2>
                    <h6 id="letra3" class="mx-auto mt-2 mb-5 letradedia"><?php echo 'Profesor: ' . $_SESSION['usuario'];?>
                    </h6>
                    <form id="acceso" method="POST" action="consulta_alumno2.php">
                        <input type="password" name="idtarjeta"><br><br>
                        <a class="btn btn-primary" href="paginaconsulta.php">Cerrar Sesión</a>
                        <input type="submit" class="btn btn-primary" value="Enviar" name="enviar">
                        
                    </form>
                    <?php
                    if (isset($_SESSION['usuario'])){
                    $profe = $_SESSION['usuario'];
                    if (isset($_REQUEST['enviar'])){
                    include ('conexionbd.php');
                    
                            // Creamos la consulta
                                $idtarjeta = $_POST['idtarjeta'];
                                //Para iniciar sesión
                                $queryusuario = mysqli_query($conn,"SELECT * FROM tabla_nfc_estudiantes WHERE idtarjeta = '$idtarjeta'");
                                $nr 		= mysqli_num_rows($queryusuario); 
                                $row2 = mysqli_fetch_assoc($queryusuario);
                                $nie = $row2['NIE'];
                                
                                if (($nr == 1)) 
                                    {
                                    $url = "http://cpd.iesgrancapitan.org:9280/api.php?nie=$nie&profe=$profe";
                                    
                                    $curl = curl_init();
                                    curl_setopt($curl, CURLOPT_URL, $url ); 
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); /**Respuesta como cadena*/
                                    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                                    curl_setopt($curl, CURLOPT_HTTPGET,true);
                                    $data = curl_exec($curl);
                                   

                                        if (trim($data) == '"SI"') {
                                            
                                            echo "libre";
                                            header('location:aseo_libre.php');
                                            
                                        }
                                       
                                        else {
                                            
                                            echo "ocupado";
                                            header('location:aseo_ocupado.php');
                                        }
                                    }
                                    else {
                                        echo "<p class='form-control'style='color: red;'>La tarjeta insertada no es de ningún alumno</p>";
                                    }
                                    curl_close($curl);
                                }
                            }
                            else {
                                echo "No se ha seleccionado ningún profesor";
                                header( "refresh:2;url=paginaconsulta.php" );
                            }
                            
                     ?>
                        
                </div>
            </div>
        </div>
    </header>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="index.js"></script>
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Manu Aranda | Fran Sánchez 2022</div>
    </footer>
</body>

</html>