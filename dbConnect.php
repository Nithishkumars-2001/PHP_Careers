
<?php

include 'config.php';

if(isset($_POST['signUp'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

     $checkEmail = "SELECT * FROM users where email = '$email'";
     $result = $conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery = "INSERT INTO users(firstName, lastName, username, email, password)
                         VALUES ('$firstName', '$lastName', '$username', '$email', '$password')";
            if($conn->query($insertQuery)==True){
                header("location: signin.php");
            }
            else{
                echo "Error:".$conn->error;
            }

     }
}

if(isset($_POST['signIn'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $result= $conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: About.php");
        exit();
    }
    else{
        echo "Not Found, Incorrect Email or Password";
    }

}
?>