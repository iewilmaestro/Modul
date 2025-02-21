# XEVIL
[register xevil](https://t.me/Xevil_check_bot?start=1204538927)
```php
$apikey = "xxx";
$captcha = new Xevil($apikey);

/* Penggunaan Fungsi */
$getBalance = getBalance();

$cap = $captcha->RecaptchaV2($sitekey, $pageurl);
$cap = $captcha->Hcaptcha($sitekey, $pageurl );
$cap = $captcha->Turnstile($sitekey, $pageurl);
$cap = $captcha->Authkong($sitekey, $pageurl);
$cap = $captcha->Ocr($img); // image to text
$cap = $captcha->AntiBot($source); // $source = Response body html
$cap = $captcha->Teaserfast($main, $small); // $main = img full, $small = potongan
```

# MULTIBOT
[register multibot](http://multibot.in/)
```php
$apikey = "xxx";
$captcha = new Multibot($apikey);

/* Penggunaan Fungsi */
$getBalance = getBalance();

$cap = $captcha->RecaptchaV2($sitekey, $pageurl);
$cap = $captcha->Hcaptcha($sitekey, $pageurl );
$cap = $captcha->Turnstile($sitekey, $pageurl);
$cap = $captcha->Authkong($sitekey, $pageurl);
$cap = $captcha->Ocr($img); // image to text
$cap = $captcha->AntiBot($source); // $source = Response body html
```
