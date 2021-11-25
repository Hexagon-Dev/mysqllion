<?php

namespace App\Services;

use App\Contracts\Services\DataServiceInterface;
use App\Jobs\ProcessQuery;
use App\Models\ExportQuery;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class DataService implements DataServiceInterface
{
    public int $entry = 0;
    public string $filename;

    public function request(): Collection
    {
        $export = ExportQuery::query()->create(['status' => ExportQuery::STATUS_WAITING, 'elapsed' => 0]);

        ProcessQuery::dispatchAfterResponse($export->id);

        return collect([
            'id' => $export->id,
            'status' => Response::HTTP_CREATED,
        ]);
    }

    public function info(string $id): Collection
    {
        if (!$query = ExportQuery::query()->where('id', $id)->first()) {
            return collect([
                'message' => 'Task not found',
                'status' => Response::HTTP_NOT_FOUND,
            ]);
        }

        $query = $query->toArray();

        if ($query['status'] !== ExportQuery::STATUS_DONE) {
            return collect([
                'message' => 'Task is not done yet',
                'status' => Response::HTTP_ACCEPTED,
            ]);
        }

        return collect([
            'message' => 'Task finished',
            'elapsed' => $query['elapsed'],
            'status' => Response::HTTP_OK,
        ]);
    }

    /**
     * @param string $path
     * @return Collection|BinaryFileResponse
     */
    public function download(string $path): Collection
    {
        if (!File::exists($path)) {
            return Collection::make([
                'error' => 'file not found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }

        return response()->file(public_path($path));
    }
}
