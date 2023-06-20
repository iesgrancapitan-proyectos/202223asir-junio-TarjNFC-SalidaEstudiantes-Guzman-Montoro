<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='post' action=index.php?controller=tarjeta&action=borradoAsociacion>
                <div class='container'>
                    <select name="motivo" class="form-select">
                        <option name='bajaMatricula' value="Baja matricula">Baja matricula</option>
                        <option name='Perdida' value="Perdida" >Perdida</option>
                        <option name='Perdida' value="Deteriorio">Deteriorio</option>
                        <option name='Baja_Profesor' value="Baja_Profesor">Baja Profesor</option>
                    </select>
                    <?php foreach ($controller->usuarios as $idUsuario) { ?>
                        <input type="hidden" name="usuarios[]" value="<?php echo $idUsuario ?>">
                    <?php } ?>
                </div>
                <div class="mt-3">
                    <input type='submit' class='btn btn-primary' name='borrarAsociacion' value='Borrar'>
                    <a class='btn btn-primary' href='index.php?controller=usuario&action=listado'>Nueva consulta</a>
                    <a class='btn btn-primary' href='index.php'>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>