<?php

namespace App\Interfaces;

use App\Entity\Trade;
use DateTimeInterface;
use Psr\Log\LoggerInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\ManagerRegistry;

interface TradeInterface
{
    public function __construct(ManagerRegistry $registry, LoggerInterface $logger);

    public function getById(int $tradeId): ?Trade;

    public function create(array $params): Trade;

    public function getNumber(string $number): ?string;

}
