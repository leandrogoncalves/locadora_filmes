<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\Models\Movie;
use App\Domain\Models\MovieRental;
use App\Domain\Repository\MovieRentalRepositoryInterface;
use App\Infrastructure\Exceptions\BookingErrorException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;
use Exception;

class MovieRentalService
{
    protected Movie $movie;
    protected MovieRental $movieRental;

    public function __construct(
        private MovieRentalRepositoryInterface $repository,
        private MovieService                   $movieService,
        private CustomerService                $customerService,
    ) {}

    public function booking(array $data): array
    {
        try {
            $this->repository->beginTransaction();
            $this->movie = $this->movieService->readById($data['movieId']);

            if ($this->isMovieAvailable()) {
                $booking = $this->makeReservation();
                $this->repository->commit();
                return [
                    'reserveId' => $booking->reserveId,
                ];
            }

            if ($this->isReservationTimeout()) {
                $booking = $this->updateReservation();
                $this->repository->commit();
                return [
                    'reserveId' => $booking->reserveId,
                ];
            }

        } catch (Exception $throwable) {
            Log::error($throwable->getMessage());
            $this->repository->rollBack();
            throw $throwable;
        }

        return [
            'message' => 'Filme indisponível',
        ];
    }

    public function confirmation(array $data): array
    {
        $movieRental = $this->repository->where([
            [
                'field' => 'reserveId',
                'value' => $data['reserveId'],
            ]
        ])->first();

        if (!$movieRental instanceof MovieRental) {
            throw new BookingErrorException('Reserva não encontrada');
        }

        if ($movieRental->status === 'LEASED') {
            return [
                'message' => 'Este filme já está alugado'
            ];
        }

        $customer = $this->customerService->fisrtOrCreate($data['customer']);
        $movieRental->status = 'LEASED';
        $movieRental->customerId = $customer->id;
        $movieRental->scheduleId = Uuid::uuid4();
        $movieRental->schedule_date = Carbon::now();
        $movieRental->return_date = Carbon::now()->addDays(7);
        $movieRental->save();

        return [
            'scheduleId' => $movieRental->scheduleId,
            'status' => $movieRental->status,
        ];
    }

    public function return(array $data): array
    {
        $movieRental = $this->repository->where([
            [
                'field' => 'scheduleId',
                'value' => $data['scheduleId'],
            ]
        ])->first();

        if (!$movieRental instanceof MovieRental) {
            throw new BookingErrorException('Reserva não encontrada');
        }

        $movieRental->status = 'RETURNED';
        $movieRental->save();

        return [
            'scheduleId' => $movieRental->scheduleId,
            'status' => $movieRental->status,
        ];
    }

    protected function isMovieAvailable(): bool
    {
        $movieRental = $this->repository
            ->getQuery()
            ->where('movieId', $this->movie->id)
            ->where(function ($query) {
                $query->whereNull('status')
                    ->orWhereIn('status', ['RESERVED', 'LEASED']);
            })
            ->first();

        if ($movieRental instanceof MovieRental) {
            $this->movieRental = $movieRental;
        }

        return is_null($movieRental);
    }

    protected function makeReservation(): MovieRental
    {
        $this->movieRental = $this->repository->create([
            'id' => Uuid::uuid4(),
            'movieId' => $this->movie->id,
            'reserveId' => Uuid::uuid4(),
            'status' => 'RESERVED',
            'reserve_date' => Carbon::now()->setTimezone(config('app.timezone')),
        ]);

        if (!$this->movieRental instanceOf MovieRental) {
            throw new BookingErrorException('Não foi possível reservar o filme, tente novamente mais tarde');
        }

        return $this->movieRental;
    }

    protected function isReservationTimeout(): bool
    {
        $movieRental = null;
        if (isset($this->movieRental)) {
            $movieRental = $this->movieRental;
        }

        if (!$movieRental instanceof MovieRental) {
            return false;
        }

        return $movieRental->reserve_date->addHours(config('app.reservation_hours')) < Carbon::now();
    }

    protected function updateReservation(): MovieRental
    {
        $this->movieRental = $this->repository->updateMyMovieId(
            $this->movie->id,
            [
                'reserveId' => Uuid::uuid4(),
                'status' => 'RESERVED',
                'reserve_date' => Carbon::now()->setTimezone(config('app.timezone')),
            ]
        );

        if (!$this->movieRental instanceOf MovieRental) {
            throw new BookingErrorException('Não foi possível reservar o filme, tente novamente mais tarde');
        }

        return $this->movieRental;
    }
}
