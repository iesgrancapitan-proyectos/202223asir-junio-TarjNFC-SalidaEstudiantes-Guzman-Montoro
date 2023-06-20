<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='post' action="index.php?controller=tarjeta&action=setTarjeta">
                <input type="hidden" name="select" value="<?php echo $controller->select ?>">
                <div class='container'>
                    <div class='text-center'>LISTADO DE USUARIOS DE <?php echo strtoupper(explode('_', $controller->select)[1]) ?></div>
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
                                if (null == $valueD[3]) {
                                    echo "<input type='radio' name='usuario' value=" .trim(($valueD[4] == 2 || $valueD[4] == 1 ? $valueD[1] : $valueD[2]) . "_" . $valueD[0]) . ">";
                                }
                                echo "</td>";
                                echo "<td>" . trim(($valueD[4] == 2 || $valueD[4] == 1 ? $valueD[1] : $valueD[2])) . "</td>";
                                echo "<td>" . trim(($valueD[3]) ?? 'Tarjeta no asignada') . "</td></tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <input type=submit class='btn btn-primary' name='mostrar' value='Mostrar'>
                    <a class='btn btn-primary' href='index.php?controller=tarjeta&action=<?php echo trim(($valueD[4] == 2 || $valueD[4] == 1 ? 'getDepart' : 'getUnidad')) ?>'>Volver</a>
                    <a class='btn btn-primary' href='index.php'>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>
