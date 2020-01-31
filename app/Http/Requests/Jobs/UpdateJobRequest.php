<?php

namespace App\Http\Requests\Jobs;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            "job_category_id" => "required|exists:job_categories,id",
            "work_method_id" => "required|exists:work_methods,id",
            "title" => "required",
            "slogan" => "nullable",
            "problem" => "required",
            "description" => "required",
            "starts_at" => "nullable",
            "ends_at" => "nullable",
            "header_image" => "nullable|image",
            "resources" => "nullable",
            "team_roles" => "nullable",
        ];
    }
}
