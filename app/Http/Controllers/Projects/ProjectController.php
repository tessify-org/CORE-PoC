<?php

namespace App\Http\Controllers\Projects;

use Auth;
use Projects;
use Users;
use Skills;
use Comments;
use WorkMethods;
use ProjectStatuses;
use ProjectResources;
use ProjectCategories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Http\Requests\Projects\DeleteProjectRequest;

class ProjectController extends Controller
{
    public function getOverview()
    {
        return view("pages.projects.overview", [
            "projects" => Projects::getAllPreloaded(),
        ]);
    }

    public function getView($slug)
    {
        $project = Projects::findPreloadedBySlug($slug);
        if (!$project)
        {
            flash("Project kon niet worden gevonden")->error();
            return redirect()->route("Projects");
        }

        return view("pages.projects.view", [
            "project" => $project,
            "user" => Users::current(),
            "comments" => Comments::getAllPreloadedForProject($project),
        ]);
    }

    public function getCreate()
    {
        return view("pages.projects.create", [
            "statuses" => Projectstatuses::getAll(),
            "categories" => ProjectCategories::getAll(),
            "workMethods" => WorkMethods::getAll(),
            "skills" => Skills::getAll(),
            "oldInput" => collect([
                "project_status_id" => old("project_status_id"),
                "project_category_id" => old("project_category_id"),
                "work_method_id" => old("work_method_id"),
                "title" => old("title"),
                "slogan" => old("slogan"),
                "problem" => old("problem"),
                "description" => old("description"),
                "starts_at" => old("starts_at"),
                "ends_at" => old("ends_at"),
                "resources" => old("resources"),
                "team_roles" => old("team_roles"),
            ])
        ]);
    }

    public function postCreate(CreateProjectRequest $request)
    {
        $project = Projects::createFromRequest($request);

        flash("Project is toegevoegd!")->success();
        return redirect()->route("projects.view", $project->slug);
    }

    public function getEdit($slug)
    {
        $project = Projects::findPreloadedBySlug($slug);
        if (!$project)
        {   
            flash("Project kon niet worden gevonden")->error();
            return redirect()->route("projects");
        }

        return view("pages.projects.edit", [
            "project" => $project,
            "statuses" => Projectstatuses::getAll(),
            "categories" => ProjectCategories::getAll(),
            "workMethods" => WorkMethods::getAll(),
            "skills" => Skills::getAll(),
            "oldInput" => collect([
                "project_status_id" => old("project_status_id"),
                "project_category_id" => old("project_category_id"),
                "work_method_id" => old("work_method_id"),
                "title" => old("title"),
                "slogan" => old("slogan"),
                "problem" => old("problem"),
                "description" => old("description"),
                "starts_at" => old("starts_at"),
                "ends_at" => old("ends_at"),
                "resources" => old("resources"),
                "team_roles" => old("team_roles"),
            ])
        ]);
    }

    public function postEdit(UpdateProjectRequest $request, $slug)
    {
        $project = Projects::findBySlug($slug);
        if (!$project)
        {   
            flash("Project kon niet worden gevonden")->error();
            return redirect()->route("projects");
        }

        $project = Projects::updateFromRequest($project, $request);

        flash("Wijzigingen zijn opgeslagen!")->success();
        return redirect()->route("projects.view", $project->slug);
    }

    public function getDelete($slug)
    {
        $project = Projects::findBySlug($slug);
        if (!$project)
        {   
            flash("Project kon niet worden gevonden")->error();
            return redirect()->route("projects");
        }

        return view("pages.projects.delete", [
            "project" => $project,
        ]);
    }

    public function postDelete(DeleteProjectRequest $request, $slug)
    {
        $project = Projects::findBySlug($slug);
        if (!$project)
        {   
            flash("Project kon niet worden gevonden")->error();
            return redirect()->route("projects");
        }

        $project->delete();

        flash("Project is met success verwijderd.")->success();
        return redirect()->route("projects");
    }
}