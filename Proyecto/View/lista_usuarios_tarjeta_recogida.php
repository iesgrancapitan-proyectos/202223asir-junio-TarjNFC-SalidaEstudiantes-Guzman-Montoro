<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form method='post' action="index.php?controller=tarjeta&action=formulario_recogida">
                <input type="hidden" name="select" value="<?php echo $controller->select ?>">
                <div class='container'>
                    <div class='text-center'>LISTADO DE USUARIOS DE <?php echo strtoupper(explode('_', $controller->select)[1]) ?></div>
		    <?php
			// Iniciar la sesión
			session_start();

			// Guardar una variable en la sesión
			$_SESSION['nombreGrupo'] = strtoupper(explode('_', $controller->select)[1]);

    		    ?>
		    <table class="table border border-dark">
                        <thead>
                            <tr>
                                <th scope="col"></th>
				                <th scope="col">Nombre</th>
                                <th scope="col">Nie</th>
                                <th scope="col">Tarjeta</th>
                            </tr>
                        </thead>
                        <tbody>
				<?php
					foreach ($controller->listado as $valueD) {
					    $fullName = $valueD[1];
					    $nameParts = explode(' ', $fullName); // Divide el valor en un array utilizando el espacio como separador
					    $firstName = $nameParts[0]; // Primer elemento del array es el nombre
				            $lastName = isset($nameParts[1]) ? $nameParts[1] : ''; // Segundo elemento del array es el primer apellido (si está disponible)

					    echo "<tr><td>";
					    echo "<input type='radio' name='usuario' value='" . $firstName . " " . $lastName . "'>";
					    echo "</td>";
					    echo "<td>" . trim(($valueD[1] == 2 || $valueD[1] == 1 ? $valueD[0] : $valueD[1])) . "</td>";
					    echo "<td>" . trim(($valueD[3]) ?? 'Tarjeta no asignada') . "</td>";
					    echo "<td>" . trim(($valueD[4]) ?? '') . "</td></tr>";
					}
				?>

                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <input type=submit class='btn btn-primary' name='mostrar' value='Mostrar'>
                    <a class='btn btn-primary' href='index.php?controller=tarjeta&action=getUnidadconserje'>Volver</a>
                    <a class='btn btn-primary' href='index.php'>Inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>
