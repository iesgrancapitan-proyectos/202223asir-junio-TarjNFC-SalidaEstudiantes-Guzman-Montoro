<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='POST' name='relacionUserTarjetasForm' action='index.php?controller=tarjeta&action=listadoUsuarios_recogidainformes'>
                <div>
                    <p>Elige una unidad</p>
                    <select name="select" class="form-select">
                        <?php foreach ($controller->unidades as $keyD => $valueD) {
                            foreach ($valueD as $keyD2 => $valueD2) {
                                $isSelected = $valueD2 === explode('_', $controller->select)[1] ? 'selected' : '';
                                echo "<option $isSelected name='nombre' value=unidad_" . $valueD2 . ">" . $valueD2 . "</option>";
                            }
                        } ?>
                    </select>
                    <div class="mt-3">
                        <input type=submit class='btn btn-primary' name='mostrar' value='Mostrar'>
                        <a class='btn btn-primary' href='index.php'>Inicio</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
