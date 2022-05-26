<?php
include_once("massiveVars.php");
include_once("functions.php");
include_once("top.php");

if(isset($_REQUEST['search'])) $search = $_REQUEST['search'];
else $search = false;

?>
<form action="search.php">
  <label for="search">Search Video Description:</label><br>
  <input type="text" id="search" name="search"><br>
  <input type="submit" value="Submit">
</form>

<?php
if($search){
	$paramArr = ['searchStr' => $search];
    $params = http_build_query($paramArr);
  
	$url = "http://saruwatari.net:9090/youtube/searchVideoDescription?" . $params;
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
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

	$response = json_decode($response);
	$items = $response->data;
	$resultCount = count($items);

	echo "<h2>$resultCount results</h2>";

	$i=1;
	foreach($items as $key => $value){
		$stuff = $value->snippet;
		printf("<div class='video' id='%s' ><h3>%s</h3><img src='%s'/><p>%s</p></div>", $value->id, $stuff->title, $stuff->thumbnails->default->url, $stuff->description);
		$i++;
	}
}
