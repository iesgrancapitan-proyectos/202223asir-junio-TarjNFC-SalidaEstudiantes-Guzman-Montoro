<?php
   //foreach($_SESSION['user'] as $key =>$value){

   //}
//echo $_SESSION['user']['idUsuario'] ;

?>
<header id='medio' >
    <div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <!--<h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario  <?php echo $_SESSION['user']['nie'];?></h5>
   -->

    <div class='d-flex justify-content-center'>
            <div id='divcentral2' class='text-center'>
            <h5>Eres el usuario <?php echo $_SESSION['user']['nie'];?></h5>
                <h2 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Elija una opción</h2>

                <a class='btn btn-primary' href='index.php?controller=usuario&action=redireccionShikoba'>Consultar Puntos</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=logout'>Cerrar la sesión</a>
            </div>
        </div>
    </div>
</header>
