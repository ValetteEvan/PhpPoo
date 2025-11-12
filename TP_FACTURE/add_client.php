<?php
require_once 'config/autoload.php';

$pdo = Database::getInstance();
$clientManager = new ClientManager($pdo);

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $sexe = $_POST['sexe'];
    $date_naissance = $_POST['date_naissance'];

    if (empty($nom) || empty($prenom) || empty($sexe) || empty($date_naissance)) {
        $error = "Tous les champs sont obligatoires.";
    } else {
        try {
            $client = new Client();
            $client->setNom($nom)
                   ->setPrenom($prenom)
                   ->setSexe($sexe)
                   ->setDateNaissance($date_naissance);

            $clientManager->create($client);
            $success = "Client ajouté avec succès !";

            $_POST = array();
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout du client : " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
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
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ajouter un Nouveau Client</h4>
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
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom"
                                       value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom"
                                       value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="sexe" class="form-label">Sexe *</label>
                                <select class="form-select" id="sexe" name="sexe" required>
                                    <option value="">Choisir...</option>
                                    <option value="H" <?= (isset($_POST['sexe']) && $_POST['sexe'] === 'H') ? 'selected' : '' ?>>Homme</option>
                                    <option value="F" <?= (isset($_POST['sexe']) && $_POST['sexe'] === 'F') ? 'selected' : '' ?>>Femme</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date_naissance" class="form-label">Date de Naissance *</label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                                       value="<?= isset($_POST['date_naissance']) ? htmlspecialchars($_POST['date_naissance']) : '' ?>" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                <a href="list_clients.php" class="btn btn-secondary">Voir la liste des clients</a>
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
