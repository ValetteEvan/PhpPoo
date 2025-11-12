<?php
require_once 'config/autoload.php';

$pdo = Database::getInstance();
$clientManager = new ClientManager($pdo);

try {
    $clients = $clientManager->findAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des clients : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gestion Factures</a>
            <div class="navbar-nav">
                <a class="nav-link" href="add_client.php">Ajouter Client</a>
                <a class="nav-link active" href="list_clients.php">Liste Clients</a>
                <a class="nav-link" href="add_facture.php">Ajouter Facture</a>
                <a class="nav-link" href="list_factures.php">Liste Factures</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Liste des Clients</h4>
                <a href="add_client.php" class="btn btn-light btn-sm">+ Nouveau Client</a>
            </div>
            <div class="card-body">
                <?php if (empty($clients)): ?>
                    <div class="alert alert-info text-center">
                        Aucun client trouvé dans la base de données.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Sexe</th>
                                    <th>Date de Naissance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $client): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($client->getId()) ?></td>
                                        <td><?= htmlspecialchars($client->getNom()) ?></td>
                                        <td><?= htmlspecialchars($client->getPrenom()) ?></td>
                                        <td><?= $client->getSexeLibelle() ?></td>
                                        <td><?= $client->getDateNaissanceFormatee() ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-muted mt-2">
                        Total : <?= count($clients) ?> client(s)
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
