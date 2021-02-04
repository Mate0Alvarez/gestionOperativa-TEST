window.addEventListener("load", function() {

  function crearLog(response){ //declaramos la función para exportar la respuesta del fetch
    var productos_log = new Object; //declaramos un objeto donde almacenar las información de los productos
    for (var i = 0; i < response.length; i++) {
      var producto = new Object(); //declaramos un objeto con la infomación de cada producto
      producto["Id del ítem"] = response[i].id;
      producto["Título del ítem"] = response[i].title;
      producto["Categoría_ID donde está publicado"] = response[i].category_id;
  		producto["Nombre de la categoría"] = response[i].domain_id;

      productos_log[i] = producto; //Insertamos el producto
    }

    // Enviaremos la información utilizando AJAX para crear un archivo JSON
    $.ajax({
        url: "/meli/js/productos.php", //URL a donde queremos enviamos la información
        data: {
            'productos_log': productos_log //La información a enviar
        },
        type: 'POST', //El método
        dataType: 'JSON', //Formato
        success: function(response) {
          console.log(response);
          // Ofrecemos al usuario descargar el archivo creado
          var descarga = confirm("Se ha creado el archivo log exitosamente, ¿Desea descargar los resultados?");
          if (descarga) {
            var link=document.createElement('a'); //Creamos una etiqueta <a>
            var filePath = "/meli/js/productos.json" //declaramos la Ruta a utilizar
            link.href = filePath; //La asignamos
            link.download = filePath.substr(filePath.lastIndexOf('/') + 1); //Configuramos la ruta para que el navegador no abra una nueva ventana y descargue automaticamente
            link.click();
          }
        },
    });
  }
  // solicitamos que al usuario indicar el site_id y seller_id
  var site_id = window.prompt("Ingrese un site_id", "MLA");
  var seller_id = window.prompt("Ingrese un seller_id", "179571326");

  // usamos la información ingresada para realizar la petición fetch
  fetch(`https://api.mercadolibre.com/sites/${site_id}/search?seller_id=${seller_id}`)

  .then(response => response.json() ) //indicamos el formato en el que se obtendrá la respuesta
  .then(response =>{
    crearLog(response.results) //llamamos a la función crearLog
  })
  .catch(response =>{
    alert("Ups! Algo salió mal :( por favor recarga el sitio e intenta ingresar los datos nuevamente")
  })
});
