<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface DataServiceInterface
{
    /**
     * @return Collection
     */
    public function request(): Collection;

    /**
     * @param string $id
     * @return Collection
     */
    public function info(string $id): Collection;

    /**
     * @param string $path
     * @return Collection|BinaryFileResponse
     */
    public function download(string $path);
}
