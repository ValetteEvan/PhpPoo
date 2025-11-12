<?php
require_once 'config/autoload.php';

$pdo = Database::getInstance();
$clientManager = new ClientManager($pdo);
$factureManager = new FactureManager($pdo);

$success = '';
$error = '';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: list_factures.php");
    exit();
}

$id_facture = $_GET['id'];

try {
    $clients = $clientManager->findAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des clients : " . $e->getMessage());
}

try {
    $facture = $factureManager->findById($id_facture);

    if (!$facture) {
        header("Location: list_factures.php");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération de la facture : " . $e->getMessage());
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
            $facture->setMontant($montant)
                    ->setProduits($produits)
                    ->setQuantite($quantite)
                    ->setIdClient($id_client);

            $factureManager->update($facture);
            $success = "Facture modifiée avec succès !";

            // Recharger les données de la facture
            $facture = $factureManager->findById($id_facture);
        } catch (PDOException $e) {
            $error = "Erreur lors de la modification de la facture : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Facture</title>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Modifier la Facture N° <?= htmlspecialchars($id_facture) ?></h4>
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

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="id_client" class="form-label">Client *</label>
                                <select class="form-select" id="id_client" name="id_client" required>
                                    <option value="">Sélectionner un client...</option>
                                    <?php foreach ($clients as $client): ?>
                                        <option value="<?= $client->getId() ?>"
                                                <?= ($facture->getIdClient() == $client->getId()) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($client->getNomComplet()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="produits" class="form-label">Produits *</label>
                                <textarea class="form-control" id="produits" name="produits" rows="3" required><?= htmlspecialchars($facture->getProduits()) ?></textarea>
                                <small class="text-muted">Description des produits concernés par la facture</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantite" class="form-label">Quantité *</label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" min="1"
                                           value="<?= htmlspecialchars($facture->getQuantite()) ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="montant" class="form-label">Montant (€) *</label>
                                    <input type="number" class="form-control" id="montant" name="montant" step="0.01" min="0.01"
                                           value="<?= htmlspecialchars($facture->getMontant()) ?>" required>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                                <a href="list_factures.php" class="btn btn-secondary">Retour à la liste</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
