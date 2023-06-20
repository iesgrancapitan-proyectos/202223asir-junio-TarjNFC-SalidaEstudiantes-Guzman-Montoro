<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <?php if(empty($controller->listado)) { ?>
                <form method='POST' name='relacionUserTarjetasForm' action='index.php?controller=usuario&action=listado'>
                    <div>
                        <p>Elige un departamento o una unidad</p>
                        <select name="select" class="form-select">
                            <optgroup label="Departamentos">
                                <?php foreach ($controller->departamentos as $keyD => $valueD) {
                                    foreach ($valueD as $keyD2 => $valueD2) {
                                        $isSelected = $valueD2 === explode('_', $controller->select)[1] ? 'selected' : '';
                                        echo "<option $isSelected name='nombre' value=departamento_" . $valueD2 . ">" . $valueD2 . "</option>";
                                    }
                                } ?>
                            </optgroup>
                            <optgroup label="Unidades">
                                <?php foreach ($controller->unidades as $keyD => $valueD) {
                                    foreach ($valueD as $keyD2 => $valueD2) {
                                        $isSelected = $valueD2 === explode('_', $controller->select)[1] ? 'selected' : '';
                                        echo "<option $isSelected name='nombre' value=unidad_" . $valueD2 . ">" . $valueD2 . "</option>";
                                    }
                                } ?>
                            </optgroup>
                        </select>
                        <div class="mt-3">
                            <input type=submit class='btn btn-primary' value='Mostrar'>
                            <a class='btn btn-primary' href='index.php'>Inicio</a>
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <form method='post' action='index.php?controller=usuario&action=motivoBaja' class="mt-3">
                    <div class='text-center'>LISTADO DE USUARIOS</div>
                    <table class="table border border-dark">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Correo/Nie</th>
                                <th scope="col">Tarjeta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($controller->listado as $valueD) {
                                echo "<tr><td>";
                                if (null != $valueD[3]) {
                                    echo "<input type='checkbox' name='usuarios[]' value=" . $valueD[0] . ">";
                                }
                                echo "</td>";
                                echo "<td>" . ($valueD[4] == 2 || $valueD[4] == 1 ? $valueD[1] : $valueD[2]) . "</td>";
                                echo "<td>" . ($valueD[3] ?? 'Tarjeta no asignada') . "</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <input type='submit' class='btn btn-primary' value='Borrar'>
                        <a class='btn btn-primary' href='index.php?controller=usuario&action=listado'>Nueva consulta</a>
                        <a class='btn btn-primary' href='index.php'>Inicio</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>