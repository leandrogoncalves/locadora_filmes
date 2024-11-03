<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domain\Repository\MovieRepositoryInterface;
use App\Infrastructure\Repository\MovieRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;
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
    }

    protected function getMockRespository(): Mockery\MockInterface
    {
        $repository = Mockery::mock(MovieRepository::class);
        $repository->allows('where')->andReturnSelf();
        $repository->allows('read')->andReturn(collect([$this->movie]));
        return $repository;
    }

    public function testShouldReturnSuccessOnHealthUrl(): void
    {
        $response = $this->get(route('api.health'));
        $response->assertStatus(200);
    }

    public function testShouldReturnMoviesList(): void
    {
        $response = $this->get(route('api.movies.read'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            [
                'id',
                'name',
                'synopsis',
                'rating',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}
