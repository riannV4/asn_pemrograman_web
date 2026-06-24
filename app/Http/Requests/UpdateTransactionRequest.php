<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'type' => 'required|in:income,expense',
            'category_id' => [
                'nullable',
                'exists:categories,id',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $category = \Illuminate\Support\Facades\Auth::user()->categories()->find($value);
                        if (!$category) {
                            $fail('Kategori tidak valid.');
                        } elseif ($category->type !== $this->input('type')) {
                            $fail('Kategori yang dipilih tidak sesuai dengan jenis transaksi.');
                        }
                    }
                }
            ],
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ];
    }
}
