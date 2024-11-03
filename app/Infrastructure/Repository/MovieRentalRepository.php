<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Models\MovieRental;
use App\Domain\Repository\MovieRentalRepositoryInterface;
use Illuminate\Database\DatabaseManager;

class MovieRentalRepository extends BaseRepository implements MovieRentalRepositoryInterface
{
    public function __construct(
        private MovieRental $model,
        protected DatabaseManager $databaseManager
    ) {
        parent::__construct($databaseManager);
        $this->query = $model->newModelQuery();
    }

    public function updateMyMovieId(string $movieId, array $rentalMovieData): MovieRental
    {
        $rentalMovie = $this->where([
            [
                'field' => 'movieId',
                'value' => $movieId,
            ]
        ])->first();

        if (!$rentalMovie instanceof MovieRental) {
            throw new NotFoundException('Reserva não encontrada com o filme selecionado');
        }

        $rentalMovie->fill($rentalMovieData)->save();
        return $rentalMovie;
    }
}
