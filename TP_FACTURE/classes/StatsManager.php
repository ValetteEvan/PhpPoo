<?php

class StatsManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTotalClients(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM CLIENTS");
        return (int) $stmt->fetch()['total'];
    }

    public function getTotalFactures(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM FACTURES");
        return (int) $stmt->fetch()['total'];
    }

    public function getChiffreAffaires(): float
    {
        $stmt = $this->pdo->query("SELECT SUM(montant) as total FROM FACTURES");
        return (float) ($stmt->fetch()['total'] ?? 0);
    }

    public function getChiffreAffairesFormate(): string
    {
        return number_format($this->getChiffreAffaires(), 2, ',', ' ') . ' €';
    }
}
