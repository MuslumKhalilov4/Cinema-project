<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\MovieCreateRequest;
use App\Models\Movie;

interface MovieRepositoryInterface
{
    public function find($id): Movie;

    public function create($datas): Movie;
}