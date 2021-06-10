<?php
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
//echo $new_url;
$json = array();
$json = file_get_contents($new_url);

//echo "<pre>";
//print_r($json);echo"<br>";
$json_data = json_decode($json);
$json_array = (array) $json_data;
//print_r($json_array);
//echo "</pre>";


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Funcom - XKCD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <style type="text/css">
    body{
      margin: 0;
    }
    header{
      position: fixed;
      width: 100%;
      overflow: hidden;
      background: white;
      padding: 5px;
      padding-bottom: 0px;
    }
    #header{
      display: flex;
      justify-content: center;
      align-content: center;
      text-align: center;
      align-items: center;
    }
    #header_row{
        display: inline-flex;
        flex: 50%;
        justify-content: center;
    }
    #header_form{
      width: 80%;
      display: flex;
    }
    #header_form > article{
      width: 100%;
      display: inherit;
      justify-content: center;
    }
    #input_1{
      padding: 5px;
      margin:  5px;
      display: inline-flex;
      width: 70%;
      position: relative;
    }
    #header_submit_button{
      padding: 5px;
      margin:  5px;
      display: inline-flex;
      width: 30%;
      position: relative;
    }
    @media only screen and (max-width: 900px){
      #header{
        display: grid;
      }
      #header_form{
        width: 80%;
      }
    }
    .preview{
      width: 90%;
      border: 2px solid lightgray;
      border-radius: 10px;
      overflow: hidden;
    }
    #transcript{
      display: none;
      width: 90%;
      border: 2px solid rgba(240,240,240,0.6);
      border-radius: 10px;
      padding: 8px;
      background: linear-gradient(324deg,gray,lightgray,white);
      margin: 8px auto 8px auto;
      transition: 1s;
      transition-timing-function: ease-in-out;
    }
    #image_loading{
      border: 20px solid lightgray;
      border-top-color: dimgray;
      border-radius: 50%;
      width: 100px;
      height: 100px;
      display: block;
      animation: spin 1s linear infinite;
      -webkit-animation: spin 1s linear infinite;
      -moz-animation: spin 1s linear infinite;
      -o-animation: spin 1s linear infinite;
      
    }
    @keyframes spin{
      100% { transform: rotate(360deg); }
    }
    @-webkit-keyframes spin{
      100% { transform: rotate(360deg); }
    }
    @-moz-keyframes spin{
      100% { transform: rotate(360deg); }
    }
    @-o-keyframes spin{
      100% { transform: rotate(360deg); }
    }

  </style>
  <script type="text/javascript">
    function stop_loader() {
      // body...
      document.getElementById('image_loading').style.display = "none";
    }
    function open_div(id){
      document.getElementById(id).style.display = "block";
    }
    function close_div(id){
      document.getElementById(id).style.display = "none";
    }
  </script>
</head>
<body>
<header>
  <center>
    <div id="header">
      <div id="header_row">
        <span>Subscribe Now to get fun XKCD comics delivered at your email</span>
      </div>
      <div id="header_row">
        <form id="header_form">
          <article><input id="input_1" type="email" name="email" placeholder="Enter your email" required>
          <input id="header_submit_button" type="submit" name="subscribe" value="Subscribe"></article>
        </form>
      </div>
    </div>
    <a id="visit_link" href="<?php echo $url; ?>">Visit Link</a>
  </center>
  <hr style="color: gold;margin-bottom: 0px;">
</header>
<br>
<center style="margin-top: 100px;">
<div class="preview">
  <center>
    <div style="padding: 10px;background-image: linear-gradient(324deg,gray,lightgray,white); font-size: 20px;font-weight: 2em;">
      <span>Preview</span>  
    </div>
    <div>
      <div>Published On: <?php print_r($json_array['day']);echo " - ";print_r($json_array['month']);echo " - ";print_r($json_array['year']);echo "<br>"; ?> 
      </div>
      <div>Comics Number: <?php print_r($json_array['num']);echo "<br>";?></div><br>
      <div style="width: max-content;width: -moz-fit-content;">Title: <?php print_r($json_array['safe_title']);echo "<br>";?></div><br>
      <div> 
        <img style="min-width: 80%;max-width: 100%; object-fit: contain;" src="<?php print_r($json_array['img']); ?>" onload="stop_loader()">
        <div id="image_loading"></div>
      </div>
      <br>
      <div style="padding: 10px;background-image: linear-gradient(324deg,gray,lightgray,white); font-size: 20px;font-weight: 2em; border: 1px solid white; border-radius: 4px;">
        <span>Transcript</span>
        <button onclick="open_div('transcript')">Open</button>
      </div>
      <div id="transcript">
        <div onclick="close_div('transcript')" style="margin: 4px auto 4px auto;padding: 4px; z-index: 1;position: relative;width: min-content;">
          <svg height="25px" width="25px">
            <circle cx="12.5" cy="12.5" r="12" stroke="white" fill="red" />
            <line x1="3" y1="3" x2="21" y2="21" stroke="white" stroke-width="2" />
              <line x1="21" y1="3" x2="3" y2="21" stroke="white" stroke-width="2" />
          </svg>
        </div>
        <?php 
          print_r($json_array['transcript']); echo "<br>";
          print_r($json_array['alt']);echo "<br>";
        ?>
      </div>
      
      <div>
      <?php 
      if (!empty($json_array['news'])) {
        // code...
        echo "News: ";
        print_r($json_array['news']);echo "<br>";
      }
      ?>
        
      </div>
    </div>
  </center>
  <a id="visit_link" href="<?php echo $json_array['link']; ?>"><?php print_r($json_array['title']); ?></a>
</div>
</center>
<br>
</body>
</html>
