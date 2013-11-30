<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Adress to Google Maps</title>
</head>
<body>
<br/><br/><br/><br/><br/><br/>
<form name="forma" method="post" action="controllergmaps.php">
<select name="id">
<option value="-1">Seleccione .....</option>
<option value="1">Armar csv...</option>
</select>
<input type="submit" value="GO.."><br/>
<input type="radio" name="exetest" value="1" checked="checked">Test generacion Archivo (Muestra 10 registros de prueba en un csv<b>(Recomendable para ver si esta generando bien el archivo)</b>)<br/>
<input type="radio" name="exetest" value="0">Genera el llamado al api de google aprox 2753 veces, diario solo se puede 2500 <b>(en el momento de que el test salga bien ejecutar esta opcion para generar el csv con coordenadas)</b>
</form>
<hr/>
</body>
</html>