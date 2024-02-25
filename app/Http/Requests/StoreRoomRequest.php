<?php

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
        $validStatusArray = [Room::STATUS_OPEN, Room::STATUS_MAINTAIN];
        $validTypeArray = [Room::TYPE_SINGLE, Room::TYPE_COUPLE, Room::TYPE_LUXURY];

        return [
            'code' => 'required|string|unique:rooms,code,' . $this->route('id'),
            'name' => 'required|string|between:2,100',
            'desc' => 'nullable',
            'price' => 'required|numeric',
            'type' => 'required|in:' . implode(',', $validTypeArray),
            'status' => 'required|in:' . implode(',', $validStatusArray),
        ];
    }
}
