<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='POST' name='relacionUserTarjetasForm' action='index.php?controller=tarjeta&action=listadoUsuarios'>
                <div>
                    <p>Elige un departamento</p>
                    <select name="select" class="form-select">
                        <?php foreach ($controller->departamentos as $keyD => $valueD) {
                            foreach ($valueD as $keyD2 => $valueD2) {
                                echo "<option name='nombre' value=departamento_" . $valueD2 . ">" . $valueD2 . "</option>";
                            }
                        } ?>
                    </select>
                    <div class="mt-3">
                        <input type=submit class='btn btn-primary' name='mostrar' value='Mostrar'>
                        <a class='btn btn-primary' href='index.php?controller=tarjeta&action=selectUsersType'>Volver</a>
                        <a class='btn btn-primary' href='index.php'>Inicio</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>