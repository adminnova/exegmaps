<?php
$file=file("nombre_archivo.csv");
foreach ($file as $num_linea => $linea) {
	
	$data=explode(";",$linea);
	
	$city=trim(ucwords(strtolower($data[5])));
	$idx=$num_linea+(1);

echo "/****************(".$city."/".ucwords(strtolower($data[4])).") - ".ucwords(strtolower($data[0]))."********************/";
echo "<br/>";
echo "info.push('".htmlentities(ucwords(strtolower($data[0]))."<br/>".ucwords(strtolower($data[1]))."<br/>".$data[2])."');";
echo "<br/>";
echo "ltlng.push(new google.maps.LatLng(".$data[6].",".$data[7]."))";
echo "<br/>";
echo "city.push('".$city."')";
echo "<br/>";
echo "/************************************/";
echo "<br/>";


}

?>