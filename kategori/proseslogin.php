<?php
session_start();
include '../configdb.php';
//Get Data From FORM
$username = $_POST['username'];
$password = $_POST['password'];
$strquery = "SELECT * FROM user WHERE username = '$username'";
$query = mysqli_query($conn,$strquery);
$rowData = mysqli_fetch_assoc($query);
$rowData['password'] = md5($password);
$count = mysqli_num_rows($query);
$time = new DateTime('now');
$currentDate = $time->format('Y-m-d');
//var_dump($currentDate);
if($count > 0){
    $_SESSION['username'] = $rowData['username'];
    //$_SESSION['password'] = $rowData['password'];
    $_SESSION['last_login'] = $time;
    $sql = "UPDATE user SET user.last_login = '$currentDate' ";
    $query2 = mysqli_query($conn,$sql);
    //var_dump($_SESSION);
    header('Location: welcome.php');
}else{
    header("Location: login.php");
}

//var_dump($result);

?>