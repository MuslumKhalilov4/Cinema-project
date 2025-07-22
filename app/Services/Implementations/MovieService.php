<?php 

namespace App\Services\Implementations;

use App\Http\Requests\MovieCreateRequest;
use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\FileService;
use App\Services\Interfaces\MovieServiceInterface;

class MovieService implements MovieServiceInterface
{
    protected $movieRepository;
    protected $fileService;

    public function __construct(MovieRepositoryInterface $movieRepository, FileService $fileService)
    {
        $this->movieRepository = $movieRepository;
        $this->fileService = $fileService;
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
}