<html>
<head>
<title>Weather Forecasting</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
.jumbotron {
 background-color:transparent;
  margin: 5px auto;
  height:500px;
  justify-content: center;
padding:0;
}

.bg-cover {
    background-attachment: static;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
input[type=submit] {
  background-color:#f4253e;
  color: white;
  position: 10px 100 px;
  padding: 6px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}
.text-line {
    background-color: transparent;
    color:solid #000000;
    outline: none;
    outline-style: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-bottom: solid #000000 1px;
    padding: 3px 10px;
}
.text-line:focus
{
	    background-color: transparent;
}
</style>
<body >
<div class="jumbotron bg-cover" style="width:50%;">
<div style='background-color:#436cee;padding:30px;text-align:center'>
  <h3 style='color:white'>Weather Forecasting</h3>
  <h5 style="float:right;color:white">by Ramalingasamy M K</h5>
  </div>
  <br>
<form action="<?php 
         echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

<div class="form-group">
<label for="Consumer_number :"><b>Type city or Country:</b></label>
<input type="text" name="city" placeholder="city or country" class="text-line" required="">
</div>
<div class="form-group">
<input type="submit" name="form" value="Check" >
</div>
</form>
<div>
<?php
			 if ($_SERVER["REQUEST_METHOD"] == "POST") {

               $city= test_input($_POST["city"]);
			  
            }
		function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
		 if(isset($_POST['form']))
		 {
$get = json_decode(file_get_contents('http://ip-api.com/json/'),true);


date_default_timezone_set($get['timezone']);
 $string = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=ebcf5230b3446f334fe3fa2fd2d4ce24";
 $data = json_decode(file_get_contents($string),true);

 $temp = $data['main']['temp'];
 $icon = $data['weather'][0]['icon'];
$logo = "<img src='http://openweathermap.org/img/w/".$icon.".png' width='65px'>";
 
 $temperature =  "<b>Temp:".$temp."°C</b><br>";
 $clouds = "<b>Clouds:".$data['clouds']['all']."%</b><br>";
 $humidity = "<b>Humidity:".$data['main']['humidity']."%</b><br>";
 $windspeed = "<b>Wind Speed:".$data['wind']['speed']."m/s</b><br>";
 $pressure = "<b>Pressure:".$data['main']['pressure']."hpa</b><br>";
 $sunrise = "<b>Sunrise:".date('h:i A', $data['sys']['sunrise'])."</b><br>";
 $sunset = "<b>Sunset:".date('h:i A', $data['sys']['sunset'])."</b>";
echo '<div class="res">
<h3 style="text-align:center"><b>Weather in </b>'.$city.'</h3>'
.$logo.'<br><b>'.$temperature.'</b>';
 echo $clouds;
 echo $humidity;
 echo $windspeed;
 echo $pressure;
 echo $sunrise;
 echo $sunset;
		 }
?>
</div>
</body>
</html>