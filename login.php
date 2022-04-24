<?php
include('conn.php');

if(isset($_POST['username'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query1 ="SELECT * FROM `user` WHERE `username` = '$username'";
    $res1 = mysqli_query($conn,$query1);

    if(mysqli_num_rows($res1)>0){

        $data = mysqli_fetch_assoc($res1);
        
        if(strcmp($data['password'],$password)==0){
        

            $_SESSION['username']=$username;
            $_SESSION['phone_no']=$data['phone'];
            $_SESSION['email']=$data['email'];

            echo('<script>alert("Login succesful")</script>');

            echo('<script>window.location="register_test.php"</script>');


        }

        else{
            echo('<script>alert("Login unsuccesful. Wrong Password")</script>');

            echo('<script>window.location="login.html"</script>');      
        }
    }

    else{
        echo('<script>alert("No such user found")</script>');

        echo('<script>window.location="login.html"</script>');

    }



}
?>
