<?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("bank_deets.csv", "a");
  $no_rows = count(file("bank_deets.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css?family=Adamina' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      body{
        background-image: linear-gradient(#343A40,#5E2E33);
        height: 150vh;
        width: 100vw;
        
      }
      h2{
        font-family: 'Adamina';
      }
      hr{
        background-color: white;
        
      }

      .card
        {   
            -webkit-box-shadow: 10px 10px 47px -9px rgba(0,0,0,0.75);
            -moz-box-shadow: 10px 10px 47px -9px rgba(0,0,0,0.75);
            box-shadow: 10px 10px 47px -9px rgba(0,0,0,0.75);

        }

        /* .card:hover{
          border-color: white;
        } */
    </style>

  </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="font-family: 'Adamina';">Online Blood Bank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.html"> <button type="button" class="btn btn-dark">Home</button> <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="homepage.html"> <button type="button" class="btn btn-dark">Blood Bank</button> <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="login.html"> <button type="button" class="btn btn-dark">Admin Login</button> <span class="sr-only"></span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="#"> <button type="button" class="btn btn-dark">About Us</button> <span class="sr-only"></span></a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-dark" type="submit">Search</button>
          </form>
        </div>
      </nav>
<div class="container" style="margin-top: 4%;">
  <div class="row">
    <div class="col-3">
      <!-- blank column of 3 units -->
  </div>

  <div class="col-6">

      <div class="card text-center" style="margin-top:40px; background-color: rgb(52,58,64, 0.3);">
                  <div class="card-header" style="color: white;" >
                     <strong>SIGN UP</strong>
                  </div>
                  
                  <div class="card-body">
                          <form method="post">
                          <h3 align="center">Contact Form</h3>
     <br>
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Blood Bank Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Location</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Location" value="<?php echo $subject; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Address</label>
      <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
                          </form>
                  </div>
              
              <div class="card-footer text-muted">
                  <a href="login.html" style="text-decoration: none; color: white;">Already have an account? Log in</a>
              </div>
      </div>

  </div>
  
  <div class="col-3">
      <!-- blank column of 3 units -->
  </div>
  </div>
</div>


</body>
</html>