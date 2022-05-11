<?php
include_once("massiveVars.php");
include_once("functions.php");
include_once("top.php");


for($i=1; $i<count($seasonArray); $i++){
	for($j=0; $j<count($seasonArray[$i]); $j++){
		echo '<a href="https://www.youtube.com/watch?v=' . $seasonArray[$i][$j] . '">Season ' . $i . ' Ep ' . $j+1 . '</a><br>';
		if(isset($moreArray[$i][$j])){
			echo '<a href="https://www.youtube.com/watch?v=' . $moreArray[$i][$j] . '">More Season ' . $i . ' Ep ' . $j+1 . '</a><br>';
		}
	}
}