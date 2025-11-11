<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="card-title mb-0">Liste des Plaintes</h1>
                            <a href="formulaire_plaintes.php" class="btn btn-primary">Nouvelle plainte</a>
                        </div>

                        <?php
                        require_once __DIR__ . '/classes/Plainte.php';

                        try {
                            $plaintes = Plainte::getAll();

                            if (empty($plaintes)):
                        ?>
                            <div class="alert alert-info">
                                Aucune plainte enregistrée pour le moment.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Sujet</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($plaintes as $plainte): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($plainte['id']); ?></td>
                                                <td><?php echo htmlspecialchars($plainte['nom']); ?></td>
                                                <td><?php echo htmlspecialchars($plainte['email']); ?></td>
                                                <td><?php echo htmlspecialchars($plainte['sujet']); ?></td>
                                                <td>
                                                    <?php
                                                    $msg = htmlspecialchars($plainte['message']);
                                                    echo strlen($msg) > 50 ? substr($msg, 0, 50) . '...' : $msg;
                                                    ?>
                                                </td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($plainte['date_creation'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <p class="text-muted">Total : <?php echo count($plaintes); ?> plainte(s)</p>
                            </div>
                        <?php
                            endif;
                        } catch (Exception $e) {
                        ?>
                            <div class="alert alert-danger">
                                Erreur lors de la récupération des plaintes : <?php echo htmlspecialchars($e->getMessage()); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
