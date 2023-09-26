<?php
$Servername="localhost";
$Username="root";
$password="";
$database="nextg1";

$conn=mysqli_connect($Servername,$Username,$password,$database);
if(!$conn){
    die("not connected". mysqli_connect_error());
}
// else{
//     echo "connection was successfull!!!";
// }
?>