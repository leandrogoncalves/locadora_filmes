<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Requests;

use App\Infrastructure\Exceptions\ValidationApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BookingMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'movieId' => 'required|string',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'movieId:required' => 'O campo "movieId" é obrigatório',
            'movieId:string' => 'O campo "movieId" deve ser um texto',
        ];
    }

    /**
     * @return mixed
     *
     * @throws ValidationApiException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationApiException($validator, 'Erro na validação de dados');
    }
}
