<?php

//
// Frontend Breadcrumbs
//

// Home
Breadcrumbs::for("home", function($t) {
    $t->push(__('tessify-core::breadcrumbs.home'), route("home"));
});

// Static pages
Breadcrumbs::for("press", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.press"), route("press"));
});
Breadcrumbs::for("partners", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.partners"), route("partners"));
});
Breadcrumbs::for("about", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.about"), route("about"));
});
Breadcrumbs::for("do-more", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.do_more"), route("do-more"));
});
Breadcrumbs::for("faq", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.faq"), route("faq"));
});
Breadcrumbs::for("contact", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.contact"), route("contact"));
});

// Register
Breadcrumbs::for("auth.register", function($t) {
    $t->parent("home");
    $t->push(__('tessify-core::breadcrumbs.register'), route("auth.register"));
});

// Login
Breadcrumbs::for("auth.login", function($t) {
    $t->parent("home");
    $t->push(__('tessify-core::breadcrumbs.login'), route("auth.login"));
});

// Forgot password
Breadcrumbs::for("auth.forgot-password", function($t) {
    $t->parent("auth.login");
    $t->push(__('tessify-core::breadcrumbs.forgot_password'), route("auth.forgot-password"));
});

// Reset password
Breadcrumbs::for("auth.reset-password", function($t, $data) {
    $t->parent("auth.forgot-password");
    $t->push(__('tessify-core::breadcrumbs.reset_password'), route("auth.reset-password", ["code" => $data["code"], "email" => $data["email"]]));
});

// Search
Breadcrumbs::for("search", function($t) {
    $t->parent("home");
    $t->push(__('tessify-core::breadcrumbs.search'), route("search"));
});

// Memberlist
Breadcrumbs::for("memberlist", function($t) {
    $t->parent("home");
    $t->push(__('tessify-core::breadcrumbs.memberlist'), route("memberlist"));
}); 

// Profile
Breadcrumbs::for("profile", function($t, $user) {
    $t->parent("memberlist");
    $t->push(__('tessify-core::breadcrumbs.profile', ['name' => $user->formattedName]), route('profile', $user->slug));
});
Breadcrumbs::for("profile.update", function($t, $user) {
    $t->parent("profile", $user);
    $t->push(__('tessify-core::breadcrumbs.profile_update'), route("profile.update"));
});

// Projects
Breadcrumbs::for("projects", function($t) {
    $t->parent("home");
    $t->push(__('tessify-core::breadcrumbs.projects'), route("projects"));
});
Breadcrumbs::for("projects.view", function($t, $project) {
    $t->parent("projects");
    // $t->push(__('tessify-core::breadcrumbs.projects_view'), route("projects.view", $project->slug));
    $t->push($project->title, route("projects.view", $project->slug));
});
Breadcrumbs::for("projects.create", function($t) {
    $t->parent("projects");
    $t->push(__('tessify-core::breadcrumbs.projects_create'), route("projects.create"));
});
Breadcrumbs::for("projects.edit", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__('tessify-core::breadcrumbs.projects_update'), route("projects.edit", $project->slug));
});
Breadcrumbs::for("projects.delete", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_delete"), route("projects.delete", $project->slug));
});

// Project > Teams
Breadcrumbs::for("projects.team.view", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_view"), route("projects.team.view", $project->slug));
});
Breadcrumbs::for("projects.team.leave", function($t, $project) {
    $t->parent("projects.team.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_leave"), route("projects.team.leave", $project->slug));
});

