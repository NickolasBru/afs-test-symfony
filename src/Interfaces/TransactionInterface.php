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

    public function create(array $params): Transaction;

}
