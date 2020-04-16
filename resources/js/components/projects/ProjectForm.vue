<template>
    <div id="project-form">
        <div id="project-form__left">
            
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">
                    
                    <!-- Title -->
                    <div class="form-field">
                        <v-text-field 
                            name="title" 
                            :label="strings.title+'*'"
                            :placeholder="strings.title_hint"
                            v-model="form.title" 
                            :error="hasErrors('title')" 
                            :error-messages="getErrors('title')">
                        </v-text-field>
                    </div>

                    <!-- Slogan -->
                    <div class="form-field">
                        <v-text-field
                            name="slogan"
                            :label="strings.slogan+'*'"
                            :placeholder="strings.slogan_hint"
                            v-model="form.slogan"
                            :error="hasErrors('slogan')"
                            :error-messages="getErrors('slogan')">
                        </v-text-field>
                    </div>

                    <!-- Description -->
                    <div class="form-field">
                        <v-textarea
                            name="description" 
                            :label="strings.description+'*'"
                            :placeholder="strings.description_hint"
                            v-model="form.description" 
                            :error="hasErrors('description')" 
                            :error-messages="getErrors('description')">
                        </v-textarea>
                    </div>

                    <!-- Tags -->
                    <div class="form-field">
                        <v-combobox
                            multiple
                            :label="strings.tags"
                            :placeholder="strings.tags_hint"
                            v-model="form.tags"
                            :items="tagOptions"
                            :errors="hasErrors('tags')"
                            :error-messages="getErrors('tags')">
                        </v-combobox>
                        <input type="hidden" name="tags" :value="encodedTags">
                    </div>

                    <!-- Header image -->
                    <div class="image-field" :class="{ 'has-errors': hasErrors('header_image') }">
                        <div class="image-field__label">{{ strings.header_image }}</div>
                        <div class="image-field__image-wrapper" v-if="hasProject && projectHasImage">
                            <img class="image-field__image" :src="project.header_image_url">
                        </div>
                        <div class="image-field__input">
                            <input type="file" name="header_image">
                        </div>
                        <div class="image-field__errors" v-if="hasErrors('header_image')">
                            <div class="image-field__error" v-for="(error, ei) in getErrors('header_image')" :key="ei">
                                {{ error }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Roles -->
            <div class="content-card elevation-1 mb" v-if="project === undefined">
                <div class="content-card__content">

                    <!-- Team roles -->
                    <div class="form-field">
                        <team-roles-field
                            name="team_roles"
                            :label="strings.roles"
                            v-model="form.team_roles"
                            :skills="skills">
                        </team-roles-field>
                    </div>

                </div>
            </div>

            <!-- Resources -->
            <div class="content-card elevation-1">
                <div class="content-card__content">

                    <!-- Resources -->
                    <div class="form-field">
                        <resources-field
                            name="resources"
                            :label="strings.resources"
                            v-model="form.resources"
                            :strings="strings.resource_strings"
                            :create-api-endpoint="createResourceApiEndpoint"
                            :update-api-endpoint="updateResourceApiEndpoint"
                            :delete-api-endpoint="deleteResourceApiEndpoint">
                        </resources-field>
                    </div>

                </div>
            </div>

            <!-- Back button -->
            <div class="page-controls mt">
                <div class="page-controls__left">
                    <v-btn :href="backHref" outlined>
                        <i class="fas fa-arrow-left"></i>
                        {{ strings.back }}
                    </v-btn>
                </div>
            </div>

        </div>
        <!-- Right column -->
        <div id="project-form__right">

            <!-- Relationships card -->
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">

                    <!-- Status -->
                    <div class="form-field mb-0">
                        <v-select
                            :label="strings.status"
                            :items="statusOptions"
                            v-model="form.project_status_id"
                            :errors="hasErrors('project_status_id')"
                            :error-messages="getErrors('project_status_id')">
                        </v-select>
                        <input type="hidden" name="project_status_id" :value="form.project_status_id">
                    </div>

                    <!-- Phase -->
                    <div class="form-field mb-0">
                        <v-combobox
                            :label="strings.project_phase"
                            :items="phaseOptions"
                            v-model="form.project_phase"
                            :errors="hasErrors('project_phase')"
                            :error-messages="getErrors('project_phase')">
                        </v-combobox>
                        <input type="hidden" name="project_phase" :value="form.project_phase">
                    </div>

                    <!-- Category -->
                    <div class="form-field">
                        <v-combobox
                            :label="strings.category+'*'"
                            :items="categoryOptions"
                            v-model="form.project_category"
                            :errors="hasErrors('project_category')"
                            :error-messages="getErrors('project_category')">
                        </v-combobox>
                        <input type="hidden" name="project_category" :value="form.project_category">
                    </div> 

                    <!-- Work method -->
                    <div class="form-field">
                        <v-select
                            :label="strings.work_method"
                            :items="workMethodOptions"
                            v-model="form.work_method_id"
                            :errors="hasErrors('work_method_id')"
                            :error-messages="getErrors('work_method_id')">
                        </v-select>
                        <input type="hidden" name="work_method_id" :value="form.work_method_id">
                    </div> 

                </div>
            </div>

            <!-- Administrative -->
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">

                    <!-- Ministry -->
                    <div class="form-field">
                        <v-select
                            :label="strings.ministry"
                            v-model="form.ministry_id"
                            :items="ministryOptions"
                            :errors="hasErrors('ministry_id')"
                            :error-messages="getErrors('ministry_id')">
                        </v-select>
                        <input type="hidden" name="ministry_id" :value="form.ministry_id">
                    </div>

                    <!-- Project code -->
                    <div class="form-field">
                        <v-text-field
                            name="project_code"
                            :label="strings.project_code"
                            v-model="form.project_code"
                            :errors="hasErrors('project_code')"
                            :error-messages="getErrors('project_code')">
                        </v-text-field>
                    </div>

                    <!-- Budget -->
                    <div class="form-field">
                        <v-text-field
                            name="budget"
                            :label="strings.budget"
                            v-model="form.budget"
                            :errors="hasErrors('budget')"
                            :error-messages="getErrors('budget')">
                        </v-text-field>
                    </div>
                    
                </div>
            </div>

            <!-- Flags card -->
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">

                    <!-- Has tasks -->
                    <!-- 
                    <div class="form-field checkbox">
                        <v-checkbox
                            hide-details
                            :label="hasTasksText"
                            v-model="form.has_tasks">
                        </v-checkbox>
                        <input type="hidden" name="has_tasks" :value="form.has_tasks">
                    </div> 
                    -->

                    <!-- Has deadline -->
                    <div class="form-field checkbox">
                        <v-checkbox
                            hide-details
                            :label="strings.has_deadline"
                            v-model="form.has_deadline">
                        </v-checkbox>
                        <input type="hidden" name="has_deadline" :value="form.has_deadline">
                    </div>

                </div>
            </div>

            <!-- Dates card -->
            <div class="content-card elevation-1">
                <div class="content-card__content">

                    <!-- Starts at -->
                    <div class="form-field" :class="{ 'mb-10': form.has_deadline }">
                        <datepicker
                            name="starts_at"
                            :label="strings.start_date+'*'"
                            v-model="form.starts_at"
                            :error="hasErrors('starts_at')"
                            :error-messages="getErrors('starts_at')">
                        </datepicker>
                    </div>

                    <!-- Ends at -->
                    <div class="form-field" v-if="form.has_deadline">
                        <datepicker
                            name="ends_at"
                            :label="strings.deadline+'*'"
                            v-model="form.ends_at"
                            :error="hasErrors('ends_at')"
                            :error-messages="getErrors('ends_at')">
                        </datepicker>
                    </div>

                </div>
            </div>

            <!-- Submit button -->
            <div class="page-controls mt">
                <div class="page-controls__right">
                    <v-btn type="submit" color="success" block large>
                        <i class="fas fa-save"></i>
                        {{ strings.submit }}
                    </v-btn>
                </div>
            </div>

        </div>        

    </div>
</template>

<script>
    export default {
        props: [
            "project",
            "projectPhases",
            "projectStatuses",
            "projectCategories",
            "workMethods",
            "ministries",
            "skills",
            "tags",
            "errors",
            "oldInput",
            "strings",
            "backHref",
            "createResourceApiEndpoint",
            "updateResourceApiEndpoint",
            "deleteResourceApiEndpoint",
        ],
        data: () => ({
            tag: "[project-form]",
            workMethodOptions: [],
            categoryOptions: [],
            ministryOptions: [],
            statusOptions: [],
            phaseOptions: [],
            tagOptions: [],
            form: {
                project_status_id: 0,
                project_category: "",
                project_phase: "",
                work_method_id: null,
                title: "",
                slogan: "",
                description: "",
                tags: [],
                starts_at: "",
                ends_at: "",
                resources: [],
                team_roles: [],
                has_tasks: true,
                has_deadline: false,
                budget: 0,
            }
        }),
        computed: {
            hasProject() {
                return this.project !== undefined && this.project !== null && this.project !== "";
            },
            projectHasImage() {
                return this.hasProject && this.project.header_image_url !== null && this.project.header_image_url !== '';
            },
            encodedTags() {
                return JSON.stringify(this.form.tags);
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" project: ", this.project);
                console.log(this.tag+" project phases: ", this.projectPhases);
                console.log(this.tag+" project statuses: ", this.projectStatuses);
                console.log(this.tag+" project categories: ", this.projectCategories);
                console.log(this.tag+" work methods: ", this.workMethods);
                console.log(this.tag+" ministries: ", this.ministries);
                console.log(this.tag+" skills: ", this.skills);
                console.log(this.tag+" tags: ", this.tags);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" strings: ", this.strings);
                console.log(this.tag+" create resource api endpoint: ", this.createResourceApiEndpoint);
                console.log(this.tag+" update resource api endpoint: ", this.updateResourceApiEndpoint);
                console.log(this.tag+" delete resource api endpoint: ", this.deleteResourceApiEndpoint);
                console.log(this.tag+" back href: ", this.backHref);
                this.generateWorkMethodOptions();
                this.generateCategoryOptions();
                this.generateMinistryOptions();
                this.generateStatusOptions();
                this.generatePhaseOptions();
                this.generateTagOptions();
                this.initializeData();
            },
            initializeData() {
                
                // Set default status (to the first available option)
                this.form.project_status_id = this.statusOptions[0].value;

                // If we received a project, load it's data
                if (this.project !== undefined && this.project !== null) {
                    this.form.project_status_id = this.project.project_status_id;
                    this.form.project_category = this.project.category.label;
                    if (this.project.phase) this.form.project_phase = this.project.phase.name;
                    this.form.work_method_id = this.project.work_method_id;
                    this.form.ministry_id = this.project.ministry_id;
                    this.form.title = this.project.title;
                    this.form.slogan = this.project.slogan;
                    this.form.description = this.project.description;
                    this.form.starts_at = this.project.starts_at;
                    this.form.ends_at = this.project.ends_at;
                    this.form.has_tasks = this.project.has_tasks;
                    this.form.budget = this.project.budget;
                    this.form.project_code = this.project.project_code;
                    if (this.project.resources !== undefined && this.project.resources !== null && this.project.resources.length > 0) {
                        this.form.resources = this.project.resources;
                    }
                    if (this.project.team_roles !== undefined && this.project.team_roles !== null && this.project.team_roles.length > 0) {
                        let teamRoles = [];
                        for (let i = 0; i < this.project.team_roles.length; i++) {
                            let skills = [];
                            for (let j = 0; j < this.project.team_roles[i].skills.length; j++) {
                                skills.push(this.project.team_roles[i].skills[j].name);
                            }
                            teamRoles.push({
                                name: this.project.team_roles[i].name,
                                description: this.project.team_roles[i].description,
                                skills: skills,
                            });
                        }
                        this.form.team_roles = teamRoles;
                    }
                    if (this.project.tags !== undefined && this.project.tags !== null && this.project.tags.length > 0) {
                        for (let i = 0; i < this.project.tags.length; i++) {
                            this.form.tags.push(this.project.tags[i].name);
                        }
                    }
                }

                // If we received old input, load that data (overwriting whatever is in there)
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.project_phase_id !== null) this.form.project_phase_id = this.oldInput.project_phase_id;
                    if (this.oldInput.project_status_id !== null) this.form.project_status_id = this.oldInput.project_status_id;
                    if (this.oldInput.project_category_id !== null) this.form.project_category_id = this.oldInput.project_category_id;
                    if (this.oldInput.work_method_id !== null) this.form.work_method_id = this.oldInput.work_method_id;
                    if (this.oldInput.ministry_id !== null) this.form.ministry_id = parseInt(this.oldInput.ministry_id);
                    if (this.oldInput.title !== null) this.form.title = this.oldInput.title;
                    if (this.oldInput.slogan !== null) this.form.slogan = this.oldInput.slogan;
                    if (this.oldInput.description !== null) this.form.description = this.oldInput.description;
                    if (this.oldInput.starts_at !== null) this.form.starts_at = this.oldInput.starts_at;
                    if (this.oldInput.ends_at !== null) this.form.ends_at = this.oldInput.ends_at;
                    if (this.oldInput.resources !== null) this.form.resources = JSON.parse(this.oldInput.resources);
                    if (this.oldInput.team_roles !== null) this.form.team_roles = JSON.parse(this.oldInput.team_roles);
                    if (this.oldInput.has_tasks !== null) this.form.has_tasks = this.oldInput.has_tasks === "true" ? true : false;
                    if (this.oldInput.budget !== null) this.form.budget = parseInt(this.oldInput.budget);
                    if (this.oldInput.project_code !== null) this.form.project_code = this.oldInput.project_code;
                    if (this.oldInput.tags !== null) this.form.tags = JSON.parse(this.oldInput.tags);
                }

            },
            generateStatusOptions() {
                if (this.projectStatuses !== undefined && this.projectStatuses !== null && this.projectStatuses.length > 0) {
                    for (let i = 0; i < this.projectStatuses.length; i++) {
                        this.statusOptions.push({
                            text: this.projectStatuses[i].label,
                            value: this.projectStatuses[i].id,
                        });
                    }
                } else {
                    this.statusOptions.push({ text: "Geen statusen gevonden", value: 0 });
                }
            },
            generateCategoryOptions() {
                if (this.projectCategories !== undefined && this.projectCategories !== null && this.projectCategories.length > 0) {
                    for (let i = 0; i < this.projectCategories.length; i++) {
                        this.categoryOptions.push(this.projectCategories[i].label);
                    }
                }
            },
            generateWorkMethodOptions() {
                if (this.workMethods !== undefined && this.workMethods !== null && this.workMethods.length > 0) {
                    this.workMethodOptions.push({ text: "Selecteer gewenste werkmethode", value: null });
                    for (let i = 0; i < this.workMethods.length; i++) {
                        this.workMethodOptions.push({
                            text: this.workMethods[i].label,
                            value: this.workMethods[i].id,
                        });
                    }
                } else {
                    this.workMethodOptions.push({ text: "Geen werkmethodes gevonden", value: null });
                }
            },
            generateMinistryOptions() {
                if (this.ministries !== undefined && this.ministries !== null && this.ministries.length > 0) {
                    for (let i = 0; i < this.ministries.length; i++) {
                        this.ministryOptions.push({
                            text: this.ministries[i].name,
                            value: this.ministries[i].id,
                        });
                    }
                } else {
                    this.ministryOptions.push({ text: "Geen ministeries gevonden", value: 0 });
                }
            },
            generatePhaseOptions() {
                if (this.projectPhases !== undefined && this.projectPhases !== null && this.projectPhases.length > 0) {
                    for (let i = 0; i < this.projectPhases.length; i++) {
                        this.phaseOptions.push(this.projectPhases[i].name);
                    }
                }
            },
            generateTagOptions() {
                if (this.tags !== undefined && this.tags !== null && this.tags.length > 0) {
                    for (let i = 0; i < this.tags.length; i++) {
                        this.tagOptions.push(this.tags[i].name);
                    }
                }
            },
            hasErrors(field) {
                if (this.errors !== undefined && this.errors !== null && this.errors.length > 0) {
                    if (this.errors[field] !==  undefined &&  this.errors[field] !== "") {
                        return true;
                    }
                }
                return false;
            },
            getErrors(field) {
                if (this.errors !== undefined && this.errors !== null && this.errors[field] !== undefined && this.errors[field] !== null) {
                    return this.errors[field];
                }
                return [];
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #project-form {
        display: flex;
        flex-direction: row;
        #project-form__left {
            flex: 2;
        }
        #project-form__right {
            flex: 1;
            margin: 0 0 0 30px;
            .page-controls {
                .page-controls__left {
                    display: none;
                }
            }
        }
    }
    @media (max-width: 760px) {
        #project-form {
            flex-wrap: wrap;
            #project-form__left, #project-form__right {
                flex: 0 0 100%;
            }
            #project-form__left {
                .page-controls {
                    display: none;
                }
            }
            #project-form__right {
                margin: 30px 0 0 0;
                .page-controls {
                    .page-controls__left {
                        display: block;
                    }
                }
            }
        }
    }
</style>