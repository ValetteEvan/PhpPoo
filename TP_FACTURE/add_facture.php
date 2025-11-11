<?php
require_once 'config/db.php';

$success = '';
$error = '';

// Récupérer la liste des clients 
try {
    $stmt = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS ORDER BY nom, prenom");
    $clients = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des clients : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_client = $_POST['id_client'];
    $montant = trim($_POST['montant']);
    $produits = trim($_POST['produits']);
    $quantite = trim($_POST['quantite']);

    if (empty($id_client) || empty($montant) || empty($produits) || empty($quantite)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!is_numeric($montant) || $montant <= 0) {
        $error = "Le montant doit être un nombre positif.";
    } elseif (!is_numeric($quantite) || $quantite <= 0) {
        $error = "La quantité doit être un nombre entier positif.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO FACTURES (montant, produits, quantite, id_client) VALUES (?, ?, ?, ?)");
            $stmt->execute([$montant, $produits, $quantite, $id_client]);
            $success = "Facture créée avec succès !";

            // Réinitialiser le formulaire
            $_POST = array();
        } catch (PDOException $e) {
            $error = "Erreur lors de la création de la facture : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gestion Factures</a>
            <div class="navbar-nav">
                <a class="nav-link" href="add_client.php">Ajouter Client</a>
                <a class="nav-link" href="list_clients.php">Liste Clients</a>
                <a class="nav-link active" href="add_facture.php">Ajouter Facture</a>
                <a class="nav-link" href="list_factures.php">Liste Factures</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Créer une Nouvelle Facture</h4>
                    </div>
                    <div class="card-body">
                        <?php if (empty($clients)): ?>
                            <div class="alert alert-warning">
                                Aucun client dans la base de données.
                                <a href="add_client.php" class="alert-link">Veuillez d'abord ajouter un client.</a>
                            </div>
                        <?php else: ?>
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

                            <form method="POST" action="">
                                <div class="mb-3">
                                    <label for="id_client" class="form-label">Client *</label>
                                    <select class="form-select" id="id_client" name="id_client" required>
                                        <option value="">Sélectionner un client...</option>
                                        <?php foreach ($clients as $client): ?>
                                            <option value="<?= $client['id_client'] ?>"
                                                    <?= (isset($_POST['id_client']) && $_POST['id_client'] == $client['id_client']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="produits" class="form-label">Produits *</label>
                                    <textarea class="form-control" id="produits" name="produits" rows="3" required><?= isset($_POST['produits']) ? htmlspecialchars($_POST['produits']) : '' ?></textarea>
                                    <small class="text-muted">Description des produits concernés par la facture</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="quantite" class="form-label">Quantité *</label>
                                        <input type="number" class="form-control" id="quantite" name="quantite" min="1"
                                               value="<?= isset($_POST['quantite']) ? htmlspecialchars($_POST['quantite']) : '' ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="montant" class="form-label">Montant (€) *</label>
                                        <input type="number" class="form-control" id="montant" name="montant" step="0.01" min="0.01"
                                               value="<?= isset($_POST['montant']) ? htmlspecialchars($_POST['montant']) : '' ?>" required>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                    <a href="list_factures.php" class="btn btn-secondary">Voir la liste des factures</a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
