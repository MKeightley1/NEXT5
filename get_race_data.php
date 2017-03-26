<?php
/*
	Purpose: to retrieve  race contenders and return to html front end page
	Method:
	Generate a url from the POST request and get contents of the site url - then cycled through particular html tags to retrieve data from website.
	Then stored into an array.

*/
	function getData(){
		//get url
		if($_POST["url"]){
			$url = $_POST["url"]; 
		} 
		
		//retrieve if from url
		$output = explode('/', trim($url, '/'));
		$id = explode('-', trim($output[6], '-'));
		
		//assign id relative thewebsite to retrieve class name
		$event_id= 'event-competitors-'.$id[0];
		
		//get html dom object 
		$homepage = file_get_contents($url);

		// a new dom object
		$dom = new domDocument; 

		// load the html into the object
		$dom->loadHTML($homepage);
		
		//get event_id  html element
		$mango_div = $dom->getElementById($event_id);
		$li_rows = $mango_div->getElementsByTagName('div');
		$stack = array();
		foreach ($li_rows as $li_row) {
			$class = $li_row->getAttribute("class");
			 
			 if($class="competitor-name"){
				$as = $li_row->getElementsByTagName('span');
				foreach ($as as $a) {
					$class = $a->getAttribute("class");
					if($class =="competitor-name"){
						$name = $a->nodeValue."   ";
						$race=[$name];
						array_push($stack, $race);
					}
						
				}
			 }	
		}		
		return $stack;	
	}

	//get array from method with each contender for this race and send back to html
	$data = getData();
	echo json_encode($data);

	
?>
