<?php

/* Fungsi Request */

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

/******************** EXAMPLE ********************/

/* Penggunaan Fungsi Curl */
$url = "google.com";
$res = Curl($url); // GET
print_r($res);

// harus menggunakan print_r karena responnya array
// array 0 menunjukan response header
// array 1 menunjukkan response body html

print $res[1]; // untuk mengambil response body

/* Penggunaan Fungsi Get dengan Headers*/
$url = "google.com";

// $headers harus berupa array
$headers = array(); // memastikan $headers masih kosong
$headers[] = "cookie: xxx";
$headers[] = "user-agent: xxx";

$res = Get($url, $headers); // GET
print $res; // response langsung ke body html tanpa array

/* Penggunaan Fungsi Post dengan Headers*/
$url = "google.com";

// $headers harus berupa array
$headers = array(); // memastikan $headers masih kosong
$headers[] = "cookie: xxx";
$headers[] = "user-agent: xxx";

/* Contoh data */
$data_post = [
	"username"	=> "iewil",
	"password"	=> "inites"
];
$data_post = http_build_query($data_post);

// atau 

$data_post = "username=iewil&password=inites"; // data harus query

$res = Post($url, $headers, $data_post); // POST
print $res; // response langsung ke body html tanpa array
