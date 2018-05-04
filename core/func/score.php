<?php

function add_score($con, $user_id, $score) {
  $time = time();
  date_default_timezone_set('America/Chicago');
  $actual_time = date('m/d/Y h:i:s a', $time);
  $user_id = (int)$user_id;
  $query = "INSERT INTO score_tbl VALUES('', '$user_id', '$score')";

  if ($query_run = mysqli_query($con, $query)){
    return true;
  }

}

function updateLeaderboard() {
  
  $query = 'SELECT * FROM score_tbl, user_tbl WHERE score_tbl.user_id = user_tbl.user_id ORDER BY score DESC LIMIT 10';
  if($result = mysqli_query($db, $query)){
?>
    <table>
      <tr>
        <th>Rank</th>
        <th>Picture</th>
        <th>name</th>                
        <th>score</th>
      </tr>
        <?php
    $output = mysqli_fetch_assoc($result)
      ?>

      <tr>      
        <td><?= $rank ?></td>
        <td><?php echo "<img src=\"" . $output['picture'] . "\""; ?></td>
        <td><?= $output['email'] ?></td>
        <td><?= $output['score'] ?></td>
      </tr>
      <?php

  
    ?>
    </table>
<?php
    
  }else{
    die('error updating overall rating');
  }
}

function output_leaderboard($con, $limit){

  $query = 'SELECT * FROM score_tbl, user_tbl WHERE score_tbl.user_id = user_tbl.user_id ORDER BY score DESC LIMIT '.$limit.'';

  $query_run = mysqli_query($con, $query);
  echo '  <table>
  <tr>
  <th>Rank</th>
  <th>Picture</th>
  <th>Name</th>                
  <th>Score</th>
  </tr>
  ';
  $rank = 1;

  while($row = mysqli_fetch_assoc($query_run)){
    echo '
      <tr>      
        <td>' . $rank . '</td>
        <td><img src="' . $row['picture'] . '" width="50px" height="50px"></td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['score'] . '</td>
      </tr>
    ';
  $rank++;
  }
  echo '</table>';


  $user_id = $row['user_id'];
}
