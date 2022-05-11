<?php
include_once("massiveVars.php");
include_once("functions.php");


$limit = 10;

if(isset($_REQUEST['page'])) $page = $_REQUEST['page'];
else $page = 0;

if(isset($_REQUEST['season']))$season = $_REQUEST['season'];
else $season = -1;

try{
	(int) $season;
}
catch(Exception $e){
	echo "Invalid Season";
}



echo '<div class="season"><a href="/gmm/seasons.php?season=0>Pre GMM</a></div>';
for($i=1; $i<count($seasonArray); $i++){
	echo '<div class="season"><a href="/gmm/seasons.php?season=' . $i . '">Season ' . $i . '</a></div>';
}

print_r($seasonArray, true);

if($season>-1){

	$startVideo = getStartByPage($page, $limit);
	$endVideo = $startVideo+$limit;
	$maxPages = getMaxPage(count($seasonArray[$season]), $limit);

	for($i=$startVideo; $i<$endVideo; $i++){
		echo '<iframe frameborder="0" scrolling="no" marginheight="5" marginwidth="5"width="788.54" height="443" type="text/html" src="https://www.youtube.com/embed/' . $seasonArray[$season][$i] . '"></iframe>';
	}

	for($i=0; $i<$maxPages; $i++){
		echo '<a href="/gmm/seasons.php?season=' . $season . '&page=' . $i . '">' . $i . '</a>';
	}
}