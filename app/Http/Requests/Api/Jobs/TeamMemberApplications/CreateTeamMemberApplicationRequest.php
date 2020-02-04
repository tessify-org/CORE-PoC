<?php

namespace App\Http\Requests\Api\Jobs\TeamMemberApplications;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateTeamMemberApplicationRequest extends FormRequest
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
            "job_id" => "required|integer|exists:jobs,id",
            "team_role_id" => "required|integer|exists:team_roles,id",
            "motivation" => "required",
        ];
    }
}
