<?php

namespace App\Http\Controllers;

use App\Mappers\DelegationMapper;
use App\Transformers\DelegationTransformer;
use DateTime;
use Domain\Repository\DelegationRepositoryInterface;
use Domain\Repository\WorkerRepositoryInterface;
use Domain\Repository\CountryRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DelegationController extends Controller
{
    protected WorkerRepositoryInterface $workerRepository;
    protected CountryRepositoryInterface $countryRepository;
    protected DelegationRepositoryInterface $delegationRepository;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(
        WorkerRepositoryInterface     $workerRepository,
        CountryRepositoryInterface    $countryRepository,
        DelegationRepositoryInterface $delegationRepository
    )
    {
        $this->workerRepository = $workerRepository;
        $this->countryRepository = $countryRepository;
        $this->delegationRepository = $delegationRepository;
    }

    public function index(): View
    {
        return view('welcome',['delegations' => $this->delegationRepository->getManyByWorkerId(1)]);
    }

    public function assignWorkerToCountry(Request $request): JsonResponse
    {
        $workerId = (int)$request->worker_id;

        $countryCode = (string)$request->country_code;

        $start = DateTime::createFromFormat(DelegationTransformer::DATETIME_FORMAT, $request->start);

        $end = DateTime::createFromFormat(DelegationTransformer::DATETIME_FORMAT, $request->end);

        $worker = $this->workerRepository->getById($workerId);

        $country = $this->countryRepository->getByCode($countryCode);

        $delegation = $worker->participate($country, $start, $end);

        $this->delegationRepository->save($delegation);

        return response()->json([
            "message" => "Worker " . $workerId . " was assigned to '" .
                $countryCode . "'",
        ], 201);
    }

    public function getWorkerDelegations(Request $request): JsonResponse
    {
        $workerId = (int)$request->worker_id;

        $delegations = $this->delegationRepository->getManyByWorkerId($workerId);

        $returnedDelegationsData = [];

        foreach ($delegations as $delegation) {
            $mappedDelegation = new DelegationMapper($delegation);
            $returnedDelegationsData[] = $mappedDelegation->map();
        }

        return response()->json([
            "message" => "Worker " . $workerId . " delegations",
            "data" => $returnedDelegationsData
        ]);
    }
}




