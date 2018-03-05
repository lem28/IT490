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
  echo "<a href=\"".$json->results[0]->site_detail_url."\" target=\"_blank\"><img src=\"".$json->results[0]->image->screen_url."\"></a>";
  echo "<br>";
  echo "Name: ".$json->results[0]->name;
  echo "<br>";
  if ($json->results[0]->expected_release_year == null)
  {
  	echo "Original Release Date: ".$json->results[0]->original_release_date;
  } else
  {
  	echo "Expected Release Date: ".$json->results[0]->expected_release_month." - ".$json->results[0]->expected_release_day." - ".$json->results[0]->expected_release_year;
	}
  echo "<br>";
  echo $json->results[0]->deck;
?>
