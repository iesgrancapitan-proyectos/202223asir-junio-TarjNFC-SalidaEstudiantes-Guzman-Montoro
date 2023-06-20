<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <?php
    session_start(); // Asegúrate de iniciar la sesión si aún no se ha iniciado
    $nombreGrupo = $_SESSION['nombreGrupo'];
    ?>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form action="index.php?controller=tarjeta&action=recogida_update" method="POST">
            <div class="text-center"> Relacion familiar:</div>
                <div>
                    <select id="relacion_familiar" name="relacion_familiar" class="form-control" required>
                        <option value="Padre">Padre</option>
                        <option value="Madre">Madre</option>
                        <option value="Tutor">Tutor</option>
                        <option value="otro">Otro</option>
                    </select>
                    <div>
                    <label for="otro_familiar">Otro familiar:</label>
                    <input type="text" id="otro_familiar" name="otro_familiar" class="form-control">
                </div>
                <div class="text-center">Nombre del padre/madre/tutor:</div>
                <div>
                    <input type="text" id="nombre_padre" name="nombre_padre" class="form-control" required>
                </div>

                <div class="text-center">DNI padre/madre/tutor:</div>
                <div>
                    <input type="text" id="dni_padre" name="dni_padre" class="form-control" maxlength="9" required>
                </div>

                <div class="text-center">Alumno:</div>
                <div>
                    <input type="text" name="alumno" class="form-control" value="<?php echo $_POST['usuario']; ?>" readonly>
                    <input type="hidden" name="select" value="<?php echo $nombreAlumno ?>">
                </div>

                <div class="text-center">Curso:</div>
                <div>
		    <input type="text" name="curso" class="form-control" value="<?php echo $nombreGrupo ?>" readonly>
                    <input type="hidden" name="nombreGrupo" value="<?php echo $nombreGrupo; ?>">
                </div>

                <div class="text-center">Fecha de salida:</div>
                <div>
                    <input type="date" id="fecha_salida" name="fecha_salida" class="form-control" required>
                </div>

                <div class="text-center"> Motivo de salida:</div>
                <div>
                    <select id="motivo_salida" name="motivo_salida" class="form-control" required>
                        <option value="Enfermedad o imprevisto médico urgente">Enfermedad o imprevisto médico urgente</option>
                        <option value="Cita médica">Cita médica</option>
                        <option value="Deber inexcusable">Deber inexcusable</option>
                        <option value="Motivos personales">Motivos personales</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div>
                    <label for="otro_motivo">Otro motivo (si aplica):</label>
                    <input type="text" id="otro_motivo" name="otro_motivo" class="form-control">
                </div>

                <div class="text-center">Documentación que aporta:</div>
                <div>
                    <label for="opciones">Opciones:</label>
                    <select id="opciones" name="opciones" class="form-control" required>
                        <option value="DNI del Padre/Madre o Tutor legal o autorizado en Séneca">DNI del Padre/Madre o Tutor legal o autorizado en Séneca</option>
                        <option value="Otro">Otro:</option>
                    </select>
                </div>

                <div>
                    <label for="otra_opcion">Otra opción (si aplica):</label>
                    <input type="text" id="otra_opcion" name="otra_opcion" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
                <a class='btn btn-primary' href='index.php'>Inicio</a>
            </form>
        </div>
    </div>
</div>
