<?php include 'connessione.php'; ?>
<?php
$message = '';
$messageClass = '';

if (isset($_POST['aggiungi'])) {
    $id_film = $conn->real_escape_string(trim($_POST['id_film']));
    $titolo = $conn->real_escape_string(trim($_POST['titolo']));
    $anno = $conn->real_escape_string(trim($_POST['anno']));
    $id_regista = $conn->real_escape_string(trim($_POST['id_regista']));

    $sql = "INSERT INTO Film (id_film, titolo, anno, id_regista) VALUES ('$id_film', '$titolo', '$anno', '$id_regista')";

    if ($conn->query($sql)) {
        $message = 'Film aggiunto con successo.';
        $messageClass = 'success';
    } else {
        $message = 'Errore durante l\'inserimento: ' . $conn->error;
        $messageClass = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinemaDB</title>
    <style>
        :root {
            --color-60: #40bcf4; 
            --color-30: #ff8000; 
            --color-10: #00e054; 
            --color-60-tint: rgba(64,188,244,0.12);
            --color-60-tint-strong: rgba(64,188,244,0.18);
            --color-30-tint: rgba(255,128,0,0.12);
            color-scheme: dark;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #14181C;
            color: #e6eef8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            display: flex;
            justify-content: center;
            background: #14181C;
        }

        main {
            width: min(1180px, 100%);
        }

        .panel {
            background: #0f1418;
            border: 1px solid rgba(255,255,255,0.04);
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(3, 7, 11, 0.6);
            overflow: hidden;
        }

        .hero {
            padding: 32px 32px 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .hero h1 {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.4rem);
            letter-spacing: -0.03em;
            color: var(--color-60);
        }

        .hero p {
            margin: 0;
            color: #475569;
            line-height: 1.7;
        }

        .content {
            display: grid;
            gap: 24px;
            padding: 0 32px 32px;
        }

        .card {
            background: #0b0f12;
            border: 1px solid rgba(255,255,255,0.03);
            border-radius: 20px;
            padding: 24px;
        }

        form {
            display: grid;
            gap: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: #cbd5e1;
        }

        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 14px;
            background: #091014;
            color: #e6eef8;
            font-size: 1rem;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--color-30);
            box-shadow: 0 0 0 4px rgba(255,128,0,0.12);
        }

        .grid-2 {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .btn {
            width: fit-content;
            padding: 14px 20px;
            border: none;
            border-radius: 14px;
            background: var(--color-30);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.12s ease, filter 0.12s ease;
        }

        .btn:hover {
            filter: brightness(0.92);
            transform: translateY(-1px);
        }

        .message {
            padding: 16px 18px;
            border-radius: 16px;
            font-weight: 600;
            line-height: 1.5;
            color: #071217;
        }

        .success {
            background: rgba(0,224,84,0.16);
            border: 1px solid rgba(0,224,84,0.28);
            color: #00220f;
        }

        .error {
            background: rgba(255,128,0,0.16);
            border: 1px solid rgba(255,128,0,0.28);
            color: #2b1400;
        }

        .tables {
            display: grid;
            gap: 24px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 520px;
        }

        th,
        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            text-align: left;
            font-size: 0.96rem;
            color: #e6eef8;
        }

        th {
            background: rgba(64,188,244,0.12);
            color: var(--color-60);
            font-weight: 700;
        }

        a.action-link {
            color: var(--color-30);
            text-decoration: none;
            font-weight: 600;
        }

        a.action-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }

            .hero,
            .content {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media (max-width: 640px) {
            body {
                padding: 16px;
            }

            .hero,
            .content {
                padding-left: 16px;
                padding-right: 16px;
            }
        }
    </style>
</head>
<body>
<main>
    <section class="panel">
        <div class="hero">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
                <h1>CinemaDB</h1>
                <div>
                    <a href="registi.php" class="btn" style="background:transparent;color:var(--color-60);border:1px solid var(--color-60);padding:10px 14px;border-radius:12px;">Registi</a>
                </div>
            </div>
        </div>
        <div class="content">
            <?php if ($message): ?>
                <div class="message <?= $messageClass ?>"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <div class="card">
                <form method="POST" autocomplete="off">
                    <div class="grid-2">
                        <div>
                            <label for="id_film">ID film</label>
                            <input type="text" id="id_film" name="id_film" placeholder="Esempio: 1" required>
                        </div>
                        <div>
                            <label for="titolo">Titolo</label>
                            <input type="text" id="titolo" name="titolo" placeholder="Titolo del film" required>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div>
                            <label for="anno">Anno</label>
                            <input type="text" id="anno" name="anno" placeholder="2026" required>
                        </div>
                        <div>
                            <label for="id_regista">ID regista</label>
                            <input type="text" id="id_regista" name="id_regista" placeholder="Esempio: 12" required>
                        </div>
                    </div>
                    <button type="submit" name="aggiungi" class="btn">Aggiungi film</button>
                </form>
            </div>

            <div class="tables">
                <div class="card table-wrap">
                    <h2 style="margin-top: 0;">Film</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titolo</th>
                                <th>Anno</th>
                                <th>ID regista</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM Film";
                        $result = $conn->query($sql);

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['id_film']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['titolo']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['anno']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['id_regista']) . '</td>';
                                echo '<td><a class="action-link" href="elimina.php?id_film=' . urlencode($row['id_film']) . '" onclick="return confirm(\'Confermi eliminazione?\');">Elimina</a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="card table-wrap">
                    <h2 style="margin-top: 0;">Registi</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Nazionalità</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql2 = "SELECT * FROM Registi";
                        $result2 = $conn->query($sql2);

                        if ($result2) {
                            while ($r = $result2->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($r['id_regista']) . '</td>';
                                echo '<td>' . htmlspecialchars($r['nome']) . '</td>';
                                echo '<td>' . htmlspecialchars($r['cognome']) . '</td>';
                                $naz = $r['nazionalit\xc3\xa0'] ?? $r['nazionalita'] ?? $r['nazionalità'] ?? '';
                                echo '<td>' . htmlspecialchars($naz) . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>
