<?php
include('alumnav.php');               
// Creamos la consult
    $url = "http://cpd.iesgrancapitan.org:9281/api.php?nie=". $_SESSION['user']['nie'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url ); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_HTTPGET,true);
    $data = curl_exec($curl);
    $data=json_decode($data, true);
    //echo '<pre>',print_r($data,1),'</pre>';
    $nombre=$data['nombre'];
    $apellidos= $data[2].' '. $data[3];
    $puntos=$data[0];
    curl_close($curl);
?>
<html>
  <body>
    <div>
      <h1 class="n" style="margin-top: -70px !important;"><?php echo $nombre . ' ' . $apellidos ?></h1>
      <div class="dot">
      <h1 class="puntos"><?php echo $puntos ?>/10</h1>
      </div>
    </div>
  </body>
  <style>
    .n{
    text-align: center;
    }

    .puntos{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    font-size: 100px;
    }

    .dot {
      height: 300px;
      width: 300px;
      background-color: #33b8ff ;
      border-radius: 50%;
      display: inline-block;
      position: absolute;
      top: 40%;
      left: 50%;
      transform: translate(-50%, 0%);
    }
  </style>

</html>

