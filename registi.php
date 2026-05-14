<?php include 'connessione.php'; ?>
<?php
$message = '';
$messageClass = '';

if (isset($_POST['aggiungi_regista'])) {
    $id_regista = $conn->real_escape_string(trim($_POST['id_regista']));
    $nome = $conn->real_escape_string(trim($_POST['nome']));
    $cognome = $conn->real_escape_string(trim($_POST['cognome']));
    $nazionalita = $conn->real_escape_string(trim($_POST['nazionalita']));

    $sql = "INSERT INTO Registi (id_regista, nome, cognome, nazionalita) VALUES ('$id_regista', '$nome', '$cognome', '$nazionalita')";

    if ($conn->query($sql)) {
        $message = 'Regista aggiunto con successo.';
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
    <title>Registi — CinemaDB</title>
    <style>
        
        :root {
            --color-60: #40bcf4;
            --color-30: #ff8000;
            --color-10: #00e054;
            --color-60-tint: rgba(64,188,244,0.12);
            color-scheme: dark;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #14181C;
            color: #e6eef8;
        }
        * { box-sizing: border-box; }
        body { margin:0; min-height:100vh; padding:24px; display:flex; justify-content:center; background:#14181C; }
        main { width: min(1180px, 100%); }
        .panel { background:#0f1418; border:1px solid rgba(255,255,255,0.04); border-radius:24px; box-shadow:0 12px 40px rgba(3,7,11,0.6); overflow:hidden; }
        .hero { padding:32px 32px 24px; display:flex; flex-direction:column; gap:10px; }
        .hero h1 { margin:0; font-size:clamp(2rem,3vw,2.4rem); color:var(--color-60); }
        .hero p { margin:0; color:#cbd5e1 }
        .content { display:grid; gap:24px; padding:0 32px 32px; }
        .card { background:#0b0f12; border:1px solid rgba(255,255,255,0.03); border-radius:20px; padding:24px; }
        label { display:block; margin-bottom:8px; font-size:0.95rem; color:#cbd5e1 }
        input[type="text"] { width:100%; padding:14px 16px; border:1px solid rgba(255,255,255,0.06); border-radius:14px; background:#091014; color:#e6eef8 }
        .grid-2 { display:grid; gap:16px; grid-template-columns:repeat(2,minmax(0,1fr)); }
        .btn { padding:12px 16px; border-radius:12px; background:var(--color-30); color:#071217; font-weight:700; border:none; cursor:pointer }
        table { width:100%; border-collapse:collapse; min-width:520px }
        th, td { padding:12px 14px; border-bottom:1px solid rgba(255,255,255,0.03); color:#e6eef8 }
        th { background: rgba(64,188,244,0.12); color:var(--color-60); font-weight:700 }
        a.action-link { color:var(--color-30); font-weight:600; text-decoration:none }
        a.action-link:hover { text-decoration:underline }
    </style>
</head>
<body>
<main>
    <section class="panel">
        <div class="hero">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
                <h1>Registi</h1>
                <div>
                    <a href="index.php" class="btn" style="background:transparent;color:var(--color-60);border:1px solid var(--color-60);padding:8px 12px;border-radius:12px;">Film</a>
                </div>
            </div>
            
        </div>
        <div class="content">
            <?php if ($message): ?>
                <div class="card"><div class="message <?= $messageClass ?>"><?= htmlspecialchars($message) ?></div></div>
            <?php endif; ?>

            <div class="card">
                <form method="POST" autocomplete="off">
                    <div class="grid-2">
                        <div>
                            <label for="id_regista">ID regista</label>
                            <input type="text" id="id_regista" name="id_regista" placeholder="Esempio: 1" required>
                        </div>
                        <div>
                            <label for="nome">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Nome" required>
                        </div>
                    </div>
                    <div class="grid-2">
                        <div>
                            <label for="cognome">Cognome</label>
                            <input type="text" id="cognome" name="cognome" placeholder="Cognome" required>
                        </div>
                        <div>
                            <label for="nazionalita">Nazionalità</label>
                            <input type="text" id="nazionalita" name="nazionalita" placeholder="Italiana" required>
                        </div>
                    </div>
                    <div style="margin-top:12px;">
                        <button type="submit" name="aggiungi_regista" class="btn">Aggiungi regista</button>
                    </div>
                </form>
            </div>

            <div class="card table-wrap">
                <h2 style="margin-top:0;">Registi</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Nazionalità</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM Registi";
                    $result = $conn->query($sql);
                    if ($result) {
                        while ($r = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($r['id_regista']) . '</td>';
                            echo '<td>' . htmlspecialchars($r['nome']) . '</td>';
                            echo '<td>' . htmlspecialchars($r['cognome']) . '</td>';
                            $naz = $r['nazionalit\\xc3\\xa0'] ?? $r['nazionalita'] ?? $r['nazionalità'] ?? '';
                            echo '<td>' . htmlspecialchars($naz) . '</td>';
                            echo '<td><a class="action-link" href="elimina_regista.php?id_regista=' . urlencode($r['id_regista']) . '" onclick="return confirm(\'Confermi eliminazione?\');">Elimina</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
</body>
</html>
