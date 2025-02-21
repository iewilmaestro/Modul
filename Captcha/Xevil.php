<?php

Class Xevil {
	function __construct($apikey){
		$this->url = "https://sctg.xyz/";
		$this->apikey = $apikey."|SOFTID1204538927";
		$this->provider = "Xevil";
	}
	private function in_api($content, $method, $header = 0){
		$param = "key=".$this->apikey."&json=1&".$content;
		if($method == "GET")return json_decode(file_get_contents($this->url.'in.php?'.$param),1);
		$opts['http']['method'] = $method;
		if($header)$opts['http']['header'] = $header;
		$opts['http']['content'] = $param;
		return file_get_contents($this->url.'in.php', false, stream_context_create($opts));
	}
	private function res_api($api_id){
		$params = "?key=".$this->apikey."&action=get&id=".$api_id."&json=1";
		return json_decode(file_get_contents($this->url."res.php".$params),1);
	}
	private function getResult($data ,$method, $header = 0){
		$get_res = $this->in_api($data ,$method, $header);
		if(is_array($get_res)){
			$get_in = $get_res;
		}else{
			$get_in = json_decode($get_res,1);
		}
		if(!$get_in["status"]){
			$msg = $get_in["request"];
			if($msg){
				print "in_api @".$this->provider." ".$msg."\n";
			}elseif($get_res){
				print $get_res."\n";
			}else{
				print "in_api @".$this->provider." something wrong\n";
			}
			return false;
		}
		while(true){
			print " Bypass.. \r";
			$get_res = $this->res_api($get_in["request"]);
			if($get_res["request"] == "CAPCHA_NOT_READY"){
				print " Bypass... \r";
				sleep(10);
				continue;
			}
			if($get_res["status"]){
				print " Bypass success";
				sleep(2);
				print "\r               \r";
				return $get_res["request"];
			}
			print " Bypass failed";
			sleep(2);
			print "\r              \r";
			print " Bypass @".$this->provider." failed\n";
			return false;
		}
	}
	
	/**** GET BALANCE ****/
	public function getBalance(){
		$res =  json_decode(file_get_contents($this->url."res.php?action=userinfo&key=".$this->apikey),1);
		return $res["balance"];
	}
	
	/**** CAPTCHA SUPPORT ****/
	public function RecaptchaV2($sitekey, $pageurl){
		$data = http_build_query([
			"method" => "userrecaptcha",
			"sitekey" => $sitekey,
			"pageurl" => $pageurl
		]);
		return $this->getResult($data, "GET");
	}
	public function Hcaptcha($sitekey, $pageurl ){
		$data = http_build_query([
			"method" => "hcaptcha",
			"sitekey" => $sitekey,
			"pageurl" => $pageurl
		]);
		return $this->getResult($data, "GET");
	}
	public function Turnstile($sitekey, $pageurl){
		$data = http_build_query([
			"method" => "turnstile",
			"sitekey" => $sitekey,
			"pageurl" => $pageurl
		]);
		return $this->getResult($data, "GET");
	}
	public function Authkong($sitekey, $pageurl){
		$data = http_build_query([
			"method" => "authkong",
			"sitekey" => $sitekey,
			"pageurl" => $pageurl
		]);
		return $this->getResult($data, "GET");
	}
	public function Ocr($img){
		$data = "method=base64&body=".$img;
		return $this->getResult($data, "POST");
	}
	public function AntiBot($source){
		$main = explode('"',explode('src="',explode('Bot links',$source)[1])[1])[0];
		if(!$main){
			$main = explode('"',explode('<img src="',explode('<input type="hidden" name="antibotlinks"',$source)[1])[1])[0];
		}
		if(!$main)return false;
		$data = "method=antibot&main=$main";
		$src = explode('rel=\"',$source);
		foreach($src as $x => $sour){
			if($x == 0)continue;
			$no = explode('\"',$sour)[0];
			$img = explode('\"',explode('data:image/png;base64,',$sour)[1])[0];
			$data .= "&$no=$img";
		}
		$res = $this->getResult($data, "POST");
		if($res)return " ".str_replace(","," ",$res);
		return false;
	}
	public function Teaserfast($main, $small){
		$data = http_build_query([
			"method" => "teaserfast",
			"main_photo" => $main,
			"task" => $small
		]);
		$ua = "Content-type: application/x-www-form-urlencoded";
		return $this->getResult($data, "POST", $ua);
	}
}