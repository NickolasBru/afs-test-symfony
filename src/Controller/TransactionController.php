<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TransactionRepository;
use App\Validators\TransactionValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{    /**
 * @var TransactionRepository
 */
    private TransactionRepository $transactionRepository;
    private SerializerInterface    $serializer;
    private EntityManagerInterface $entityManager;

    /**
     * @param TransactionRepository $transactionRepository
     */
    public function __construct(TransactionRepository $transactionRepository, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->transactionRepository = $transactionRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }
    #[Route('/api/transaction', name: 'transaction_store', methods: ['POST'])]
    public function store(TransactionValidator $validator, LoggerInterface $logger, Request $request): Response
    {
        // Get the JSON payload from the request body
        $data = json_decode($request->getContent(), true);

        //Validation
        $errors = $validator->validate($data);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        //If everything is ok, sent the data to the repository
        $transaction = $this->transactionRepository->create($data);

        // Serialize collection to JSON
        $json = $this->serializer->serialize($transaction, 'json', ['groups' => 'transaction:read']);

        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/api/transaction', name: 'transaction_index', methods: ['GET'])]
    public function index(LoggerInterface $logger, Request $request): JsonResponse
    {
        //Fetch the data
        $transactions = $this->transactionRepository->getAll();

        // Serialize collection to JSON
        return $this->json($transactions, Response::HTTP_OK, [], ['groups' => 'transaction:read']);
    }
}