// Project > Team > Applications
Breadcrumbs::for("projects.team.applications", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_applications"), route("projects.team.applications", $project->slug));
});
Breadcrumbs::for("projects.team.applications.view", function($t, $project, $application) {
    $t->parent("projects.team.applications", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_applications_view"), route("projects.team.applications.view", ["slug" => $project->slug, "uuid" => $application->uuid]));
});
Breadcrumbs::for("projects.team.applications.edit", function($t, $project, $application) {
    $t->parent("projects.team.applications.view", $project, $application);
    $t->push(__("tessify-core::breadcrumbs.projects_team_applications_edit"), route("projects.team.applications.edit", ["slug" => $project->slug, "uuid" => $application->uuid]));
});
Breadcrumbs::for("projects.team.applications.delete", function($t, $project, $application) {
    $t->parent("projects.team.applications.view", $project, $application);
    $t->push(__("tessify-core::breadcrumbs.projects_team_applications_delete"), route("projects.team.applications.delete", ["slug" => $project->slug, "uuid" => $application->uuid]));
});
Breadcrumbs::for("projects.team.apply", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_apply"), route("projects.team.apply", $project->slug));
});

// Project > Team  > Members
Breadcrumbs::for("projects.team.change-roles", function($t, $project, $user) {
    $t->parent("projects.team.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_change_roles"), route("projects.team.change-roles", ["slug" => $project->slug, 'userSlug' => $user->slug]));
});
Breadcrumbs::for("projects.team.remove-member", function($t, $project, $user) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_member_remove"), route("projects.team.remove-member", ['slug' => $project->slug, 'userSlug' => $user->slug]));
});
Breadcrumbs::for("projects.team.invite-member", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_member_invite"), route("projects.team.invite-member", $project->slug));
});

// Project > Team > Roles
Breadcrumbs::for("projects.team.roles.create", function($t, $project) {
    $t->parent("projects.team.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_role_create"), route("projects.team.roles.create", $project->slug));
});
Breadcrumbs::for("projects.team.roles.edit", function($t, $project, $role) {
    $t->parent("projects.team.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_role_update"), route("projects.team.roles.edit", ["slug" => $project->slug, "roleSlug" => $role->slug]));
});
Breadcrumbs::for("projects.team.roles.delete", function($t, $project, $role) {
    $t->parent("projects.team.view", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_team_role_delete"), route("projects.team.roles.delete", ["slug" => $project->slug, "roleSlug" => $role->slug]));
});

// Projects > Tasks
Breadcrumbs::for("projects.tasks", function($t, $project) {
    $t->parent("projects.view", $project);
    $t->push(__('tessify-core::breadcrumbs.projects_tasks'), route("projects.tasks", $project->slug));
});
Breadcrumbs::for("projects.tasks.view", function($t, $project, $task) {
    $t->parent("projects.tasks", $project);
    $t->push(__("tessify-core::breadcrumbs.projects_tasks_view"), route("projects.tasks.view", ["slug" => $project->slug, "taskSlug" => $task->slug]));
});

// Tasks
Breadcrumbs::for("tasks", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.tasks"), route("tasks"));
});
Breadcrumbs::for("tasks.view", function($t, $task) {
    $t->parent("tasks");
    // $t->push(__("tessify-core::breadcrumbs.tasks_view"), route("tasks.view", ["slug" => $task->slug]));
    $t->push(ucfirst($task->title), route("tasks.view", ["slug" => $task->slug]));
});
Breadcrumbs::for("tasks.create", function($t, $project = null) {
    $t->parent("tasks");
    if (!is_null($project)) {
        $t->push(__("tessify-core::breadcrumbs.tasks_create"), route("tasks.create", $project->slug));
    } else {
        $t->push(__("tessify-core::breadcrumbs.tasks_create"), route("tasks.create"));
    }
});
Breadcrumbs::for("tasks.edit", function($t, $task) {
    $t->parent("tasks.view", $task);
    $t->push(__("tessify-core::breadcrumbs.tasks_edit"), route("tasks.edit", ["slug" => $task->slug]));
});
Breadcrumbs::for("tasks.delete", function($t, $task) {
    $t->parent("tasks.view", $task);
    $t->push(__("tessify-core::breadcrumbs.tasks_delete"), route("tasks.delete", ["slug" => $task->slug]));
});
Breadcrumbs::for("tasks.abandon", function($t, $task) {
    $t->parent("tasks.view", $task);
    $t->push(__("tessify-core::breadcrumbs.task_abandon"), route("tasks.abandon", ["slug" => $task->slug]));
});
Breadcrumbs::for("tasks.report-progress", function($t, $task) {
    $t->parent("tasks.view", $task);
    $t->push(__("tessify-core::breadcrumbs.task_report_progress"), route("tasks.report-progress", ["slug" => $task->slug]));
});
Breadcrumbs::for("tasks.progress-report", function($t, $task, $report) {
    $t->parent("tasks.view", $task);
    $t->push(__("tessify-core::breadcrumbs.task_progress_report"), route("tasks.progress-report", ["slug" => $task->slug, "uuid" => $report->uuid]));
});
Breadcrumbs::for("tasks.progress-report.review", function($t, $task, $report) {
    $t->parent("tasks.progress-report", $task, $report);
    $t->push(__("tessify-core::breadcrumbs.task_review_progress_report"), route("tasks.progress-report.review", ["slug" => $task->slug, "uuid" => $report->uuid]));
});

