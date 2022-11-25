<?php
$login = $_POST['login'];
$entrar = $_POST['entrar'];
$senha = $_POST['senha'];
$sname= "localhost";
$uname="root";
$password="";

$db_name="producao";

$conn=mysqli_connect($sname,$uname,$password,$db_name);
  if (isset($entrar)) {

    $verifica = mysqli_query($conn,"SELECT * FROM paciente WHERE usuario =
    '$login' AND senha = '$senha'") or die("erro ao selecionar");
      if (mysqli_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='login.html';</script>";
        die();
      }else{
        setcookie("login",$login);
        header("Location:agenda.html");
      }
  }
?>