<?php

namespace App\Http\Requests\Jobs;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateJobRequest extends FormRequest
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
            "job_status_id" => "required|exists:job_statuses,id",
            "title" => "required",
            "header_image" => "nullable|image",
            "description" => "required",
            "starts_at" => "nullable",
            "ends_at" => "nullable",
        ];
    }
}
