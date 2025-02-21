<?php

/* Fungsi hitungan mundur */

function Countdown($tmr){
	date_default_timezone_set("UTC");
	$symbol = [' ─ ',' / ',' │ ',' \ ',];
	$timr = time()+$tmr;
	$a = 0;
	while(true){
		$a +=1;
		$res=$timr-time();
		if($res < 1) {
			break;
		}
		print $sym[$a % 4].date('H:i:s',$res)."\r";
		usleep(100000);
	}
	print "\r           \r";
}

/******************** EXAMPLE ********************/

$tmr = 60; // 60 adalah waktu dalam detik
Countdown(60); // memperlihatkan hitungan mundur 
