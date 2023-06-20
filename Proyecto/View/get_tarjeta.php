<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='post' action="index.php?controller=tarjeta&action=setUserTarje">
                <div>
                    <div class='text-center'>Usuario</div>
                    <div>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $controller->datos; ?>" readonly>
                        <input type="hidden" name="idUsuario" value="<?php echo $controller->idUsuario; ?>">
                    </div>
                    <div class='text-center'>Asigna una tarjeta</div>
                    <div>
                        <input type="text" name="idTarjeta" class="form-control">
                    </div>
                    <div class="mt-3">
                        <input type=submit class='btn btn-primary' name='asignar' value='Asignar tarjeta'>
                        <a class='btn btn-primary' href='index.php'>Inicio</a>
                    </div>                                       
                </div>
            </form>
        </div>
    </div>
</div>