<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Adatok feldolgozása</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Űrlap adatok lekérése
    $nev = isset($_POST['nev']) ? trim($_POST['nev']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $darab = isset($_POST['darab']) ? trim($_POST['darab']) : '';
    $nap = isset($_POST['nap']) ? trim($_POST['nap']) : '';

    $mindenHelyes = true;

    // a, b) Név ellenőrzése
    $nevHelyes = (!empty($nev) && strlen($nev) >= 8 && strlen($nev) <= 30);
    if (!$nevHelyes) $mindenHelyes = false;
    echo "Név: " . htmlspecialchars($nev) . ($nevHelyes ? " Helyes" : " Hibás!") . "<br>";

    // c) Email ellenőrzése
    $checkPattern = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
    $emailHelyes = preg_match($checkPattern, $email);
    if (!$emailHelyes) $mindenHelyes = false;
    echo "E-mail: " . htmlspecialchars($email) . ($emailHelyes ? " Helyes" : " Hibás!") . "<br>";

    // d) Darab ellenőrzése
    $darabHelyes = (is_numeric($darab) && $darab >= 1 && $darab <= 10 && filter_var($darab, FILTER_VALIDATE_INT));
    if (!$darabHelyes) $mindenHelyes = false;
    echo "Darab: " . htmlspecialchars($darab) . ($darabHelyes ? " Helyes" : " Hibás!") . "<br>";

    // e) Nap ellenőrzése
    $napok = ["hétfő", "kedd", "szerda", "csütörtök", "péntek"];
    $napHelyes = in_array($nap, $napok);
    if (!$napHelyes) $mindenHelyes = false;
    echo "Nap: " . htmlspecialchars($nap) . ($napHelyes ? " Helyes" : " Hibás!") . "<br><br>";

    // Adatbázisba mentés, ha minden adat megfelelő
    if ($mindenHelyes) {
        try {
            // Kapcsolódás (a XAMPP alapbeállításait feltételezve)
            $pdo = new PDO('mysql:host=localhost;dbname=aruhaz', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $pdo->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

            // Biztonságos preparált utasítás használata a beszúráshoz
            $sqlInsert = "INSERT INTO rendeles (nev, email, darab, nap) VALUES (:nev, :email, :darab, :nap)";
            $stmt = $pdo->prepare($sqlInsert);
            $stmt->execute(array(
                ':nev' => $nev,
                ':email' => $email,
                ':darab' => $darab,
                ':nap' => $nap
            ));

            echo "<strong>A rendelés sikeresen rögzítve az adatbázisban!</strong>";

        } catch (PDOException $e) {
            echo "Adatbázis hiba történt: " . $e->getMessage();
        }
    } else {
        echo "<strong>A mentés sikertelen az adatok hibája miatt.</strong>";
    }
} else {
    echo "Nincs elküldött űrlap adat!";
}
?>
</body>
</html>