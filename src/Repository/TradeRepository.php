<?php
namespace App\Repository;

use App\Entity\Trade;
use Psr\Log\LoggerInterface;
use App\Interfaces\TradeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TradeRepository extends ServiceEntityRepository implements TradeInterface
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Trade::class);
        $this->logger = $logger;
    }

    /**
     * Store a new Trade.
     *
     * @param array $params
     *
     * @return Trade
     */
    public function create(array $params): Trade
    {
        // Create a Trade entity and set its properties
        $trade = new Trade();
        $trade->setNumber($this->generateNumber());
        $trade->setDate(new \DateTimeImmutable($params['date']));
        $trade->setNote($params['note']);
        $trade->setCreatedAt(new \DateTimeImmutable());
        $trade->setUpdatedAt(new \DateTimeImmutable());

        // Persist the entity using the correct method
        $this->getEntityManager()->persist($trade);
        $this->getEntityManager()->flush();

        return $trade;
    }

    public function getById(int $tradeId): ?Trade
    {
        return $this->find($tradeId);
    }

    public function getNumber(string $number): ?string
    {
        return $this->findOneBy(['number' => $number]);
    }

    private function generateNumber(): string
    {
        $number = strtoupper(substr(bin2hex(random_bytes(5)), 0, 10));
        if ($this->getNumber($number)) {
            return $this->generateNumber();  // Generate a new number if the current one already exists
        }
        return $number;
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
