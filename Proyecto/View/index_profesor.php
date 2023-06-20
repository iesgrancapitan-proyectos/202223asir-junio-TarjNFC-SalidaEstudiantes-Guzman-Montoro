<header id='medio' >
    <div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario  <?php echo $_SESSION['user']['email'];?> </h5>

        <div class='d-flex justify-content-center'>
            <div id='divcentral2' class='text-center'>
            <h2 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Elija una opción</h2>
                <h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario <?php echo $_SESSION['user']['email'];?></h5>
               
                <a class='btn btn-primary' href='index.php?controller=usuario&action=listado'>Borrado de tarjeta</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=selectUsersType'>Selección tarjeta</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=accesoBano'>Acceso al baño</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=logout'>Cerrar la sesión</a>
            </div>
        </div>
    </div>
</header>