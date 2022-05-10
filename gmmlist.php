<?php
include_once("massiveVars.php");

$gmmlinks = array_reverse($gmmlinks);
$limit = 10;

if(isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = 0;


function getStartByPage($page, $limit){
	return $page*$limit
}

function getMaxPage($size, $limit){
	$max = floor($size/$limit);
	if($size%$limit !== 0) $max++;
	return $max;
}

$startVideo = getStartByPage($page, $limit);
$endVideo = $startVideo+$limit;
$maxPages = getMaxPage(count($gmmlinks), $limit);

for($i=$startVideo; $i<$endVideo; $i++){
	echo '<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="788.54" height="443" type="text/html" src="https://www.youtube.com/embed/' . $gmmlinks[$i] . '"></iframe>';
}

for($i=0; $i<$maxPages; $i++){
	echo '<a href="/?page=' . $i . '">' . $i . '</a>';
}