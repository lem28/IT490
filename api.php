<?php
  $q = $_REQUEST["q"];
  $outputFile = 'output.json';
  $name = str_replace(" ", '%20', $q);
  $baseURL = "https://www.giantbomb.com/api/search/?api_key=";
  $apiKey = "1eb68d69b5b8c3a4d37f93116ba4968ccf789a33";
  $query = "&query=";
  $fileFormat = "&format=json";
  $resourceType = "&resources=game";
  $fullURL = $baseURL.$apiKey.$fileFormat.$query.'"'.$name.'"'.$resourceType."";
  $options = array('http' => array('user_agent' => 'custom user agent string'));
  $context = stream_context_create($options);
  $apiResult = file_get_contents($fullURL, false, $context);
  $json = json_decode($apiResult);
?>
