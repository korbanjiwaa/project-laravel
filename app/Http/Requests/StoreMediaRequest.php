<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255|unique:media,judul',
            'kategori' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:2100',
            'genre' => 'nullable|string|max:100',
            'episode' => 'nullable|integer|min:1',
        ];
    }
}
