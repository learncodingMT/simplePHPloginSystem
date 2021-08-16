<?php
    $showErr = false;
    $showErr2 = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    if(($_REQUEST['password']=="")|| ($_REQUEST['username']=="")){
        $showErr2 = true;
    }else{
      include 'partition/conn.php';
        $sql = "SELECT * FROM user2000 WHERE Username = :uname";

        $result = $conn->prepare($sql);

        $result->bindParam(':uname', $uname, PDO::PARAM_STR);

        $uname = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $result->execute();

        $num = $result->rowCount();
        if($num==1){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                if(password_verify($password, $row['Password'])){
                    session_start();
                    $_SESSION['LoggedIn'] = true;
                    $_SESSION['uname'] = $uname;
                    header("Location: welcome.php");
                }else{
                    $showErr = true;
                }
            }
        }else{
            $showErr = true;
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
// if($showAlert){
// echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
//   <strong>Success!</strong> Your registration is successfully done.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// } 
if($showErr){
echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Miss!</strong> Invalid Credentials.
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
// if($exist){
// echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
//   <strong>Wrong!</strong> Username is Already Exists.
//   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
// </div>';
// } 
?>
<div class="container my-4 col-sm-6">
<form action="" method="POST">
<h2 class="text-center">Login to our website</h2>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
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