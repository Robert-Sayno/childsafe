<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="../resorce/css/style.css" rel="stylesheet">

    <title>Admin Login - Employee Management System</title>
    <style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .bg {
        background-image: url("../background.jpg");
        height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
</head>
<body>

<?php 
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$email_err = $pass_err = $login_Err = "";
$email = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
  if (empty($_REQUEST["email"])) {
   $email_err = "<p style='color:red'> * Email Cannot Be Empty</p>";
  } else {
   $email = $_REQUEST["email"];
  }

  if (empty($_REQUEST["password"])) {
   $pass_err = "<p style='color:red'> * Password Cannot Be Empty</p>";
  } else {
    $pass = $_REQUEST["password"];
  }

  if (!empty($email) && !empty($pass)) {
    // database connection
    require_once "../connection.php";

    $sql_query = "SELECT * FROM admins WHERE email='$email' && password = '$pass'  ";
    $result = mysqli_query($conn, $sql_query);

    if (mysqli_num_rows($result) > 0) {
      while ($rows = mysqli_fetch_assoc($result)) {
        session_start();
        session_unset();
        $_SESSION["email"] = $rows["email"];
        header("Location: dashboard.php?login-success");
        exit(); // Terminate the script after redirecting
      }
    } else {
      $login_Err = "<div class='alert alert-warning alert-dismissible fade show'>
      <strong>Invalid Email/Password</strong>
      <button type='button' class='close' data-dismiss='alert' >
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
  }
}

?>
 
<div class="bg">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">
                              
                                <h4 class="text-center">Hello, Admin</h4>
                                <div class="text-center my-5"><?php echo $login_Err; ?></div>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                
                                    <div class="form-group">
                                        <label >Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                        <?php echo $email_err; ?>       
                                    </div>

                                    <div class="form-group">
                                        <label >Password :</label>
                                        <input type="password" class="form-control" name="password">
                                        <?php echo $pass_err; ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Log-In" class="btn btn-primary btn-lg w-100" name="signin">
                                    </div>
                                <p class=" login-form__footer">forgot password? <a href="../employee/login.php" class="text-primary">reset </a>your password now</p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./resorce/plugins/common/common.min.js"></script>
<script src="./resorce/js/custom.min.js"></script>
<script src="./resorce/js/settings.js"></script>
<script src="./resorce/js/gleek.js"></script>
<script src="./resorce/js/styleSwitcher.js"></script>
</body>
</html>
