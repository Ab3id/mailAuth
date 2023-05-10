<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="form login_form">
            <span><center>User Login</center></span>
          <form class="form" action="#" id="login_form" method="POST">
          <div class="inp-container">
                <input type="text" placeholder="Email" id="email" name="email" autocomplete="false" class="textinput" required>
            </div>
            <div class="inp-container">
                <input type="password" placeholder="Password" id="password" name="password" class="textinput" autocomplete="false" required>
            </div>

            <div class="inp-container">
                <button type="submit" class="btn">Login</button>
            </div>

            <span id="error_span"></span>
          </form>
        </div>

        <div class="form otp_form">
            <span><center>Account Verification</center></span>
            <span class="welcome_message"></span>
          <form class="form" action="#" id="otp_form" method="POST">
          <div class="inp-container">
                <input type="number" placeholder="OTP CODE" id="otp" name="otp" autocomplete="false" class="textinput" required>
            </div>
            <input type="hidden"  name="user_id" id="user_id"/>

            <div class="inp-container">
                <button type="submit" class="btn">Verify</button>
            </div>

            <span id="error_span2">s</span>
          </form>
        </div>
    </div>
</body>

<script>

$(document).ready(function () {

    $('#otp_form').submit(function (event){
        console.log('hey2');
    event.preventDefault();

    var formData = {
      code: $("#otp").val(),
      action: 'otp_verify',
      uid: $('#user_id').val()
    };
    $.ajax({
      type: "POST",
      url: "processor.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log('trs',data.error);
      if(data.action == 'otp_verify' && data.error != ''){
        $('#error_span2').text(data.error);
      }else{
        $('#error_span2').text('');
      }

      if(data.action == 'otp_verify' && data.error == ''){
        //go to dashboard
        window.location = "dashboard.php";
      }
    }).fail(function(xhr, status, error) {
        console.log('error ',error.toString());
    });

    });
   
  $("#login_form").submit(function (event) {
    console.log('hey');
    event.preventDefault();
    var formData = {
      email: $("#email").val(),
      password: $("#password").val(),
      action: 'act_login'
    };
    console.log('hey ',formData);
    $.ajax({
      type: "POST",
      url: "processor.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log('trs',data);
      if(data.action == 'login' && data.error != ''){
        $('#error_span').text(data.error);
      }else{
        $('#error_span').text('');
      }

      if(data.action == 'login' && data.error == ''){
        //show otp field
        $('#user_id').val(data.user_id);
        $('.login_form').hide();
        $('.otp_form').css("display", "flex");
        var message = "Hi ".concat(data.name,',',' ',data.message)
        $('.welcome_message').text(message);
      }
    }).fail(function(xhr, status, error) {
        console.log('error ',error.toString());
    });

    
  });
});

</script>
</html>