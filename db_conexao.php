<?php

$sname= "localhost";
$uname="root";
$password="";

$db_name="producao";

$conn=mysqli_connect($sname,$uname,$password,$db_name);

if (!$conn){
	echo "Conexão falhou!";
	exit();
}