<?php



function getTabBus($link){
	$file = file_get_contents($link);
	$doc = new DOMDocument();
	$doc->loadHTML($file);
	$var_input ;
	$prochain_passage =  $doc->getElementById("prochains_passages");
	$span = $doc->getElementsByTagName("span");
	$str_direction = "Hello";
	foreach($span  as  $searchNode ) {
		if( $searchNode->getAttribute("class") == "direction" ){
			$str_direction = $searchNode->nodeValue;
		}
	}
	//echo $str_direction ;
	$var_input["direction"]=$str_direction;
	$tableau = $doc->getElementById("prochains_passages")->getElementsByTagName("td");
	$var_input["now"] = $tableau->item(1)->nodeValue ;   // = intval($tableau->item(1)->nodeValue) ;
	$var_input["next"] = $tableau->item(3)->nodeValue ;
	

	return $var_input;
}




error_reporting(0);
	//$html = file_get_html('http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B293/293_925_1003/A');

	
	
	
	$link = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B293/293_925_1003/A" ;
	$var_output["293"]["A"] = getTabBus($link); 
	
	$link = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B293/293_925_1003/R" ;
	$var_output["293"]["R"] = getTabBus($link);
	
	$link = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_581_591/A" ;
	$var_output["132"]["A"] = getTabBus($link);
	
	$link = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_581_591/R" ;
	$var_output["132"]["R"] = getTabBus($link);
	
	// echo "<pre>";
	// print_r($var_output);
	// echo "</pre>";die();
	
	echo "{\"response\":".json_encode($var_output)."}";
	

?>
