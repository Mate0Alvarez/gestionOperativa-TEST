//Descripción//

Script específico para realizar una consulta, recorriendo todos los ítems publicados por el seller_id = 179571326 del site_id = "MLA" . Además, genera un archivo de LOG que contiene los siguientes datos de cada ítem: a. "id" del ítem, "title" del item, "category_id" donde está publicado, "name" de la categoría.


// INTRSTUCCIONES DE USO //

APACHE DEBE ESTAR INICIALIZADO

- Abrir script.html en el navegador.
- La aplicación solicitará la información necesaria para realizar la consulta (site_id && seller_id)
- Con dicha información realizará la consulta mediante un script en PHP:
	- En caso de éxito, creará un archivo .json con la siguiente información:
		-"id" del ítem.
		-"title" del item.
		-"category_id" donde está publicado.
		-"name" de la categoría.
	- El tiempo de ejecución de dicha consulta dependerá de la cantidad de productos que encuentre con el vendedor proporcionado, por lo que puede demorarse unos momentos. Sin embargo, como máximo traerá 1000 resultados.
	- Además, le ofrecerá al usuario descargar el archivo si desde el navegador, si así lo desea.
	- En caso de no poder realizar la consulta, se desplegará un alert().
