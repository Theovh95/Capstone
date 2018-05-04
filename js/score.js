function score_go(user_id) {
  $('#processing').show();
    // Create our XMLHttpRequest object
  var hr = new XMLHttpRequest();
  // Create some variables we need to send to our PHP file
  var url = "my_score_parse_file.php";
  var uid = user_id;
  var sc = document.getElementById("score_input").value;
  var vars = "user_id="+uid+"&score="+sc;
  hr.open("POST", url, true);
  // Set content type header information for sending url encoded variables in the request
  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // Access the onreadystatechange event for the XMLHttpRequest object
  hr.onreadystatechange = function() {
    if(hr.readyState == 4 && hr.status == 200) {
      var return_data = hr.responseText;
      
  if(return_data == "no_sucess") {

        alert("something went wrong your score of " + $sc + " has not been saved!");
        $('#processing').hide();
      } else {
        alert("You have scored '"+ sc + "' points");

        $('#processing').hide();
        $('#leaderboard').html(return_data);
      }      
    }
  }
  
  // Send the data to PHP now... and wait for response to update the status div
  hr.send(vars); // Actually execute the request

}