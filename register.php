<?php
include('conn.php');

if(isset($_POST['submit'])){

print_r($_POST);

$username = $_POST['username'];
$password =  $_POST['password'];
$phone =  $_POST['phone'];
$email = $_POST['email'];

$query1="INSERT INTO `user`(`username`, `phone`, `email`, `password`) VALUES ('$username',$phone,'$email','$password')";

$res1 = mysqli_query($conn,$query1);

//echo($query1);
//echo($res1);

echo('<script>alert("Registered succesfully now please login")</script>');

echo('<script>window.location="login.html"</script>');

}
else{

    echo('<script>alert("Registeration unsuccesful")</script>');

echo('<script>window.location="index.html"</script>');
}
?>