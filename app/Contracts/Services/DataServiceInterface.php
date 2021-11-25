<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

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
     * @return Collection
     */
    public function download(string $path): Collection;
}
