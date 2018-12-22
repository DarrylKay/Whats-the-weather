<?php
  error_reporting(E_ALL);

  $weather = "";
  $error = "";

  if (isset($_GET['city'])) {

    $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=217cd020c99e84984a3be38dcfa24087");

    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {

       $weather = "The weather in ".$_GET['city']. " is currently: '".$weatherArray['weather'][0]['description']."'.";

      $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

      $weather .= " The temperature is ".$tempInCelcius. "&deg;C";
    } else {
      $error = "Sorry could not find city. Please try again.";
    }

  }


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Whats the weather?</title>    
</head>
<body>
    <div class="container">
      <div class="infoBox">
        <h1>Whats the weather?</h1>
        <form>
          <div class="form-group">
            <label for="city">Please enter the name of the area you wish to weather check.</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Paris, Madrid">
          </div>          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="weather"><?php
          if ($weather) {
            echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
          } else if ($error) {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
          }
        ?></div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>