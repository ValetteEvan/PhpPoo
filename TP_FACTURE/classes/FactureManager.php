<?php

class FactureManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Facture $facture): bool
    {
        $sql = "INSERT INTO FACTURES (montant, produits, quantite, id_client) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $facture->getMontant(),
            $facture->getProduits(),
            $facture->getQuantite(),
            $facture->getIdClient()
        ]);
    }

    public function update(Facture $facture): bool
    {
        $sql = "UPDATE FACTURES SET montant = ?, produits = ?, quantite = ?, id_client = ? WHERE id_facture = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $facture->getMontant(),
            $facture->getProduits(),
            $facture->getQuantite(),
            $facture->getIdClient(),
            $facture->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM FACTURES WHERE id_facture = ?";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function findAll(): array
    {
        $sql = "SELECT f.*, c.nom, c.prenom
                FROM FACTURES f
                INNER JOIN CLIENTS c ON f.id_client = c.id_client
                ORDER BY f.date_creation DESC";

        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();

        $factures = [];
        foreach ($data as $row) {
            $factures[] = $this->hydrate($row);
        }

        return $factures;
    }

    public function findRecent(int $limit = 5): array
    {
        $sql = "SELECT f.*, c.nom, c.prenom
                FROM FACTURES f
                INNER JOIN CLIENTS c ON f.id_client = c.id_client
                ORDER BY f.date_creation DESC
                LIMIT ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$limit]);
        $data = $stmt->fetchAll();

        $factures = [];
        foreach ($data as $row) {
            $factures[] = $this->hydrate($row);
        }

        return $factures;
    }

    public function findById(int $id): ?Facture
    {
        $sql = "SELECT f.*, c.nom, c.prenom
                FROM FACTURES f
                INNER JOIN CLIENTS c ON f.id_client = c.id_client
                WHERE f.id_facture = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        return $data ? $this->hydrate($data) : null;
    }

    // Recherche avec filtres optionnels
    public function search(?int $idClient = null, ?string $dateDebut = null, ?string $dateFin = null): array
    {
        $sql = "SELECT f.*, c.nom, c.prenom
                FROM FACTURES f
                INNER JOIN CLIENTS c ON f.id_client = c.id_client
                WHERE 1=1";

        $params = [];

        if ($idClient !== null) {
            $sql .= " AND f.id_client = ?";
            $params[] = $idClient;
        }

        if ($dateDebut !== null) {
            $sql .= " AND DATE(f.date_creation) >= ?";
            $params[] = $dateDebut;
        }

        if ($dateFin !== null) {
            $sql .= " AND DATE(f.date_creation) <= ?";
            $params[] = $dateFin;
        }

        $sql .= " ORDER BY f.date_creation DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetchAll();

        $factures = [];
        foreach ($data as $row) {
            $factures[] = $this->hydrate($row);
        }

        return $factures;
    }

    // Transforme un tableau associatif en objet Facture
    private function hydrate(array $data): Facture
    {
        $facture = new Facture($data['id_facture']);
        $facture->setMontant($data['montant'])
                ->setProduits($data['produits'])
                ->setQuantite($data['quantite'])
                ->setIdClient($data['id_client'])
                ->setDateCreation($data['date_creation']);

        // Données du client si présentes (jointure)
        if (isset($data['nom'])) {
            $facture->setNomClient($data['nom']);
        }
        if (isset($data['prenom'])) {
            $facture->setPrenomClient($data['prenom']);
        }

        return $facture;
    }
}
