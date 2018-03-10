<?php

function rate_game($app_id, $rating, $email)
{

    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

    $sql = "UPDATE `owned_$email`
              SET rating = '$rating'
              WHERE steam_app_id = $app_id";

<<<<<<< HEAD
    $user->query($sql) or die($user->error);
}

function mark_owned($app_id, $email)
{
=======

      $user->query($sql) or die($user->error);
}

function mark_owned($app_id, $email, $gameName){
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a

    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

<<<<<<< HEAD
    $sql = "INSERT INTO `owned_$email`
              (steam_app_id)
              VALUES ($app_id)";
=======
      $sql = "INSERT INTO `owned_$email`
              (steam_app_id, game_name)
              VALUES ($app_id,'$gameName')";
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a

    $user->query($sql) or die($user->error);
}

<<<<<<< HEAD
function watch_game($app_id, $email)
{
=======
function watch_game($app_id, $email, $gameName, $date){
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a

    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

<<<<<<< HEAD
    $sql = "INSERT INTO `watch_$email`
              (steam_app_id)
              VALUES ($app_id)";
=======
      $sql = "INSERT INTO `watch_$email`
              VALUES ($app_id, '$gameName', '$date')";

      $user->query($sql) or die($user->error);
}

function recommend_game($app_id, $first_name, $last_name, $email, $name){

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "INSERT INTO recommended_games
              (steam_app_id, first_name, last_name, email, recommend, game_name)
              VALUES ($app_id, '$first_name', '$last_name', '$email', 'r', '$name')";
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a

    $user->query($sql) or die($user->error);
}

<<<<<<< HEAD
function add_pref($genre_id, $email)
{
=======
function check_owned($app_id, $email){

    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

    $sql = "SELECT * FROM `owned_$email`
           WHERE steam_app_id = $app_id";
    $result = $user->query($sql);

    if($result->num_rows == 0) {
            echo "
            </br></br>
                <button class='button button-block' id='own'>
                Mark owned
                </button>
            </div>";
    }
    else {
            echo "
            </br></br>
            <div class='alert alert-success'>
                <strong>You own this game</strong>
            </div>";

            $row = $result->fetch_assoc();
            $rating = $row["rating"];
            switch($rating){
              case "like":
                  echo
                  "
                  <div class='alert alert-success'>
                      <strong>You liked this game </strong><span class='glyphicon glyphicon-thumbs-up'></span>
                  </div>
                  <button class='button button-block' id='rec'>
                  Recommend
                  </button>
                  </span>
                  </div>";
                  break;

              case "dislike":
                  echo
                  "
                  <div class='alert alert-danger'>
                      <strong>You disliked this game </strong><span class='glyphicon glyphicon-thumbs-down'></span>
                  </div>
                  </span>
                  </div>";
                  break;

              case "null":
                  echo "
                  </br></br>
                  <div class='col-xs-6'>
                      <button class='button button-block' id='like'></strong>
                      <span class='glyphicon glyphicon-thumbs-up' style='color:white;'></span></button>
                  </div>";
                  echo "
                  <div class='col-xs-6'>
                      <button class='button button-block' id='dislike'></strong>
                      <span class='glyphicon glyphicon-thumbs-down' style='color:white;'></span></button>
                  </div>
                  </span>
                  </div>";
                  break;
              }
    }

}


function add_pref($genre_id, $email){
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a

    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

    $sql = "INSERT INTO `pref_$email`
              (genre)
              VALUES ($genre_id)";

    $user->query($sql) or die($user->error);
}

function display_owned($email)
{

    // Create connection
    $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

    $sql    = "SELECT * FROM `owned_$email`";
    $result = $user->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>Title</th><th>Like / Dislike</th></tr>";
        $rating = "";
        // output data of each row
        while ($row = $result->fetch_assoc()) {

<<<<<<< HEAD
            echo "<tr><td>" . $row["steam_app_id"] . "</td>";
            echo "<td>" . $row["rating"] . $rating . "</td></tr>";

            if ($row["rating"] = "like") {
                $rating = "<span class='glyphicon glyphicon-thumbs-up'></span>";
            } elseif ($row["rating"] = "dislike") {
                $rating = "<span class='glyphicon glyphicon-thumbs-down'></span>";
            } else {
                $rating = "Not rated yet!";
            }

        }
        echo "</table>";
    } else {
        echo "No games yet!";
    }

}
=======
              echo "<tr><td>".$row["game_name"]."</td>";

              switch($row["rating"]){
                case "like":
                    $rating = "<span class='glyphicon glyphicon-thumbs-up'></span>";
                    echo "<td>".$rating."</td></tr>";
                    break;

                case "dislike":
                    $rating = "<span class='glyphicon glyphicon-thumbs-down'></span>";
                    echo "<td>".$rating."</td></tr>";
                    break;

                case "null":
                    $rating = "Not rated yet!";
                    echo "<td>".$rating."</td></tr>";
                    break;
                }
          }
          echo "</table>";
      }
      else {
          echo "
          <div class='alert alert-danger'>
                <strong><center>No games yet!</center></strong>
          </div>";
      }

}



function display_recommended(){

      // Create connection
      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "SELECT * FROM recommended_games";
      $result = $user->query($sql);

      if ($result->num_rows > 0) {
          echo "<table><tr><th>Title</th><th>Recommended by</th></tr>";
          $rating = "";
          // output data of each row
          while($row = $result->fetch_assoc()) {

              echo "<tr><td>".$row["game_name"]."</td><td>".ucwords($row["first_name"])." ".ucwords($row["last_name"])."</td></tr>";

          }
          echo "</table>";
      }
      else {
        echo "
        <div class='alert alert-danger'>
              <strong><center>No recommended games yet!</center></strong>
        </div>";
      }

}

function display_watchlist($email){

      // Create connection
      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "SELECT * FROM `watch_$email`";
      $result = $user->query($sql);

      $notification = 'Upcoming Releases:\n\n';

      if ($result->num_rows > 0) {
          echo "<table><tr><th>Title</th><th>Expected Release Date</th></tr>";

          // output data of each row
          while($row = $result->fetch_assoc()) {



              $now = time();
              $your_date = strtotime($row["exp_release_date"]);
              $datediff = $your_date - $now;

              $days = round($datediff / (60 * 60 * 24) + 1);

              if($days <= 10){

                $notification .= $row["game_name"]." in ".$days." days".'\n';

              }




              $time = strtotime($row["exp_release_date"]);

              $newformat = date('m-d-Y',$time);

              echo "<tr><td>".$row["game_name"]."</td><td>".$newformat."</td></tr>";

          }
          echo "</table>";
          //echo $notification;
          echo "<script>";
          echo "
          $(document).ready(function(){
            alert('$notification');
          });";
          echo "</script>";
      }
      else {
          echo "
          <div class='alert alert-danger'>
                <strong><center>No games yet!</center></strong>
          </div>";
      }

}


?>
>>>>>>> ee0d7f83c2281c49f75d61a4410a61d971ebfb3a
