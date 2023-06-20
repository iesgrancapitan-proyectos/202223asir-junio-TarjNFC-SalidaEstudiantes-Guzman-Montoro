<header id='medio' >
    <div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
        <div class='d-flex justify-content-center'>
            <div id='divcentral2' class='text-center'>
                <?php
                   // echo $_SESSION['user']['email'];
                ?>
                <h2 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Elija una opción</h2>
                <h5 id='letra2' class='mx-auto mt-2 mb-5 letradedia'>Eres el usuario  <?php echo $_SESSION['user']['email'];?> </h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comienzoCursoModal">Comienzo Curso</button>
                <a class='btn btn-primary' href='index.php?controller=usuario&action=listado'>Borrado de tarjeta</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=selectUsersType'>Selección tarjeta</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=accesoBano'>Acceso al baño</a>
                <a class='btn btn-primary' href='index.php?controller=tarjeta&action=logout'>Cerrar la sesión</a>
            </div>
        </div>
    </div>
</header>


<!-- Modal -->
<div class="modal fade" id="comienzoCursoModal" tabindex="-1" aria-labelledby="comienzoCursoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comienzoCursoModalLabel">Comienzo de curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Para comenzar el curso es necesario eliminar la base de datos. ¿Quieres eliminarla ahora?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-primary" href="index.php?controller=usuario&action=importar">Eliminar</a>
            </div>
        </div>
    </div>
</div>