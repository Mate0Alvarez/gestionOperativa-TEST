<?php
if(isset($_POST["productos_log"])){
  // CAPTURAMOS LA INFORMACIÓN ENVIADA POR POST
  $productos_log=$_POST["productos_log"];

  // EXPORTAMOS
  // NO OLVIDAR JSON_UNESCAPED_UNICODE PARA EVITAR ERRORES DE FORMATO CON Ñ Y TILDES
  $productos_JSON = json_encode($productos_log,JSON_UNESCAPED_UNICODE);
  // CREAMOS EL ARCHIVO DE LOG
  $file = 'productos.json';
  // SOBRESCRIBIMOS
  file_put_contents($file, $productos_JSON);
  $response = "Se ha creado el archivo correctamente";
  echo json_encode("Se ha creado el archivo log exitosamente");
}
?>
