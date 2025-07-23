<?php 

namespace App\Repositories\Implementations;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieFilterRequest;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository implements MovieRepositoryInterface
{

    public function getAll(MovieFilterRequest $request): Collection
    {
        $order = $request->order ?? 'asc';
        $query = Movie::query();

        if($request->filled('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if($request->filled('includes')){
            $query->with($request->includes);
        }

        if($request->filled('order_by')){
            $query->orderBy($request->order_by, $order);
        }

        return $query->get();
    }

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