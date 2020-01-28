<?php

namespace App\Http\Requests\Api\Jobs\Resources;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobResourceRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "job_resource_id" => "required|exists:job_resources,id",
            "title" => "required",
            "description" => "",
            "file" => "nullable|file"
        ];
    }
}
