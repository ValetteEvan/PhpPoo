<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Gestion des Plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h1 class="card-title text-center mb-2">Gestion des Plaintes</h1>
                        <p class="text-center text-muted mb-4">Remplissez ce formulaire pour soumettre votre plainte</p>

        <?php
        require_once __DIR__ . '/classes/Plainte.php';

        $errors = [];
        $success = false;
        $nom = '';
        $email = '';
        $sujet = '';
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $sujet = trim($_POST['sujet'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (empty($nom)) {
                $errors['nom'] = 'Le nom est requis';
            }

            if (empty($email)) {
                $errors['email'] = 'L\'email est requis';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'L\'email n\'est pas valide';
            }

            if (empty($sujet)) {
                $errors['sujet'] = 'Le sujet est requis';
            }

            if (empty($message)) {
                $errors['message'] = 'Le message est requis';
            } elseif (strlen($message) < 10) {
                $errors['message'] = 'Le message doit contenir au moins 10 caractères';
            }

            if (empty($errors)) {
                try {
                    $plainte = new Plainte($nom, $email, $sujet, $message);
                    if ($plainte->save()) {
                        $success = true;
                        $nom = '';
                        $email = '';
                        $sujet = '';
                        $message = '';
                    } else {
                        $errors['general'] = 'Erreur lors de l\'enregistrement de la plainte';
                    }
                } catch (Exception $e) {
                    $errors['general'] = 'Erreur : ' . $e->getMessage();
                }
            }
        }
        ?>

                        <?php if ($success): ?>
                            <div class="alert alert-success" role="alert">
                                Votre plainte a été soumise avec succès et enregistrée dans la base de données !
                            </div>
                        <?php endif; ?>

                        <?php if (isset($errors['general'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors['general']; ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="nom" class="form-label">
                                    Nom complet <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control <?php echo isset($errors['nom']) ? 'is-invalid' : ''; ?>"
                                    id="nom"
                                    name="nom"
                                    value="<?php echo htmlspecialchars($nom); ?>"
                                    placeholder="Entrez votre nom complet"
                                >
                                <?php if (isset($errors['nom'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['nom']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="email"
                                    class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                                    id="email"
                                    name="email"
                                    value="<?php echo htmlspecialchars($email); ?>"
                                    placeholder="exemple@email.com"
                                >
                                <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="sujet" class="form-label">
                                    Sujet <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control <?php echo isset($errors['sujet']) ? 'is-invalid' : ''; ?>"
                                    id="sujet"
                                    name="sujet"
                                    value="<?php echo htmlspecialchars($sujet); ?>"
                                    placeholder="Sujet de votre plainte"
                                >
                                <?php if (isset($errors['sujet'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['sujet']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">
                                    Message <span class="text-danger">*</span>
                                </label>
                                <textarea
                                    class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : ''; ?>"
                                    id="message"
                                    name="message"
                                    rows="5"
                                    placeholder="Décrivez votre plainte en détail (minimum 10 caractères)"
                                ><?php echo htmlspecialchars($message); ?></textarea>
                                <?php if (isset($errors['message'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['message']; ?></div>
                                <?php endif; ?>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Soumettre la plainte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
