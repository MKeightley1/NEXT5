<?php

	function getData(){
		$homepage = file_get_contents('https://www.ladbrokes.com.au/racing/');

		// a new dom object
		$dom = new domDocument; 

		// load the html into the object
		$dom->loadHTML($homepage);

		//get element by id
		$mango_div = $dom->getElementById('sideNavRacing');
	
		$li_rows = $mango_div->getElementsByTagName('li');
		$top5races = array();
		$stack = array();
		$counter = 0;

		foreach ($li_rows as $li_row) {
			//get a href tag element
			$a = $li_row->getElementsByTagName('a');
			//get meeting
			$meeting = $a->item(0)->nodeValue."   ";
			$meeting = trim(preg_replace('/\s+/', ' ', $meeting));
			//get link ref
			$href= $a->item(0)->getAttribute('href')."   ";
			
			$abbr = $li_row->getElementsByTagName('abbr');  

			$time= $abbr->item(0)->getAttribute('time')."   ";
			$suspend= $abbr->item(0)->getAttribute('suspend')."   ";
			
			if($suspend>=$nowtime){
				//echo "meeting:".$meeting;
				//echo "href:".$href;
				//echo "time:".$time;
				//echo "suspend:".$suspend."\n";
				$race=[$counter,$meeting,$href,$time,$suspend];
				array_push($stack, $race);
			
				
			}
			
			if($counter==5){
				break;
			}else{
				$counter++;
			}
		}
		return $stack;	
	}
	
	$data = getData();
	echo json_encode($data);
	
?>
