<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function whosIP()
{
	$ip = 'none';
	//ip from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	//ip pass from proxy
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	//remot ip
	if (!empty($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function tipefile($string)
{
	$icon = '';
	if (
		$string == '.PNG' || $string == '.png' || $string == '.JPG' || $string == '.jpg' || $string == '.JPEG' || $string == '.jpeg'
		|| $string == '.GIF' || $string == '.gif'
	) {
		$icon = '<span><i class="fas fa-file-image text-warning"></i></span>';
	} else if ($string == '.PDF' || $string == '.pdf') {
		$icon = '<span><i class="fas fa-file-pdf text-danger"></i></span>';
	} else if ($string == '.DOC' || $string == '.doc' || $string == '.DOCX' || $string == '.docx') {
		$icon = '<span><i class="fas fa-file-word text-primary"></i></span>';
	} else if ($string == '.XLS' || $string == '.xls' || $string == '.XLSX' || $string == '.xlsx') {
		$icon = '<span><i class="fas fa-file-excel text-success"></i></span>';
	} else if ($string == '.MP4' || $string == '.mp4') {
		$icon = '<span><i class="fas fa-file-video text-grey"></i></span>';
	} else if ($string == '.PPT' || $string == '.ppt' || $string == '.PPTX' || $string == '.pptx') {
		$icon = '<span><i class="fas fa-file-powerpoint text-secondary"></i></span>';
	} else if ($string == '.MP3' || $string == '.mp3') {
		$icon = '<span><i class="fas fa-file-audio text-info"></i></span>';
	} else {
		$icon = '<span><i class="fas fa-file-archive text-dark"></i></span>';
	}

	return $icon;
}

function formatSize($bytes)
{
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}
	return $bytes;
}
