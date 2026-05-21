<?php
try{
    $nev=$_POST["nev"];
    $email=$_POST["email"];
    $darab=$_POST["darab"];
    $nap=$_POST["nap"];
    $conn=new PDO("mysql:host=localhost;dbname=aruhaz","root","");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="INSERT INTO rendeles(nev,email,darab,nap) VALUES ('$nev','$email','$darab','$nap')";
    $conn->exec($sql);
    echo "Sikeres rendelés!";
}
catch(PDOException $e){
    echo "Hiba: ".$e->getMessage();
}
?>