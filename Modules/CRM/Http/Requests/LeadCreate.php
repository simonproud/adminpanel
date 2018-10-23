<?php

namespace Modules\CRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\CRM\Entities\LeadCstm;

class LeadCreate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        LeadCstm::where('active', true)->get()->toArray();
        $rules = [
            'name' => 'required|string|max:255|min:5',
            'client_id' => 'sometimes|numeric',
            'user_id' => 'sometimes|numeric',
            'order_id' => 'sometimes|numeric',
            'source' => 'required|string',
            'description' => 'required|string',
        ];

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
