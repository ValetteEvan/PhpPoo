<?php

require_once __DIR__ . '/Database.php';

class Plainte
{
    private ?int $id = null;
    private string $nom;
    private string $email;
    private string $sujet;
    private string $message;
    private ?string $dateCreation = null;

    public function __construct(string $nom, string $email, string $sujet, string $message)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->message = $message;
    }

    public function save(): bool
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO plaintes (nom, email, sujet, message) VALUES (:nom, :email, :sujet, :message)";
        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':sujet' => $this->sujet,
            ':message' => $this->message
        ]);
    }

    public static function getAll(): array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM plaintes ORDER BY date_creation DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM plaintes WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSujet(): string
    {
        return $this->sujet;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }
}
