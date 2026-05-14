<?php
include 'connessione.php';

if (!empty($_GET['id_regista'])) {
    $id = $conn->real_escape_string($_GET['id_regista']);
    $sql = "DELETE FROM Registi WHERE id_regista = '$id'";
    $conn->query($sql);
}

header('Location: registi.php');
exit;
