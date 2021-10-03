<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository, $orderRepository;

    public function __construct(
        EvaluationRepositoryInterface $evaluationRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->evaluationRepository = $evaluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvaluation(string $identifyOrder, array $evaluation)
    {
       $clientId = $this->getIdClient();
       $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

       return $this->evaluationRepository->newEvaluationOrder($order->id, $clientId, $evaluation);
    }

    private function getIdClient()
    {
        return auth()->user()->id;
    }
}
