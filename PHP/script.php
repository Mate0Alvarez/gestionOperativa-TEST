<?php
// DECLARAMOS EL SITIO Y EL VENDEDOR
$SITE_ID = 'MLA';
$SELLER_ID = 179571326;

// // REALIZAMOS LA PETICIÓN
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.mercadolibre.com/sites/$SITE_ID/search?seller_id=$SELLER_ID");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$RESULTS = curl_exec($curl);
curl_close($curl);
// AGREMAOS CORCHETES PARA TRANSFORMARLO EN JSON
$RESULTS = "[$RESULTS]";
// CONVERTIMOS LOS RESULTADOS EN ARRAY
$RESULTS = json_decode($RESULTS,True);
// DECLARAMOS LA VARIABLE PRODUCTS CON LOS PRODUCTOS ENCONTRADOS
$PRODUCTS = $RESULTS[0]["results"];
// CREAMOS UN ARRAY VACÍO DONDE LUEGO EXPORTAREMOS LA INFORMACIÓN
$PRODUCTS_LOG = [];

// RECORREMOS LOS PRODUCTOS Y TOMAMOS LA INFORMACIÓN SOLICITADA
foreach( $PRODUCTS AS $PRODUCT){
	$PRODUCTS_LOG[]= [
		"Id del ítem" => $PRODUCT["id"],
		"Título del ítem" => $PRODUCT["title"],
		"Categoría_ID donde está publicado" => $PRODUCT["category_id"],
		"Nombre de la categoría" => $PRODUCT["domain_id"]
	];
};

// EXPORTAMOS
// NO OLVIDAR JSON_UNESCAPED_UNICODE PARA EVITAR ERRORES DE FORMATO CON Ñ Y TILDES
$PRODUCTS_JSON = json_encode($PRODUCTS_LOG,JSON_UNESCAPED_UNICODE);
// CREAMOS EL ARCHIVO DE LOG
$file = 'productos.json';
// SOBRESCRIBIMOS
file_put_contents($file, $PRODUCTS_JSON);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Test Gestión Operativa</title>
  </head>
  <body>
		<?php
		$i = 1;

		foreach ($PRODUCTS_LOG as $PRODUCTS){?>
			<div class="">
				<h2>Producto n°<?php echo $i?> :</h2>
				<p><b>El Id del item es: </b><?php echo $PRODUCTS["Id del ítem"]?></p>
				<p><b>El título del item es: </b><?php echo $PRODUCTS["Título del ítem"]?></p>
				<p><b>El category_ID donde está publicado: </b><?php echo $PRODUCTS["Categoría_ID donde está publicado"]?></p>
				<p><b>El nombre de la categoría es: </b><?php echo $PRODUCTS["Nombre de la categoría"]?></p>
			</div>
		<?php $i=$i+1;}; ?>
  </body>
</html>
