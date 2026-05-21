<?php
 
$mentheto = 0;
$email = $_POST["email"] ?? "";
$nev = $_POST["name"] ?? "";
$jelszo = $_POST["pw"] ?? "";
$kor = $_POST["age"] ?? "";
$nem = $_POST["gender"] ?? "";
 
$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
if (!preg_match($re, $email)) {
    echo "Email: $email Hibás!<br>";
} else {
    echo "Email: $email Helyes<br>";
    $mentheto++;
}

if (strlen($nev) >= 5 && strlen($nev) <= 30) {
    echo "Név: $nev Helyes<br>";
    $mentheto++;
} else {
    echo "Név: $nev Hibás!<br>";
}

 
if (strlen($jelszo) >= 6 && strlen($jelszo) <= 12) {
    echo "Jelszó: Helyes<br>";
    $mentheto++;
} else {
    echo "Jelszó: Hibás!<br>";
}

if (is_numeric($kor) && $kor >= 18 && $kor <= 100) {
    echo "Kor: $kor Helyes<br>";
    $mentheto++;
} else {
    echo "Kor: $kor Hibás!<br>";
}
 
// Nem ellenőrzés
if ($nem === "woman" || $nem === "man") {
    echo "Nem: $nem Helyes<br>";
    $mentheto++;
} else {
    echo "Nem: Hibás!<br>";
}
	 
 if ($mentheto < 5) {
  die("Adatok nem menthetőek!</br >");
 }
 
try {
 // Kapcsolódás:
 $dbh = new PDO(
    'mysql:host=localhost;dbname=regisztracio',
    'root',
    '',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
    );
 $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

$sqlInsert = "INSERT INTO regisztracio(email, nev,jelszo,kor,nem )
              VALUES (:email, :nev, :jelszo,:kor,:nem)";

 $stmt = $dbh->prepare($sqlInsert);

 $stmt->execute([
    ':email' => $email,
    ':nev' => $nev,
    ':jelszo' => $jelszo,
    ':kor' => $kor,
    ':nem' => $nem
    ]);
    
  echo "Rendelés mentve.";
}catch (PDOException $e) { // kivételkezelés ha pl. nem találja az adatbázist
 echo "Hiba: ".$e->getMessage();
 } 
 
 ?>