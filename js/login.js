function toggle_login() {
  var $login_slider_div = $('#login_div');
  var $login_carrot_img = $('#login_carrot');
  
  $login_slider_div.slideToggle();
  
  if ($login_carrot_img.attr('src') === 'images/up_carrot3.png'){
      $login_carrot_img.attr('src', 'images/down_carrot3.png');
  }else{
      $login_carrot_img.attr('src', 'images/up_carrot3.png');

  }
  
  return false;
}







