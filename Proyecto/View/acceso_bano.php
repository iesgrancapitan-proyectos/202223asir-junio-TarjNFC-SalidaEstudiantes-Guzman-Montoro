<h2 id='letra2' class="text-center w-100">Introduce la tarjeta para acceder al baño</h2>
<p class="text-center">El profesor <?php echo $controller->profesor ?> te ha concedido acceso</p>
<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form action='index.php?controller=tarjeta&action=permiso_bano' method='post' enctype='multipart/form-data' id='import_form'>
                <input type='text' name='idTarjeta' class="form-control" />
                <div class="mt-3">
                    <input type='submit' class='btn btn-primary' value='Conceder Permiso'>
                    <a class='btn btn-primary' href='index.php'>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>