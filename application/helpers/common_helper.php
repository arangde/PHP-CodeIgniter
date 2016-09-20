<?php
/**
 * Functions of Dates
 */
function date_diff_format($start, $end='') {

	if($end=='')
		$end_ts = time();
	else
		$end_ts = strtotime($end);

	$start_ts = strtotime($start);
	$diff = $end_ts - $start_ts;

	$d = floor($diff / 86400);
	$h = floor(($diff-($d*86400)) / 3600);
	$m = floor(($diff-($d*86400)-($h*3600)) / 60);

	$diff = "";
	if($d>0)
		$diff = sprintf("%d days ago", $d);
	elseif($h>0)
	$diff = sprintf("%d hours ago", $h);
	elseif($m>0)
	$diff = sprintf("%d minutes ago", $m);
	else
		$diff = "less than 1 minute";

	return $diff;
}

function date_format2($date, $format = 'M j, Y') {
	$time = strtotime($date);
	return date($format, $time);
}


function daily_diff($start, $end='') {
	if($end=='')
		$end_ts = time();
	else
		$end_ts = strtotime($end);
	$start_ts = strtotime($start);
	$diff = $end_ts - $start_ts;

	$d = floor($diff / 86400);

	return $d;
}

function hourly_diff($start, $end) {
	$end_ts = strtotime($end);
	$start_ts = strtotime($start);
	$diff = floor($end_ts/60) - floor($start_ts/60);

	$d = floor($diff / 60);

	return $d;
}

function weekly_diff($start, $end) {
	$sDate = date_create($start);
	$eDate = date_create($end);

	$w = date_format($sDate, "d")- date_format($sDate, "N");
	$sdate = date_format($sDate, "Y-m-").sprintf("%02d", $w);

	$w = date_format($eDate, "d")- date_format($eDate, "N");
	$edate = date_format($eDate, "Y-m-").sprintf("%02d", $w);

	$d = dailyDiff($sdate, $edate);

	return intval($d/7);
}

function monthly_diff($start, $end) {
	$sDate = date_create($start);
	$eDate = date_create($end);

	$m = date_format($eDate, "m") - date_format($sDate, "m");
	$y = date_format($eDate, "Y") - date_format($sDate, "Y");

	return $y*12+$m;
}

function yearly_diff($start, $end) {
	$sDate = date_create($start);
	$eDate = date_create($end);

	$d = date_format($eDate, "Y") - date_format($sDate, "Y");

	return $d;
}

function month_format($m) {
	$Months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	return isset($Months[$m-1])? $Months[$m-1]: "";
}

function month_days($m) {
	$Months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	return isset($Months[$m-1])? $Months[$m-1]: 0;
}

function generateRandomString( $length ) {
	$chars = array_merge(range('A', 'Z'), range(0, 9));
	shuffle($chars);
	return implode(array_slice($chars, 0, $length));
}

function objectToArray( $object )
{
	if( !is_object( $object ) && !is_array( $object ) )
	{
		return $object;
	}
	if( is_object( $object ) )
	{
		$object = get_object_vars( $object );
	}
	return array_map( 'objectToArray', $object );
}

function strpos_needle_array(& $text, $needle_ary, $offset=0){
	for($ch_pos=$offset;$ch_pos<strlen($text);$ch_pos++){
		if(isset($needle_ary[$text[$ch_pos]])){
			return $ch_pos;
		}
	}
	return false;
}

/*Remove Directory*/
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

/*Portlet Manage*/
function portlet_view($id){

}