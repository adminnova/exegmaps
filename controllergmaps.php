<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<?php


    if(!$_POST || $_POST['id']=="-1")
	  {
	   die("Ojoo!!!Debe sel una opc.....<script>window.location='index.php'</script>");
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
	converttocoordinates($filename,$params);


function getLatLong($address){
    if (!is_string($address))die("All Addresses must be passed as a string");
  //  $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
  $_url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false',rawurlencode($address));
	//echo $_url;
    //$_result = false;
    if($_result = file_get_contents($_url)) {
       // if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
       // preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
	//   var_dump($_result);
	   $data=json_decode($_result);
        $_coords['lat'] = $data->results[0]->geometry->location->lat;
        $_coords['long'] = $data->results[0]->geometry->location->lng;
		
    }
	//echo "<pre>";
	//$data=json_decode($_result);
	//var_dump($data->results[0]->geometry->location->lat);
	//var_dump($_result);exit;
    return $_coords;
}
//echo "<pre>";
//var_dump(getLatLong("CRA 3A 37 19,bogota"));
//exit;
function orgfile($filename,$params)
{
	
}



function converttocoordinates($filename,$params)
{
	
	$file=file($filename);
	
	
	$arr[1]="YOLO";
	
	$fileauxname=$arr[$params['id']]."_maps.csv";
	$fw=fopen($fileauxname,"w+");
	
	foreach ($file as $num_linea => $linea) {
	
	  if($num_linea>=$params['li'] && $num_linea<=$params['ls']){
		  //echo $num_linea."<br/>";
		  $data=explode(";",$linea);
		
		$city=trim(ucwords(strtolower($data[$params['ciudad']])));
		
		//if($num_linea>5)
		//   $coord="NULL";
		//else   
		$coord=getLatLong($data[$params['direccion']].",{$city}");	
	    
	//	$_dw="";
		$len=count($data);
		
		for($i=0;$i<$len;$i++){		
			//add coordenada posicion 2
			  // $_dw.=(strtoupper(trim($coord))=="NULL"?$coord:$coord['lat'].",".$coord['long']).";".$data[$i].";";
			$_dw[$i]=trim($data[$i]);
		}
		  $_dw[$len]=$coord['lat'].','.$coord['long']; 
		   //$_dwres=rtrim($_dw,";");
		   //echo $_dwres;
		   
		   $_dwres=implode(";",$_dw);
	    
		   //echo $_dwres."<br/>";	
		   fwrite($fw,$_dwres."\n");
		  //unset($_dw);
		
		
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


//Atencion:zona En construccion


$file=file("maps.csv");
$fw=fopen("coord.csv","w+");
foreach ($file as $num_linea => $linea) {
	
	$data=explode(";",$linea);
	
	//$ciudadestmp[]=$data[1];
	//$idx=$num_linea+(1);
    $city=trim(ucwords(strtolower($data[5])));
	
	$coord=getLatLong("{$data[1]},{$data[5]}");	
//echo '"'.$idx.'" => array("nombre"=>"'.$data[0].'","Ciudad"=>"'.$data[1].'","dir"=>"'.$data[4].'","info"=>"'.(trim($data[5])==""?ucwords(strtolower($data[4])):ucwords(strtolower($data[5]))).($data[3]!=""?'ssbrss Tel:'.$data[3]:"").'","ico"=>"http://olimpiait.com/gmaps/crc1.jpg"),<br/>';
//$coordinate=getLatLong($data[4]);
echo "/****************".$data[0]."********************/";
echo "<br/>";
echo "info.push('".htmlentities(ucwords(strtolower($data[0]))."<br/>".ucwords(strtolower($data[1]))."<br/>".$data[2])."');";
echo "<br/>";
echo "ltlng.push(new google.maps.LatLng(".$coord['lat'].",".$coord['long']."))";
echo "<br/>";
echo "city.push('".$city."')";
echo "<br/>";
echo "/************************************/";
echo "<br/>";

	$_dw=$data[0].";".$data[1].";".$coord['lat'].",".$coord['long'].";".$data[2].";".$data[3].";".$data[4].";".$data[5];
	fwrite($fw,$_dw);
	if($num_linea==50){
	   fclose($fw);
	   exit;
	}
}

exit;
