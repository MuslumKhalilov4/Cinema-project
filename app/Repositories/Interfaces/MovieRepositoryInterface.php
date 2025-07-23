<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\MovieFilterRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

interface MovieRepositoryInterface
{
    public function getAll(MovieFilterRequest $request): Collection;

    public function find($id): Movie;

    public function create($datas): Movie;

    public function update($movie, $datas): Movie;

    public function delete($movie): void;
}