<?php

namespace App\Interfaces;

use App\Entity\Transaction;
use DateTimeInterface;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\ManagerRegistry;

interface TransactionInterface
{
    public function __construct(ManagerRegistry $registry, LoggerInterface $logger);

    public function getById(int $transactionId): ?Transaction;

    public function updateById(int $transactionId, array $params): ?Transaction;

    public function insert(array $params): bool;

    public function create(array $params): Transaction;

    public function update(Transaction $transaction, array $params): Transaction;

    public function getNumber(string $number): ?string;

}
