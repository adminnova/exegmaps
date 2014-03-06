<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Exegmaps</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
<body>
    <div class="row">
      <div class="large-12 columns">
        <h1><b>Exegmaps</b></h1>
        <h2>Convierte tus direcciones a Puntos Google Maps.</h2>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
		<form name="forma" method="post" action="controllergmaps.php">
		<select name="id">
		<option value="-1">Seleccione .....</option>
		<option value="1">Armar csv para --> Archivo</option>
		</select>
		<input type="submit" class="small round button" value="Convertir"><br/>
				      <label>Escoge un Modo.</label>
				      <input type="radio" name="exetest" value="1" checked="checked">&nbsp;Test generacion Archivo - Muestra 10 registros de prueba en un csv<b> (Recomendable para ver si esta generando bien el archivo)</b><br/><br/>
				      <input type="radio" name="exetest" value="0">&nbsp;Genera el llamado al api de google aprox 2753 veces, diario solo se puede 2500 <b>(en el momento de que el test salga bien ejecutar esta opcion para generar el csv con coordenadas)</b>
		</form>
	    </div>
	  </div>
	</div>
	 <script src="js/vendor/jquery.js"></script>
	 <script src="js/foundation.min.js"></script>
     <script>
      $(document).foundation();
     </script>
</body>
</html>