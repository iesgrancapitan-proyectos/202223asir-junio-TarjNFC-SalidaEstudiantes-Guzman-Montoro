<!-- <header id="medio" class="masthead">
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
    </header> -->