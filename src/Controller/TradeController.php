<?php

namespace App\Controller;

use App\Entity\Trade;
use App\Validators\TradeValidator;
use Psr\Log\LoggerInterface;
use App\Repository\TradeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TradeController extends AbstractController
{
    /**
     * @var TradeRepository
     */
    private TradeRepository        $tradeRepository;
    private SerializerInterface    $serializer;
    private EntityManagerInterface $entityManager;

    /**
     * @param TradeRepository $tradeRepository
     */
    public function __construct(TradeRepository $tradeRepository, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->tradeRepository = $tradeRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    #[Route('/api/trade', name: 'trade_store', methods: ['POST'])]
    public function store(TradeValidator $validator, LoggerInterface $logger, Request $request): Response
    {
        // Get the JSON payload from the request body
        $data = json_decode($request->getContent(), true);

        //Validation
        $errors = $validator->validate($data);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        //If everything is ok, sent the data to the repository
        try {
            $trade = $this->tradeRepository->create($data);

            return $this->json($trade, Response::HTTP_OK, [], ['groups' => 'trade:read']);

        } catch (\Exception $e){
            $logger->error('An error occurred: ' . $e->getMessage());

            // Return a JSON response with the error
            return $this->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/api/trade', name: 'trade_index', methods: ['GET'])]
    public function index(LoggerInterface $logger, Request $request): JsonResponse
    {
        //Fetch the data
        $trades = $this->tradeRepository->getAll();

        // Serialize collection to JSON
        $json = $this->serializer->serialize($trades, 'json', ['groups' => 'trade:read']);


        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

}
