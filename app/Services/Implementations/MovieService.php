<?php 

namespace App\Services\Implementations;

use App\Http\Requests\MovieCreateRequest;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\FileService;
use App\Services\Interfaces\MovieServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\MockObject\ClassIsFinalException;

class MovieService implements MovieServiceInterface
{
    protected $movieRepository;
    protected $fileService;

    public function __construct(MovieRepositoryInterface $movieRepository, FileService $fileService)
    {
        $this->movieRepository = $movieRepository;
        $this->fileService = $fileService;
    }

    public function getAllMovies(MovieFilterRequest $request): Collection
    {
        $movies = $this->movieRepository->getAll($request);

        return $movies;
    }

    public function getMovieById($id): Movie
    {
        $movie = $this->movieRepository->find($id);

        return $movie;
    }

    public function createMovie(MovieCreateRequest $request): Movie
    {
        $imagePath = $this->fileService->upload($request->image);

        $datas = $request->only(['name', 'description', 'duration', 'rating', 'release_date', 'director']);
        $datas['image_path'] = $imagePath;

        $movie = $this->movieRepository->create($datas);

        $movie->genres()->attach($request->genres);
        $movie->actors()->attach($request->actors);

        return $movie->load(['genres', 'actors']);
    }

    public function updateMovie(MovieUpdateRequest $request, $id): Movie
    {
        $movie = $this->movieRepository->find($id);

        if($request->image){
            $this->fileService->delete($movie->image_path);
            $movie->image_path = $this->fileService->upload($request->image);

            $movie->save();
        }

        $datas = $request->only(['name', 'description', 'duration', 'rating', 'release_date', 'director']);
        $updated_movie = $this->movieRepository->update($movie, $datas);

        $movie->genres()->sync($request->genres);
        $movie->actors()->sync($request->actors);

        return $updated_movie->load(['genres', 'actors']);
    }

    public function deleteMovie($id): Movie
    {
        $movie = $this->movieRepository->find($id);

        $this->fileService->delete($movie->image_path);

        $this->movieRepository->delete($movie);

        return $movie;
    }
}