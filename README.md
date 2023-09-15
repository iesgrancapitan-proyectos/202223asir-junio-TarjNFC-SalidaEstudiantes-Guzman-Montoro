# TARJETA NFC de estudiante para salida del centro (Recreo y Recogida de Alumnado menor de edad).
Se trata de un proyecto que amplia  el proyecto de Salida al Aseo y consulta puntos Shikoba.
Por tanto la idea sería usarlo para: 
- kiosko informativo para consulta del alumnado
- profesorado para permiso de salida al aseo.
- Conserjes para el control de salida en el recreo de alumnado mayor de edad.
- Conserjes para el registro de recogida de alumnado menor de edad por parte de familiar autorizado.

# Publicado en :
Publicado en: https://kiosko.iesgrancapitan.org

M.V. de Luna: 192.168.12.233


## API a la intranet
En el módulo controller/tarjeta.php
En este caso nosotros solo consultamos si el alumno es mayor de edad o no:
$url = "http://cpd.iesgrancapitan.org:9280/api.php?nie={$nieAlumno['nie']}&profe=$this->profesor&consulta=2";


El código de la API en  la intranet está publicada en  : (192.168.12.115:/var/www/api-nfcintranet)


# Despliegue
Pila  LAMP


