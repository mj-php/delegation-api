<?php

namespace App\Http\Controllers;

use Domain\Repository\WorkerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    protected WorkerRepositoryInterface $workerRepository;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(WorkerRepositoryInterface $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    public function store(Request $request): JsonResponse
    {
        $worker = $this->workerRepository->save();

        return response()->json([
            'worker_id' => $worker->getId(),
        ], 201);
    }
}



