<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


public function rules(): array
{
    $mediaId = $this->route('medium')?->id;

    return [
        'judul' => [
            'sometimes',
            'required',
            'string',
            'max:255',
            \Illuminate\Validation\Rule::unique('media', 'judul')
                ->ignore($mediaId),
        ],
        'kategori' => 'sometimes|required|string|max:100',
        'tahun' => 'sometimes|required|integer|min:1900|max:2100',
        'genre' => 'sometimes|nullable|string|max:100',
        'episode' => 'sometimes|nullable|integer|min:1',
    ];
}

}
