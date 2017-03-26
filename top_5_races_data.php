<?php
/*
	Purpose: to retrieve top 5 races and return to html front end page
	Method:
	Using file get contents - cycled through particular html tags to retrieve data from website.
	Then stored into an array.
*/


// function is design to complete the purpose above. 
	function getData(){
		//get contents of the website
		$homepage = file_get_contents('https://www.ladbrokes.com.au/racing/');

		// a new dom object
		$dom = new domDocument; 

		// load the html into the object
		$dom->loadHTML($homepage);

		//get element by particular id
		$mango_div = $dom->getElementById('sideNavRacing');
	
		//get element by li
		$li_rows = $mango_div->getElementsByTagName('li');
		$top5races = array();
		$stack = array(); // array to send back to html ajax
		$counter = 0; // to request only top 5 races

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
			
			//push all races with suspend time to the list.
			if($suspend>=$nowtime){
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
	
	//get array of races and send back to ajax
	$data = getData();
	echo json_encode($data);
	
?>
