<?php
namespace App\Repository;

use App\Entity\Trade;
use App\Entity\Transaction;
use Psr\Log\LoggerInterface;
use App\Interfaces\TransactionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TransactionRepository extends ServiceEntityRepository implements TransactionInterface
{
    private LoggerInterface $logger;

    public function __construct(ManagerRegistry $registry, LoggerInterface $logger)
    {
        parent::__construct($registry, Transaction::class);
        $this->logger = $logger;
    }

    /**
     * Store a new Transaction.
     *
     * @param array $params
     *
     * @return Transaction
     */
    public function create(array $params): Transaction
    {
        $entityManager = $this->getEntityManager();
        // Validate and fetch the trade entity
        $trade = $entityManager->getRepository(Trade::class)->find($params['trade_id']);
        if (!$trade) {
            throw new NotFoundHttpException(sprintf('Trade with ID %d not found.', $params['trade_id']));
        }

        // Create a new transaction
        $transaction = new Transaction();
        $transaction->setTrade($trade);
        $transaction->setClientName($params['client_name']);
        $transaction->setPrice($params['price']);
        $transaction->setCommodity($params['commodity']);
        $transaction->setVolume($params['volume']);
        $transaction->setType($params['type']);
        $transaction->setCreatedAt(new \DateTimeImmutable());
        $transaction->setUpdatedAt(new \DateTimeImmutable());

        //Save the data
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();

        return $transaction;
    }

    public function getById(int $transactionId): ?Transaction
    {
        return $this->find($transactionId);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
