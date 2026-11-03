<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class OrderRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'service_type' => 'required|in:regular,express',
            'weight' => 'required|numeric|min:0.1',
            'pickup_date' => 'required|date|after_or_equal:today',
            'pickup_time' => 'required|date_format:H:i',
        ];
    }

    #[Override]
    public function attributes()
    {
        return [
            'customer_name' => 'Nama Pelanggan',
            'customer_phone' => 'Nomor Telepon',
            'customer_address' => 'Alamat',
            'service_type' => 'Jenis Layanan',
            'weight' => 'Berat Cucian (kg)',
            'pickup_date' => 'Tanggal Penjemputan',
            'pickup_time' => 'Waktu Penjemputan',
        ];
    }
}
