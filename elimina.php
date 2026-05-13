<?php
ob_start();
include 'connessione.php';

if (isset($_GET['id_film'])) {
    $id = $conn->real_escape_string($_GET['id_film']);
    $sql = "DELETE FROM Film WHERE id_film = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        ob_end_flush();
        exit;
    } else {
        echo "Errore eliminazione: " . $conn->error;
        ob_end_flush();
        exit;
    }
}

header('Location: index.php');
ob_end_flush();
exit;

?>
