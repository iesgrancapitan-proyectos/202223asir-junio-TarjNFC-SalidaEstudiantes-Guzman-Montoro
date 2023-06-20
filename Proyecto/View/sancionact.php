<html>
    <?php
    include('alumnav.php');  
         // Creamos la consulta
         $url = "http://cpd.iesgrancapitan.org:9281/sancionactual.php?nie=". $_SESSION['user']['nie'];        
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url ); 
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
         curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
         curl_setopt($curl, CURLOPT_HTTPGET,true);
         $data = curl_exec($curl);
         $data=json_decode($data, true);
    ?>
  <body>
    <h1>SANCIONES ACTIVAS</h1>
      <div class='container'>
        <div class='row border border-dark'>
          <div class='col-sm'>Descricion</div>
          <div class='col-sm'>Tipo</div>
          <div class='col-sm'>Fecha </div>
          <div class='col-sm'>Fecha Inicio</div>
          <div class='col-sm'>Fecha Final</div>
        </div>
        <div>
          <?php     
            foreach($data as $value){
              $fecha = $value[0];
              $fechainicio = $value[1];
              $fechafin =  $value[2];
              $descripcion = $value[3];
              $tipo =  $value[4];
              echo "<div class='row border-bottom border-dark'>";
                echo "<div class='col-sm'>" . $descripcion ." </div>";
                echo "<div class='col-sm'>" . $tipo ." </div>";
                echo "<div class='col-sm'>" . $fecha ." </div>";
                echo "<div class='col-sm'>" . $fechainicio ." </div>";
                echo "<div class='col-sm'>" . $fechafin ." </div>";
              echo "</div>"; 
            }                           
            curl_close($curl);                
          ?>
        </div>
      </div>
  </body>
  <style>
    h1{
      padding-bottom: 25px;
      margin-top: -50px !important;
      text-align: center;
    }
  </style>
</html>
