<?php

declare(strict_types=1);

namespace Unit\Application\Services;

use App\Domain\Models\Movie;
use App\Domain\Repository\MovieRepositoryInterface;
use App\Infrastructure\Repository\MovieRepository;
use App\Application\Services\MovieService;
use Mockery;
use Tests\TestCase;

class MovieServiceTest extends TestCase
{
    protected MovieService $service;
    protected array $movie;

    protected function setUp(): void
    {
        parent::setUp();
        $this->movie = [
            'id' => '1',
            'name' => 'Movie 1',
            'synopsis' => 'Test',
            'rating' => '10',
            'created_at' => '2024-11-03T00:46:11.000000Z',
            'updated_at' => '024-11-03T00:46:11.000000Z',
        ];
        app()->instance(MovieRepositoryInterface::class, $this->getMockRespository());
        $this->service = app(MovieService::class);

    }

    protected function getMockRespository(): Mockery\MockInterface
    {
        $repository = Mockery::mock(MovieRepository::class);
        $repository->allows('where')->andReturnSelf();
        $repository->allows('read')->andReturn(collect([$this->movie]));
        $repository->allows('first')->andReturn(new Movie($this->movie));
        return $repository;
    }

    public function testShouldGetMoviesSuccesfuly(): void
    {
        $movies = $this->service->readAll();
        $this->assertEquals(1, $movies->count());
    }

    public function testShouldGetOneMovieById(): void
    {
        $movie = $this->service->readById('123456');
        $this->assertEquals('1', $movie->id);
    }
}
