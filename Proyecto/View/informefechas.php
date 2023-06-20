<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
	    <form method="POST" action="index.php?controller=tarjeta&action=listadoinforme_fechas">
                <div>
		    <label for="fecha_inicio">Fecha de inicio:</label>
  		    <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

  		    <label for="fecha_fin">Fecha de fin:</label>
  		    <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>

                    <div class="mt-3">
                        <input type=submit class='btn btn-primary' name='mostrar' value='Mostrar'>
                        <a class='btn btn-primary' href='index.php'>Inicio</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
