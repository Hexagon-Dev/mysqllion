<?php

namespace App\Http\Controllers;

use App\Contracts\Services\DataServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class DataController extends Controller
{
    protected DataServiceInterface $service;

    /**
     * @param DataServiceInterface $dataService
     */
    public function __construct(DataServiceInterface $dataService)
    {
        $this->service = $dataService;
    }

    /**
     * @return JsonResponse
     */
    public function request(): JsonResponse
    {
        $collection = $this->service->request();
        return response()->json(
            ['id' => $collection->get('id')],
            $collection->get('status'),
        );
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function info(string $id): JsonResponse
    {
        $collection = $this->service->info($id);
        return response()->json([
            'message' => $collection->get('message'),
            'elapsed' => $collection->get('elapsed'),
            'files' => $collection->get('files'),
            ],
            $collection->get('status'),
        );
    }

    /**
     * @param string $path
     * @return Collection|JsonResponse
     */
    public function download(string $path)
    {
        $collection = $this->service->download($path);
        if (is_a($collection, 'Collection') && $collection->get('status') === 404) {
            return response()->json(
                ['error' => $collection->get('error')],
                $collection->get('status'),
            );
        }
        return $collection;
    }
}
