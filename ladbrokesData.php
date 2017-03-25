<?php

$homepage = file_get_contents('https://www.ladbrokes.com.au/racing/');
//echo $homepage;

// a new dom object
$dom = new domDocument; 

// load the html into the object
$dom->loadHTML($homepage);

//get element by id
$mango_div = $dom->getElementById('sideNavRacing');

$ui_rows = $mango_div->getElementsByTagName('ul');
$li_rows = $mango_div->getElementsByTagName('li');

$i = 0;
 

 // print_r($li_rows[0]); 


echo get_inner_html($li_rows->item(0));
echo get_inner_html($li_rows->item(1));
echo get_inner_html($li_rows->item(2));
echo get_inner_html($li_rows->item(3));
echo get_inner_html($li_rows->item(4));




 
function get_inner_html( $node ) 
{
    $innerHTML= '';
    $children = $node->childNodes;
     
    foreach ($children as $child)
    {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }
     
    return $innerHTML;
}


if(!mango_div)
{
    die("Element not found");
}
 
echo "element found";
echo $ui_rows->node;
//sideNavRacing

?>
