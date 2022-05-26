<?php
include_once("massiveVars.php");
include_once("functions.php");
include_once("top.php");


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

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://saruwatari.net:9090/youtube/getVideoDetailsBySeason?season=1',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$response = curl_exec($curl);

	curl_close($curl);
	
	error_log($response);
	$response = json_decode($response);
	//var_dump($response);
	$items = $response->data;

	echo "<h2>Season $season</h2>";
	$startVideo = getStartByPage($page, $limit);
	$endVideo = $startVideo+$limit;
	$maxPages = getMaxPage(count($seasonArray[$season]), $limit);
	$i=1;
	foreach($items as $key => $value){
		$stuff = $value->snippet;
		printf("<div class='video' id='%s' ><h3>Episode %s - %s</h3><img src='%s'/><p>%s</p></div>", $value->id, $i, $stuff->title, $stuff->thumbnails->default->url, $stuff->description);
		$i++;
	}
	// for($i=$startVideo; $i<$endVideo; $i++){
	// 	echo '<iframe frameborder="0" scrolling="no" marginheight="5" marginwidth="5"width="788.54" height="443" type="text/html" src="https://www.youtube.com/embed/' . $seasonArray[$season][$i] . '"></iframe>';
	// }

	// for($i=0; $i<$maxPages; $i++){
	// 	echo '<a href="/gmm/seasons.php?season=' . $season . '&page=' . $i . '">' . $i . '</a>';
	// }
}