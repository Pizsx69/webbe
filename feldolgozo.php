<?php
$metheto =0;

$nev =$_POST["nev"];
$email =$_POST["email"];
$darab =$_POST["darab"];
$nap =$_POST["nap"];

if(isset($nev)&&strlen($nev)>0&&strlen($nev)<30){
    echo "Név:".$nev." Helyes";
    $mentheto++;
}
else{
    echo "Név helytelen";
}

?>