# Countdown
- Fungsi hitungan mundur
```php
$tmr = 60; // 60 adalah waktu dalam detik
Countdown(60); // memperlihatkan hitungan mundur 
```
# Curl
- Fungsi Request
```php
/* Penggunaan Fungsi Curl */
$url = "google.com";
$res = Curl($url); // GET
print_r($res);


// harus menggunakan print_r karena responnya array
// array 0 menunjukan response header
// array 1 menunjukkan response body html

print $res[1]; // untuk mengambil response body
```
```php
/* Penggunaan Fungsi Get dengan Headers*/
$url = "google.com";

// $headers harus berupa array
$headers = array(); // memastikan $headers masih kosong
$headers[] = "cookie: xxx";
$headers[] = "user-agent: xxx";
```
```php
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
```