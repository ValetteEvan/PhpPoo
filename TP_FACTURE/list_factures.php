<?php
require_once 'config/db.php';

$success = '';
$error = '';

// Récupérer les clients pour le filtre
try {
    $stmtClients = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS ORDER BY nom, prenom");
    $clients = $stmtClients->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des clients : " . $e->getMessage());
}

// Construction de la requête avec filtres
$sql = "SELECT f.*, c.nom, c.prenom
        FROM FACTURES f
        INNER JOIN CLIENTS c ON f.id_client = c.id_client
        WHERE 1=1";

$params = [];

// Filtre par client
if (isset($_GET['client']) && !empty($_GET['client'])) {
    $sql .= " AND f.id_client = ?";
    $params[] = $_GET['client'];
}

// Filtre par date de début
if (isset($_GET['date_debut']) && !empty($_GET['date_debut'])) {
    $sql .= " AND DATE(f.date_creation) >= ?";
    $params[] = $_GET['date_debut'];
}

// Filtre par date de fin
if (isset($_GET['date_fin']) && !empty($_GET['date_fin'])) {
    $sql .= " AND DATE(f.date_creation) <= ?";
    $params[] = $_GET['date_fin'];
}

$sql .= " ORDER BY f.date_creation DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $factures = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des factures : " . $e->getMessage());
}

// Gestion de la suppression
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    try {
        $stmtDelete = $pdo->prepare("DELETE FROM FACTURES WHERE id_facture = ?");
        $stmtDelete->execute([$_GET['delete']]);
        $success = "Facture supprimée avec succès !";
        header("Location: list_factures.php");
        exit();
    } catch (PDOException $e) {
        $error = "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures</title>
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
                <a class="nav-link active" href="list_factures.php">Liste Factures</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Recherche Avancée</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="" class="row g-3">
                    <div class="col-md-4">
                        <label for="date_debut" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut"
                               value="<?= isset($_GET['date_debut']) ? htmlspecialchars($_GET['date_debut']) : '' ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="date_fin" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin"
                               value="<?= isset($_GET['date_fin']) ? htmlspecialchars($_GET['date_fin']) : '' ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="client" class="form-label">Client</label>
                        <select class="form-select" id="client" name="client">
                            <option value="">Tous les clients</option>
                            <?php foreach ($clients as $client): ?>
                                <option value="<?= $client['id_client'] ?>"
                                        <?= (isset($_GET['client']) && $_GET['client'] == $client['id_client']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-info text-white">Rechercher</button>
                        <a href="list_factures.php" class="btn btn-secondary">Réinitialiser</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Liste des Factures</h4>
                <a href="add_facture.php" class="btn btn-light btn-sm">+ Nouvelle Facture</a>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (empty($factures)): ?>
                    <div class="alert alert-info text-center">
                        Aucune facture trouvée dans la base de données.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>N° Facture</th>
                                    <th>Client</th>
                                    <th>Produits</th>
                                    <th>Quantité</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($factures as $facture): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($facture['id_facture']) ?></td>
                                        <td><?= htmlspecialchars($facture['nom'] . ' ' . $facture['prenom']) ?></td>
                                        <td><?= htmlspecialchars(substr($facture['produits'], 0, 50)) ?><?= strlen($facture['produits']) > 50 ? '...' : '' ?></td>
                                        <td><?= htmlspecialchars($facture['quantite']) ?></td>
                                        <td><?= number_format($facture['montant'], 2, ',', ' ') ?> €</td>
                                        <td><?= date('d/m/Y H:i', strtotime($facture['date_creation'])) ?></td>
                                        <td>
                                            <a href="edit_facture.php?id=<?= $facture['id_facture'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                            <a href="list_factures.php?delete=<?= $facture['id_facture'] ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture ?')">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-muted mt-2">
                        Total : <?= count($factures) ?> facture(s)
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
