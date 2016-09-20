<?php
/**
 * Format of Dates difference
 * @param  $start
 * @param  $end
 * @return string
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