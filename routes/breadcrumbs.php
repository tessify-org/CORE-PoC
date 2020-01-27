<?php

// Home
Breadcrumbs::for("home", function($t) {
    $t->push("Home", route("home"));
});

// Register
Breadcrumbs::for("auth.register", function($t) {
    $t->parent("home");
    $t->push("Registreren", route("auth.register"));
});

// Login
Breadcrumbs::for("auth.login", function($t) {
    $t->parent("home");
    $t->push("Login", route("auth.login"));
});

// Search
Breadcrumbs::for("search", function($t) {
    $t->parent("home");
    $t->push("Zoeken", route("search"));
});

// Memberlist
Breadcrumbs::for("memberlist", function($t) {
    $t->parent("home");
    $t->push("Memberlist", route("memberlist"));
}); 

// Profile
Breadcrumbs::for("profile", function($t, $user) {
    $t->parent("memberlist");
    $t->push("Profiel van ".$user->formattedName, route("profile", $user->slug));
});
Breadcrumbs::for("profile.update", function($t, $user) {
    $t->parent("profile", $user);
    $t->push("Update profiel", route("profile.update"));
});

// Jobs
Breadcrumbs::for("jobs", function($t) {
    $t->parent("home");
    $t->push("Job Board", route("jobs"));
});
Breadcrumbs::for("jobs.view", function($t, $job) {
    $t->parent("jobs");
    $t->push("Bekijk job", route("jobs.view", $job->slug));
});
Breadcrumbs::for("jobs.create", function($t) {
    $t->parent("jobs");
    $t->push("Job toevoegen", route("jobs.create"));
});
Breadcrumbs::for("jobs.edit", function($t, $job) {
    $t->parent("jobs.view", $job);
    $t->push("Job aanpassen", route("jobs.edit", $job->slug));
});
Breadcrumbs::for("jobs.delete", function($t, $job) {
    $t->parent("jobs.view", $job);
    $t->push("Job verwijderen", route("jobs.delete", $job->slug));
});

