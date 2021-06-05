<?php
session_start();
//echo phpinfo();
$ip = gethostbyname('c.xkcd.com/random/comic');
//echo $ip;
function url_details($url)
{
  // code...
  //$url = 'https://c.xkcd.com/random/comic';
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $a = curl_exec($ch);

  $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

  echo curl_getinfo($ch, CURLINFO_PRIVATE);


  return $url;

  curl_close($ch);
}

$url = url_details('https://c.xkcd.com/random/comic');

$new_url = $url . 'info.0.json';
echo $new_url;
$json = array();
$json = file_get_contents($new_url);

echo "<pre>";
print_r($json);echo"<br>";
$json_data = json_decode($json);
$json_array = (array) $json_data;
print_r($json_array);
echo "</pre>";


?>
<html>
  <head>
    <title>Subscribe to XKCD Comics</title>
  </head>
  <body>
    <h1>Welcome</h1>
  </body>

</html>
<?php
session_destroy();
?>
