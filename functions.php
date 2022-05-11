<?php

function getStartByPage($page, $limit){
	return $page*$limit;
}

function getMaxPage($size, $limit){
	$max = floor($size/$limit);
	if($size%$limit !== 0) $max++;
	return $max;
}