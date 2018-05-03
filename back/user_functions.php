<?php

function rate_game($app_id, $rating, $email){

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "UPDATE `owned_$email`
              SET rating = '$rating'
              WHERE steam_app_id = $app_id";


      $user->query($sql) or die($user->error);
}

function mark_owned($app_id, $email, $gameName){

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "INSERT INTO `owned_$email`
              (steam_app_id, game_name)
              VALUES ($app_id,'$gameName')";

      $user->query($sql) or die($user->error);
}

function watch_game($app_id, $email, $gameName, $date){

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "INSERT INTO `watch_$email`
              VALUES ($app_id, '$gameName', '$date')";

      $user->query($sql) or die($user->error);
}

function recommend_game($app_id, $first_name, $last_name, $email, $name){

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "INSERT INTO recommended_games
              (steam_app_id, first_name, last_name, email, recommend, game_name)
              VALUES ($app_id, '$first_name', '$last_name', '$email', 'r', '$name')";

      $user->query($sql) or die($user->error);
}

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

      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "INSERT INTO `pref_$email`
              (genre)
              VALUES ($genre_id)";

      $user->query($sql) or die($user->error);
}

function display_owned($email){

      // Create connection
      $user = new mysqli('localhost', 'root', 'Jonathan723', 'userdata');

      $sql = "SELECT * FROM `owned_$email`";
      $result = $user->query($sql);

      if ($result->num_rows > 0) {
          echo "<table><tr><th>Title</th><th>Like / Dislike</th></tr>";
          $rating = "";
          // output data of each row
          while($row = $result->fetch_assoc()) {

              echo "<tr><td><a href='/game.php?gameid=".$row["steam_app_id"]."'>".$row["game_name"]."</a></td>";

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

              //echo "<tr><td>".$row["game_name"]."</td><td>".ucwords($row["first_name"])." ".ucwords($row["last_name"])."</td></tr>";
              echo "<tr><td><a href='/game.php?gameid=".$row["steam_app_id"]."'>".$row["game_name"]."</a></td><td>".ucwords($row["first_name"])." ".ucwords($row["last_name"])."</td></tr>";

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

              echo "<tr><td><a href='/game.php?gameid=".$row["steam_app_id"]."'>".$row["game_name"]."</a></td><td>".$newformat."</td></tr>";

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

function display_topics($app_id, $board_id){

      // Create connection
      $forum = new mysqli('localhost', 'root', 'Jonathan723', 'forum');

      $sql = "SELECT * FROM `$app_id"."_topics` WHERE `board_id` = $board_id ORDER BY date DESC";
      $result = $forum->query($sql);

      if ($result->num_rows > 0) {
          echo "<table><tr><th>Topic</th><th>Created by</th></tr>";

          // output data of each row
          while($row = $result->fetch_assoc()) {

              //echo "<tr><td>".$row["topic"]."</td>"."<td>".$row["user"]."<br>".$row["date"]."</td></tr>";

              echo "<tr><td align='left' width='80%'><a href='viewtopic.php?gameid=".$app_id."&board=".$board_id."&topic=".$row["topic_id"]."'>".$row["topic"]."</a></td align='right' width='20%'>"."<td>".$row["user"]."<br>".$row["date"]."</td></tr>";

          }
          echo "</table>";
      }
      else {
        echo "
        <div class='alert alert-danger'>
              <strong><center>No posts yet</center></strong>
        </div>";
      }

}

function post_topic($app_id, $board_id, $topic, $user, $message){

      $topic_id = "";

      $forum = new mysqli('localhost', 'root', 'Jonathan723', 'forum');


      $check = $forum->query("SELECT 1 FROM `$app_id"."_topics` LIMIT 1");

            if($check !== FALSE)
            {
              //Exists, insert topic into topic table
              $sql = "INSERT INTO `$app_id"."_topics` (board_id, topic, user, date) VALUES ($board_id, '$topic', '$user', NOW())";

              $forum->query($sql) or die($user->error);

              $sql = "SELECT topic_id FROM `$app_id"."_topics` WHERE topic = '$topic' AND user = '$user'";

              $result = $forum->query($sql);
              $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
              $topic_id = $row["topic_id"];

              $sql = "INSERT INTO `$app_id"."_messages` (topic_id, board_id, message, user, date) VALUES ($topic_id, $board_id, '$message', '$user', NOW())";

              $forum->query($sql) or die($forum->error);

            }
            else
            {
                //Doesn't exist, make topic table for game, insert topic
                $forum->query("
                CREATE TABLE `$app_id"."_topics`
                (
                    board_id INT NOT NULL,
                    topic_id INT NOT NULL AUTO_INCREMENT,
                    topic VARCHAR(50) NOT NULL,
                    user VARCHAR(50) NOT NULL,
                    date TIMESTAMP NOT NULL,
                    PRIMARY KEY (topic_id)
                );") or die($forum->error);

                $sql = "INSERT INTO `$app_id"."_topics` (board_id, topic, user, date) VALUES ($board_id, '$topic', '$user', NOW())";

                $forum->query($sql) or die($forum->error);

                $forum->query("
                CREATE TABLE `$app_id"."_messages`
                (
                  mess_id INT NOT NULL AUTO_INCREMENT,
                  board_id INT NOT NULL,
                  topic_id INT NOT NULL,
                  message LONGTEXT NOT NULL,
                  user VARCHAR(50) NOT NULL,
                  date TIMESTAMP NOT NULL,
                  PRIMARY KEY(mess_id)
                );") or die($forum->error);

                $sql = "SELECT topic_id FROM `$app_id"."_topics` WHERE topic = '$topic' AND user = '$user'";
                echo $sql;
                $result = $forum->query($sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $topic_id = $row["topic_id"];
                //$row = $result->fetch_assoc();
                //echo $row["topic_id"];

                $sql = "INSERT INTO `$app_id"."_messages` (topic_id, board_id, message, user, date) VALUES ($topic_id, $board_id, '$message', '$user', NOW())";
                echo $sql;

                $forum->query($sql) or die($forum->error);

            }


}

function display_messages($app_id, $board_id, $topic_id){

      // Create connection
      $forum = new mysqli('localhost', 'root', 'Jonathan723', 'forum');

      $sql = "SELECT * FROM `$app_id"."_messages` WHERE `board_id` = $board_id AND `topic_id` = $topic_id ORDER BY date ASC";
      $result = $forum->query($sql);


      if ($result->num_rows > 0) {
          echo "<table><tr><th>Posted by</th><th>Message</th></tr>";

          // output data of each row
          while($row = $result->fetch_assoc()) {

              //echo "<tr><td>".$row["message"]."</td>"."<td>".$row["user"]."<br>".$row["date"]."</td></tr>";
              echo "<tr><td align='left' width='20%'>".$row["user"]."<br><br>".$row["date"]."</td>"."<td align='left' width='80%'>".$row["message"]."</td></tr>";

          }
          echo "</table>";
      }
      else {
        echo "
        <div class='alert alert-danger'>
              <strong><center>No posts yet</center></strong>
        </div>";
      }

}

function post_message($app_id, $board_id, $topic_id, $user, $message){

      $forum = new mysqli('localhost', 'root', 'Jonathan723', 'forum');

      $sql = "INSERT INTO `$app_id"."_messages` (board_id, topic_id, message, user, date) VALUES ($board_id, $topic_id, '$message', '$user', NOW())";

      $forum->query($sql) or die($user->error);

}

?>
