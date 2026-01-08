<?php
session_start();
require 'db.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($query) === 1){
    $user = mysqli_fetch_assoc($query);

    if(password_verify($password, $user['password'])){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];

        header("Location: index.html");
        exit;
    } else {
        echo "<script>
            alert('Password salah!');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Username tidak terdaftar!');
        window.history.back();
    </script>";
}
