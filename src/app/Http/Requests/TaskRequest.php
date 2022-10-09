<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\ArrayShape;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }


    #[ArrayShape(['title' => "string[]", 'task' => "string[]", 'img_path' => "string[]"])]
    public function rules(): array
    {
        return [
            'title' => ['string', 'required', 'max:255', 'min:2'],
            'task' => ['string', 'required', 'min:2'],
            'img_path' => ['string', 'nullable']
        ];
    }
}
