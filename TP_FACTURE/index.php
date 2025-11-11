<?php
require_once 'config/db.php';

// Récupérer les statistiques
try {
    $stmtClients = $pdo->query("SELECT COUNT(*) as total FROM CLIENTS");
    $totalClients = $stmtClients->fetch()['total'];

    $stmtFactures = $pdo->query("SELECT COUNT(*) as total FROM FACTURES");
    $totalFactures = $stmtFactures->fetch()['total'];

    $stmtMontant = $pdo->query("SELECT SUM(montant) as total FROM FACTURES");
    $totalMontant = $stmtMontant->fetch()['total'] ?? 0;

    // Dernières factures
    $stmtRecent = $pdo->query("SELECT f.*, c.nom, c.prenom
                               FROM FACTURES f
                               INNER JOIN CLIENTS c ON f.id_client = c.id_client
                               ORDER BY f.date_creation DESC
                               LIMIT 5");
    $recentFactures = $stmtRecent->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des statistiques : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Factures - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gestion Factures</a>
            <div class="navbar-nav">
                <a class="nav-link" href="add_client.php">Ajouter Client</a>
                <a class="nav-link" href="list_clients.php">Liste Clients</a>
                <a class="nav-link" href="add_facture.php">Ajouter Facture</a>
                <a class="nav-link" href="list_factures.php">Liste Factures</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="jumbotron bg-light p-5 rounded shadow mb-5">
            <h1 class="display-4">Bienvenue dans l'application de Gestion des Factures</h1>
            <p class="lead">Gérez facilement vos clients et leurs factures en quelques clics.</p>
            <hr class="my-4">
            <p>Commencez par ajouter des clients, puis créez des factures associées.</p>
            <div class="d-flex gap-2">
                <a class="btn btn-primary btn-lg" href="add_client.php" role="button">Ajouter un client</a>
                <a class="btn btn-success btn-lg" href="add_facture.php" role="button">Créer une facture</a>
            </div>
        </div>

        <h2 class="mb-4">Tableau de Bord</h2>
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Clients</h5>
                        <p class="card-text display-4"><?= $totalClients ?></p>
                        <a href="list_clients.php" class="btn btn-light">Voir la liste</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5 class="card-title">Total Factures</h5>
                        <p class="card-text display-4"><?= $totalFactures ?></p>
                        <a href="list_factures.php" class="btn btn-light">Voir la liste</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5 class="card-title">Chiffre d'Affaires</h5>
                        <p class="card-text display-4"><?= number_format($totalMontant, 2, ',', ' ') ?> €</p>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($recentFactures)): ?>
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Dernières Factures</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>N° Facture</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentFactures as $facture): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($facture['id_facture']) ?></td>
                                        <td><?= htmlspecialchars($facture['nom'] . ' ' . $facture['prenom']) ?></td>
                                        <td><?= number_format($facture['montant'], 2, ',', ' ') ?> €</td>
                                        <td><?= date('d/m/Y H:i', strtotime($facture['date_creation'])) ?></td>
                                        <td>
                                            <a href="edit_facture.php?id=<?= $facture['id_facture'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer class="bg-light mt-5 py-3">
        <div class="container text-center text-muted">
            <p class="mb-0">Application de Gestion des Factures - TP PHP PDO/MySQL</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
