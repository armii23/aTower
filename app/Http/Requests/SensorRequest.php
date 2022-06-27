<?php

namespace App\Http\Requests;

use App\Enums\FaceList;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get Allowed Target Currencies
     *
     * @return array
     */
    private function getAllowedFaces(): array
    {
        return [
            FaceList::NORTH,
            FaceList::EAST,
            FaceList::SOUTH,
            FaceList::WEST,
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'          => 'required|numeric',
            'face'        => ['required',Rule::in($this->getAllowedFaces()),],
            'temperature' => 'required|numeric|between:0,99.99',
            'timestamp'   => 'required|numeric|between:'.~PHP_INT_MAX.','.PHP_INT_MAX,
        ];
    }
}
