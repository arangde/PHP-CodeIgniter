<?php

function css($stylesheet, $media=null)
{
	$CI =& get_instance();
	return $CI->db_assets->css($stylesheet, $media);
}

function js($script)
{
	$CI =& get_instance();
	return $CI->db_assets->js($script);
}

function remote_css($css, $version=null)
{
    $CI =& get_instance();
    return $CI->db_assets->remote_css($css, $version);
}

function google($script, $version=null, $uncompressed=false)
{
	$CI =& get_instance();
	return $CI->db_assets->google($script, $version, $uncompressed);
}

function conditional($data, $condition="IE")
{
	$CI =& get_instance();
	return $CI->db_assets->conditional($condition, $data);
}

function img($img){
    $CI =& get_instance();
    return $CI->db_assets->img($img);
}