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
    $t->parent("memberlist");
    $t->push("Memberlist", route("memberlist"));
}); 

// Profile
Breadcrumbs::for("profile", function($t, $user) {
    $t->parent("memberlist");
    $t->push("Profiel van ".$user->formattedName, route("profile", $user->slug));
});

// Jobs
Breadcrumbs::for("jobs", function($t) {
    $t->parent("home");
    $t->push("Jobs", route("jobs"));
});
Breadcrumbs::for("jobs.view", function($t, $job) {
    $t->parent("jobs");
    $t->push("Bekijk job", route("jobs.view", $job->slug));
});
