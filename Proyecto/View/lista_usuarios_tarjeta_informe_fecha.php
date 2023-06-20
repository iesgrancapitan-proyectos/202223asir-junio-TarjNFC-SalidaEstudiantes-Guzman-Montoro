<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='post' action="index.php?controller=tarjeta&action=informes_recogida">
                <input type="hidden" name="select" value="<?php echo $controller->select ?>">
                <div class='container'>
                    <table class="table border border-dark">
                        <thead>
                            <tr>
                                <th scope="col">Nombre Padre/Madre/Tutor</th>
                                <th scope="col">DNI Padre/Madre/Tutor</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Fecha Salida</th>
                                <th scope="col">Motivo Salida</th>
				<th scope="col">Otro motivo</th>
				<th scope="col">Opciones</th>
				<th scope="col">Otra_opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($controller->listado as $fila) {
				echo "<tr>";
                                echo "<td>" . $fila[1] . "</td>";
                                echo "<td>" . $fila[2] . "</td>";
                                echo "<td>" . trim(($fila[3])) . "</td>";
                                echo "<td>" . trim(($fila[4])) . "</td>";
                                echo "<td>" . trim(($fila[5])) . "</td>";
                                echo "<td>" . trim(($fila[6])) . "</td>";
                                echo "<td>" . trim(($fila[7])) . "</td>";
                                echo "<td>" . trim(($fila[8])) . "</td>";
                                echo "<td>" . trim(($fila[9])) . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <a class='btn btn-primary' href='index.php?controller=tarjeta&action=informefechas'>Volver</a>
                    <a class='btn btn-primary' href='index.php'>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>
