<?php 

namespace App\Repositories\Implementations;

use App\Http\Requests\MovieCreateRequest;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{

    public function find($id): Movie
    {
        $movie = Movie::findOrFail($id);

        return $movie;
    }

    public function create($datas): Movie
    {
        $movie = Movie::create($datas);   
        
        return $movie;
    }

    public function update($movie, $datas): Movie
    {
        $movie->update($datas);

        return $movie;
    }

    public function delete($movie): void
    {
        $movie->delete();
    }
}