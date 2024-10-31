<?php
  $token = $_POST['token'];

  include ('keys.php');
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $r = "{$url}?secret={$keys['secret']}&response={$token}"; // response

  $fr = file_get_contents($r); // final response
  // var_dump($fr);

  if ($fr === false) {
    $errors .= "Captcha verification failed. Please try again later.";
}
  $json = json_decode($fr, true);
  $frr = $json['success']; // final response result

  if($frr === false){
    $errors .= "Captcha error. Reload the page.";
  }

  if($json['score'] < 0.7){
      $errors .= "Captcha detect that you are a robot";
  }