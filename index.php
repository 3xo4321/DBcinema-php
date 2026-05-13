<?php include'connessione.php'; ?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <title>FORM</title>
    </head>
    <body>
        <h1>INSERISCI FILM</h1>
        <form method="POST">
            <label for="id_film">Inserisci id film: </label>
            <input type="text" name="id_film" placeholder="id film" required>
            <br><br>
            <label for="titolo">Inserisci titolo: </label>
            <input type="text" name="titolo" placeholder="titolo" required>
            <br><br>
            <label for="anno">Inserisci anno: </label>
            <input type="text" name="anno" placeholder="anno" required>
            <br><br>
            <label for="id_regista">Inserisci id regista: </label>
            <input type="text" name="id_regista" placeholder="id_regista" required>
            <br><br>
            <button type="sumbit" name="aggiungi">Aggiungi</button>
        </form>
        <br>
       <!-- 
        <form method="POST">
            <h1>CinemaDB</h1>
            <label for="nomeR">Inserisci id da rimuovere: </label>
            <input type="text" name="id" placeholder="id" required>
            <button type="sumbit" name="elimina">Elimina</button>
        </form> 
        -->
        <?php
        if (isset($_POST['aggiungi'])){
        $id_film=$_POST["id_film"];
        $titolo=$_POST["titolo"];
        $anno=$_POST["anno"];
        $id_regista=$_POST["id_regista"];
        $sql = "INSERT INTO Film(id_film,titolo,anno,id_regista) values('$id_film','$titolo','$anno', '$id_regista')";
        if ($conn->query($sql)){
            echo "film aggiunto";
        } else {
            echo "errore";
        }
        }
        
        /*if (isset($_POST['elimina'])){
        $id=$_POST["id"];
        $sql2 = "delete from utenti where id = $id";
        if ($conn->query($sql2)) {
            echo "utente eliminato";
        } else {
            echo "errore";
        }
        }
        */
        ?>

        <hr>

        <div style="display:flex; gap:40px; align-items:flex-start;">

        <div>
        <h1>TABELLA FILM</h1>

        <table border="1">
        <tr>
            <th>ID_FILM</th>
            <th>TITOLO</th>
            <th>ANNO</th>
            <th>ID_REGISTA</th>
        </tr>

        <?php
        $sql = "SELECT * FROM Film";

        $result = $conn->query($sql);

        if ($result) {
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>". ($row['id_film']). "</td>";
                echo "<td>". ($row['titolo']). "</td>";
                echo "<td>". ($row['anno']). "</td>";
                echo "<td>". ($row['id_regista']). "</td>";
                echo "</tr>";
            }
        }
        ?>
        </table>
        </div>

        <div>
        <h1>TABELLA REGISTI</h1>
        <table border="1">
        <tr>
            <th>ID_REGISTA</th>
            <th>NOME</th>
            <th>COGNOME</th>
            <th>NAZIONALIT&Agrave;</th>
        </tr>
        <?php
        $sql2 = "SELECT * FROM Registi";
        $result2 = $conn->query($sql2);

        if ($result2) {
            while($r = $result2->fetch_assoc()){
                echo "<tr>";
                echo "<td>". ($r['id_regista']). "</td>";
                echo "<td>". ($r['nome']). "</td>";
                echo "<td>". ($r['cognome']). "</td>";
                echo "<td>". ($r['nazionalit\xc3\xa0'] ?? $r['nazionalita'] ?? $r['nazionalità']). "</td>";
                echo "</tr>";
            }
        }
        ?>
        </table>
        </div>

        </div>
    </body>
</html>