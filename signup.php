<?php
include 'connect.php';
$showalert=false;
$err=false;
$exist=false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username=$_POST["username"];
  $password=$_POST["password"];
  $cpassword=$_POST["cpassword"];
  
  $existsql="select * from loginsystem where username='$username'";
  $result=mysqli_query($conn,$existsql);
  $existusername=mysqli_num_rows($result);
  if($existusername > 0){
    $err="Username already exist Please choose a different Username";
  }
  else{
    
    if($password == $cpassword){
      $hash=password_hash($password, PASSWORD_DEFAULT);
      $sql="INSERT INTO `loginsystem` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
      $result=mysqli_query($conn,$sql);
      if($result){
        $showalert=true;
      }
      
    }
    else{
      $err="Your password and Confirm password do not match.";
    }
  }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOURtime | signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">YOURtime</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact us</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
        <a href="login.php" class="btn btn-outline-success">Login</a>
      </form>
    </div>
  </div>
</nav>

<?php
if($err){
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Oops!</strong> $err 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}
if($showalert){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> You are successfully SignedIn.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

}
if($exist){
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Sorry!</strong> Username Already Exist.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
?>
  <div class="container my-3" >

<form action="signup.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">User name</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="Help">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="pass" name="password">
    </div>
    <div class="mb-3">
        <label for="cpass" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="cpass" name="cpassword">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<?php
if($showalert){
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
Please <a href='login.php' class='text-decoration-none'>Login</a> to go to the Dashboard.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
?>

  </body>
</html>