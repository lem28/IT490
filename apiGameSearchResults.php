<?php
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
