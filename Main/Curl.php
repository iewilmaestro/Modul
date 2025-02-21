<?php

function Curl($url, $head = 0, $data_post = 0) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($data_post) {
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
	}
	if($head) {
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$res = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$head = substr($res, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($res, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($head,$body);
	}
}
function Get($url, $head = 0){
	return Curl($url, $head)[1];
}
function Post($url, $head = 0, $data_post = 0){
	return Curl($url, $head, $data_post)[1];
}
