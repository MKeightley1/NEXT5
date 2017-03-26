<?php

	function getData(){
		$url = 'https://www.ladbrokes.com.au/racing/horses/ladbrokes-pioneer-park/30130038-victorian-bush-rangers-hcp-64/';
		$homepage = file_get_contents($url);

		// a new dom object
		$dom = new domDocument; 

		// load the html into the object
		$dom->loadHTML($homepage);
		$mango_div = $dom->getElementById('event-competitors-30130038');
		$li_rows = $mango_div->getElementsByTagName('div');

		foreach ($li_rows as $li_row) {
			 $classy = $li_row->getAttribute("class");
			 
			 if($classy="competitor-name"){
				 $as = $li_row->getElementsByTagName('span');
				 foreach ($as as $a) {
					  $classy = $a->getAttribute("class");
					  if($classy =="competitor-name"){
						  $meeting = $a->nodeValue."   ";
						   print_r($meeting."\n");
					  }
						
				 }
			 }	
		}		
	}

	
	getData();

	
?>
