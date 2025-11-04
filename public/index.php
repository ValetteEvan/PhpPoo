<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices PHP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 {
            color: #667eea;
            margin-bottom: 1rem;
            text-align: center;
        }
        .info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
        }
        .info strong { color: #667eea; }
        pre {
            background: #282c34;
            color: #abb2bf;
            padding: 1rem;
            border-radius: 5px;
            overflow-x: auto;
            margin: 1rem 0;
        }
        .exercices {
            margin-top: 2rem;
        }
        .exercice-link {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin: 0.5rem;
            transition: background 0.3s;
        }
        .exercice-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Environnement PHP - Exercices</h1>

        <div class="info">
            <p><strong>Version PHP:</strong> <?php echo phpversion(); ?></p>
            <p><strong>Date/Heure:</strong> <?php echo date('d/m/Y H:i:s'); ?></p>
            <p><strong>Timezone:</strong> <?php echo date_default_timezone_get(); ?></p>
        </div>

        <div class="exercices">
            <h2>Vos exercices:</h2>
            <p>Créez vos fichiers PHP dans le dossier <code>exercices/</code></p>

            <?php
            $exercicesDir = __DIR__ . '/../exercices/';
            if (is_dir($exercicesDir)) {
                $fichiers = scandir($exercicesDir);
                foreach ($fichiers as $fichier) {
                    if (pathinfo($fichier, PATHINFO_EXTENSION) === 'php') {
                        echo '<a href="?exercice=' . urlencode($fichier) . '" class="exercice-link">' . htmlspecialchars($fichier) . '</a>';
                    }
                }
            }
            ?>
        </div>

        <?php
        if (isset($_GET['exercice'])) {
            $exercice = basename($_GET['exercice']);
            $fichierExercice = $exercicesDir . $exercice;

            if (file_exists($fichierExercice)) {
                echo '<h2>Résultat: ' . htmlspecialchars($exercice) . '</h2>';
                echo '<pre>';
                ob_start();
                include $fichierExercice;
                $output = ob_get_clean();
                echo htmlspecialchars($output);
                echo '</pre>';
            }
        }
        ?>
    </div>
</body>
</html>
