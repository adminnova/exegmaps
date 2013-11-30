<?php

if(!$_POST || $_POST['id']=="-1")
	  {
	   die("Ojoo!!!Debe seleccionar una opcion.....<a href='index.php'>volver</a>");
	   }
	switch($_POST['id'])
	{
		case 1:
		$params['li']=0;
		$params['ls']=100;
		break;		
	}

	$params['direccion']=1;
	$params['ciudad']=5;
	$params['id']=$_POST['id'];
	$params['test']=$_POST['exetest'];
	$filename="maps.csv";
	
//execute file
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename="."maps".".csv");
converttocoordinates($filename,$params);


function getLatLong($address){
    if (!is_string($address))die("All Addresses must be passed as a string");
   $_url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false',rawurlencode($address));
    if($_result = file_get_contents($_url)) {
	   $data=json_decode($_result);
        $_coords['lat'] = $data->results[0]->geometry->location->lat;
        $_coords['long'] = $data->results[0]->geometry->location->lng;
		
    }
    return $_coords;
}

function converttocoordinates($filename,$params)
{
	
	$file=file($filename);
	$arr[1]="YOLO";
	
	$fileauxname=$arr[$params['id']]."_maps.csv";
	$fw=fopen($fileauxname,"w+");
	
	foreach ($file as $num_linea => $linea) {
	
	  if($num_linea>=$params['li'] && $num_linea<=$params['ls']){
		  $data=explode(";",$linea);
		
		$city=trim(ucwords(strtolower($data[$params['ciudad']])));
		
		$coord=getLatLong($data[$params['direccion']].",{$city}");	
	    
		$len=count($data);
		
		for($i=0;$i<$len;$i++){		
			$_dw[$i]=trim($data[$i]);
		}
		  $_dw[$len]=$coord['lat'].','.$coord['long']; 
		   
		   $_dwres=implode(";",$_dw);
	    
		   fwrite($fw,$_dwres."\n");
		
		
		if($params['test']==1 && $num_linea==10){
		   fclose($fw);
		   printfile($fileauxname);
		   exit;
		}
		
		
		
		}//end if
	}
	fclose($fw);
	printfile($fileauxname);
}

function printfile($fname)
{
	
  echo "<a href='".$fname."'>Descargar {$fname}</a><br/>";
  echo '<a href="index.php">&lt;&lt;&lt;&lt;----Regresar</a>';
}

exit;
?>