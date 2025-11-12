<?php

class ClientManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Client $client): bool
    {
        $sql = "INSERT INTO CLIENTS (nom, prenom, sexe, date_naissance) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $client->getNom(),
            $client->getPrenom(),
            $client->getSexe(),
            $client->getDateNaissance()
        ]);
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM CLIENTS ORDER BY nom, prenom";
        $stmt = $this->pdo->query($sql);
        $data = $stmt->fetchAll();

        $clients = [];
        foreach ($data as $row) {
            $clients[] = $this->hydrate($row);
        }

        return $clients;
    }

    public function findById(int $id): ?Client
    {
        $sql = "SELECT * FROM CLIENTS WHERE id_client = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        return $data ? $this->hydrate($data) : null;
    }

    // Transforme un tableau associatif en objet Client
    private function hydrate(array $data): Client
    {
        $client = new Client($data['id_client']);
        $client->setNom($data['nom'])
               ->setPrenom($data['prenom'])
               ->setSexe($data['sexe'])
               ->setDateNaissance($data['date_naissance']);

        return $client;
    }
}
