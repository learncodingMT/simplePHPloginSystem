<?php
    $showAlert = false;
    $showErr = false;
    $showErr2 = false;
    $exist = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    if(($_REQUEST['username']=="")|| ($_REQUEST['password']=="")|| ($_REQUEST['cpassword']=="")|| ($_REQUEST['email']=="")){
        $showErr2 = true;
    }else{
      include 'partition/conn.php';
        $sql = "INSERT INTO user2000 (Username, Email, Password) VALUES (:username, :email, :password)";

        $result = $conn->prepare($sql);

        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $hash, PDO::PARAM_STR);

        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $cpassword = $_REQUEST['cpassword'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $hash2 = password_hash($cpassword, PASSWORD_DEFAULT);


        // start-> if username exist in database then does not create account
        $sql2 = "SELECT Username FROM user2000";
        $result2 = $conn->prepare($sql2);
        $result2->execute();
        $result2->bindColumn(1, $username2);
        while($result2->fetch(PDO::FETCH_ASSOC)){
          if($username2==$username){
            $exist = true;
            break;
          }
        }
        // end

        
        if($username2!=$username){
          if($password == $cpassword){
            $showAlert = true;
            $result->execute();
          }else{
            $showErr = true;
          } 
        }
             
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>iSecure</title>
</head>
<body>
<?php require 'partition/navbar.php'   ?>
<?php
if($showAlert){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your registration is successfully done.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} 
if($showErr){
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Miss!</strong> Your Password does not match.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($showErr2){
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Wrong!</strong> All Field Required.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($exist){
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Wrong!</strong> Username is Already Exists.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} 
?>
<div class="container my-4 col-sm-6">
<form action="/PhpLoginSystem/signup.php" method="POST">
<h2 class="text-center">Sign Up in our website</h2>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" maxlength="12" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" maxlength="16" minlength="8" class="form-control" id="password" name="password">
  </div>
  <div class="form-group">
    <label for="cpassword">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>
</html>