// Notifications
Breadcrumbs::for("notifications", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.notifications"), route("notifications"));
});

// Messages
Breadcrumbs::for("messages", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.messages"), route("messages"));
});
Breadcrumbs::for("messages.outbox", function($t) {
    $t->parent("messages");
    $t->push(__("tessify-core::breadcrumbs.messages_outbox"), route("messages.outbox"));
});
Breadcrumbs::for("messages.send", function($t) {
    $t->parent("messages");
    $t->push(__("tessify-core::breadcrumbs.messages_send"), route("messages.send"));
});
Breadcrumbs::for("messages.read", function($t, $message) {
    if (Auth::user()->id == $message->sender_id) {
        $t->parent("messages.outbox");
    } else {
        $t->parent("messages");
    }
    $t->push(__("tessify-core::breadcrumbs.messages_read"), route("messages.read", $message->uuid));
});

// Settings
Breadcrumbs::for("settings", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.settings"), route("settings"));
});

// Dashboard
Breadcrumbs::for("dashboard", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.dashboard"), route("dashboard"));
});

Breadcrumbs::for("bug-report-submitted", function($t) {
    $t->parent("home");
    $t->push(__("tessify-core::breadcrumbs.bug_report_submitted"), route("home"));
});

//
// Admin Panel Breadcrumbs
//

// Dashboard
Breadcrumbs::for("admin.dashboard", function($t) {
    $t->push(__('tessify-core::breadcrumbs.admin_dashboard'), route("admin.dashboard"));
});

// Manage users
Breadcrumbs::for("admin.users", function($t) {
    $t->parent("admin.dashboard");
    $t->push(__("tessify-core::breadcrumbs.admin_users"), route("admin.users"));
});
Breadcrumbs::for("admin.users.view", function($t, $user) {
    $t->parent("admin.users");
    $t->push($user->formattedName, route("admin.users.view", $user->id));
});
Breadcrumbs::for("admin.users.create", function($t) {
    $t->parent("admin.users");
    $t->push(__("tessify-core::breadcrumbs.admin_users_create"), route("admin.users.create"));
});
Breadcrumbs::for("admin.users.edit", function($t, $user) {
    $t->parent("admin.users.view", $user);
    $t->push(__("tessify-core::breadcrumbs.admin_users_edit"), route("admin.users.edit", $user->id));
});
Breadcrumbs::for("admin.users.delete", function($t, $user) {
    $t->parent("admin.users.view", $user);
    $t->push(__("tessify-core::breadcrumbs.admin_users_delete"), route("admin.users.delete", $user->id));
});
Breadcrumbs::for("admin.users.ban", function($t, $user) {
    $t->parent("admin.users.view", $user);
    $t->push(__("tessify-core::breadcrumbs.admin_users_ban"), route("admin.users.ban", $user->id));
});