<template>
    <div id="job-form">
        <div id="job-form__left">
            
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">
                    
                    <!-- Title -->
                    <div class="form-field">
                        <v-text-field 
                            name="title" 
                            label="Titel"
                            placeholder="Geef dit project een naam"
                            v-model="form.title" 
                            :error="hasErrors('title')" 
                            :error-messages="getErrors('title')">
                        </v-text-field>
                    </div>

                    <!-- Slogan -->
                    <div class="form-field">
                        <v-text-field
                            name="slogan"
                            label="Slogan"
                            placeholder="Een pakkende slagzin die de missie samenvat!"
                            v-model="form.slogan"
                            :error="hasErrors('slogan')"
                            :error-messages="getErrors('slogan')">
                        </v-text-field>
                    </div>

                    <!-- Problem -->
                    <div class="form-field">
                        <v-textarea
                            name="problem"
                            label="Probleemstelling"
                            placeholder="Omschrijf zo gevat mogelijk welk probleem er met dit project wordt opgelost."
                            v-model="form.problem"
                            :errors="hasErrors('problem')"
                            :error-messages="getErrors('problem')">
                        </v-textarea>
                    </div>

                    <!-- Description -->
                    <div class="form-field">
                        <v-textarea
                            name="description" 
                            label="Beschrijving" 
                            placeholder="Wat ga je precies maken en waarom? Hou het kort en bonding en leg uit welk probleem je oplost."
                            v-model="form.description" 
                            :error="hasErrors('description')" 
                            :error-messages="getErrors('description')">
                        </v-textarea>
                    </div>

                    <!-- Header image -->
                    <div class="image-field" :class="{ 'has-errors': hasErrors('header_image') }">
                        <div class="image-field__label">Header achtergrond plaatje</div>
                        <div class="image-field__image-wrapper" v-if="hasJob && jobHasImage">
                            <img class="image-field__image" :src="job.header_image_url">
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

            <div class="content-card elevation-1 mb">
                <div class="content-card__content">

                    <!-- Resources -->
                    <div class="form-field">
                        <resources-field
                            name="resources"
                            label="Resources"
                            v-model="form.resources"
                            :create-api-endpoint="createResourceApiEndpoint"
                            :update-api-endpoint="updateResourceApiEndpoint"
                            :delete-api-endpoint="deleteResourceApiEndpoint">
                        </resources-field>
                    </div>

                </div>
            </div>

            <div class="content-card elevation-1">
                <div class="content-card__content">

                    <!-- Team roles -->
                    <div class="form-field">
                        <team-roles-field
                            name="team_roles"
                            label="Team rollen"
                            v-model="form.team_roles"
                            :skills="skills">
                        </team-roles-field>
                    </div>

                </div>
            </div>

            <!-- Back button -->
            <div class="page-controls mt">
                <div class="page-controls__left">
                    <v-btn :href="backHref" outlined>
                        <i class="fas fa-arrow-left"></i>
                        Terug naar overzicht
                    </v-btn>
                </div>
            </div>

        </div>
        <!-- Right column -->
        <div id="job-form__right">

            <!-- Relationships card -->
            <div class="content-card elevation-1 mb">
                <div class="content-card__content">

                    <!-- Category -->
                    <div class="form-field">
                        <v-select
                            label="Project categorie"
                            :items="categoryOptions"
                            v-model="form.job_category_id"
                            :errors="hasErrors('job_category_id')"
                            :error-messages="getErrors('job_category_id')">
                        </v-select>
                        <input type="hidden" name="job_category_id" :value="form.job_category_id">
                    </div>

                    <!-- Work method -->
                    <div class="form-field">
                        <v-select
                            label="Werkmethode"
                            :items="workMethodOptions"
                            v-model="form.work_method_id"
                            :errors="hasErrors('work_method_id')"
                            :error-messages="getErrors('work_method_id')">
                        </v-select>
                        <input type="hidden" name="work_method_id" :value="form.work_method_id">
                    </div>  

                    <!-- Status -->
                    <div class="form-field">
                        <v-select
                            label="Project status"
                            :items="statusOptions"
                            v-model="form.job_status_id"
                            :errors="hasErrors('job_status_id')"
                            :error-messages="getErrors('job_status_id')">
                        </v-select>
                        <input type="hidden" name="job_status_id" :value="form.job_status_id">
                    </div>

                </div>
            </div>

            <!-- Dates card -->
            <div class="content-card elevation-1">
                <div class="content-card__content">

                    <!-- Starts at -->
                    <div class="form-field mb-10">
                        <datepicker
                            name="starts_at"
                            label="Start op"
                            v-model="form.starts_at"
                            :error="hasErrors('starts_at')"
                            :error-messages="getErrors('starts_at')">
                        </datepicker>
                    </div>

                    <!-- Ends at -->
                    <div class="form-field">
                        <datepicker
                            name="ends_at"
                            label="Eindigt op"
                            v-model="form.ends_at"
                            :error="hasErrors('ends_at')"
                            :error-messages="getErrors('ends_at')">
                        </datepicker>
                    </div>

                </div>
            </div>

            <!-- Submit button -->
            <div class="page-controls mt">
                <div class="page-controls__left">
                    <v-btn :href="backHref" outlined>
                        <i class="fas fa-arrow-left"></i>
                        Terug naar overzicht
                    </v-btn>
                </div>
                <div class="page-controls__right">
                    <v-btn type="submit" color="success">
                        <i class="fas fa-save"></i>
                        Opslaan
                    </v-btn>
                </div>
            </div>

        </div>        

    </div>
</template>

<script>
    export default {
        props: [
            "job",
            "jobStatuses",
            "jobCategories",
            "workMethods",
            "skills",
            "errors",
            "oldInput",
            "backHref",
            "createResourceApiEndpoint",
            "updateResourceApiEndpoint",
            "deleteResourceApiEndpoint",
        ],
        data: () => ({
            tag: "[job-form]",
            workMethodOptions: [],
            categoryOptions: [],
            statusOptions: [],
            form: {
                job_status_id: 0,
                job_category_id: 0,
                work_method_id: 0,
                title: "",
                slogan: "",
                problem: "",
                description: "",
                starts_at: "",
                ends_at: "",
                resources: [],
                team_roles: [],
            }
        }),
        computed: {
            hasJob() {
                return this.job !== undefined && this.job !== null && this.job !== "";
            },
            jobHasImage() {
                return this.hasJob && this.job.header_image_url !== null && this.job.header_image_url !== '';
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" job: ", this.job);
                console.log(this.tag+" job statuses: ", this.jobStatuses);
                console.log(this.tag+" job categories: ", this.jobCategories);
                console.log(this.tag+" work methods: ", this.workMethods);
                console.log(this.tag+" skills: ", this.skills);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" create resource api endpoint: ", this.createResourceApiEndpoint);
                console.log(this.tag+" update resource api endpoint: ", this.updateResourceApiEndpoint);
                console.log(this.tag+" delete resource api endpoint: ", this.deleteResourceApiEndpoint);
                this.generateWorkMethodOptions();
                this.generateCategoryOptions();
                this.generateStatusOptions();
                this.initializeData();
            },
            initializeData() {
                this.form.job_status_id = this.statusOptions[0].value;
                if (this.job !== undefined && this.job !== null) {
                    this.form.job_status_id = this.job.job_status_id;
                    this.form.job_category_id = this.job.job_category_id;
                    this.form.work_method_id = this.job.work_method_id;
                    this.form.title = this.job.title;
                    this.form.slogan = this.job.slogan;
                    this.form.problem = this.job.problem;
                    this.form.description = this.job.description;
                    this.form.starts_at = this.job.starts_at;
                    this.form.ends_at = this.job.ends_at;
                    if (this.job.resources !== undefined && this.job.resources !== null && this.job.resources.length > 0) {
                        this.form.resources = this.job.resources;
                    }
                    if (this.job.team_roles !== undefined && this.job.team_roles !== null && this.job.team_roles.length > 0) {
                        let teamRoles = [];
                        for (let i = 0; i < this.job.team_roles.length; i++) {
                            let skills = [];
                            for (let j = 0; j < this.job.team_roles[i].skills.length; j++) {
                                skills.push(this.job.team_roles[i].skills[j].name);
                            }
                            teamRoles.push({
                                name: this.job.team_roles[i].name,
                                description: this.job.team_roles[i].description,
                                skills: skills,
                            });
                        }
                        this.form.team_roles = teamRoles;
                    }
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.job_status_id !== null) this.form.job_status_id = this.oldInput.job_status_id;
                    if (this.oldInput.job_category_id !== null) this.form.job_category_id = this.oldInput.job_category_id;
                    if (this.oldInput.work_method_id !== null) this.form.work_method_id = this.oldInput.work_method_id;
                    if (this.oldInput.title !== null) this.form.title = this.oldInput.title;
                    if (this.oldInput.slogan !== null) this.form.slogan = this.oldInput.slogan;
                    if (this.oldInput.problem !== null) this.form.problem = this.oldInput.problem;
                    if (this.oldInput.description !== null) this.form.description = this.oldInput.description;
                    if (this.oldInput.starts_at !== null) this.form.starts_at = this.oldInput.starts_at;
                    if (this.oldInput.ends_at !== null) this.form.ends_at = this.oldInput.ends_at;
                    if (this.oldInput.resources !== null) this.form.resources = JSON.parse(this.oldInput.resources);
                    if (this.oldInput.team_roles !== null) this.form.team_roles = JSON.parse(this.oldInput.team_roles);
                }
            },
            generateStatusOptions() {
                if (this.jobStatuses !== undefined && this.jobStatuses !== null && this.jobStatuses.length > 0) {
                    for (let i = 0; i < this.jobStatuses.length; i++) {
                        this.statusOptions.push({
                            text: this.jobStatuses[i].label,
                            value: this.jobStatuses[i].id,
                        });
                    }
                } else {
                    this.statusOptions.push({ text: "Geen statusen gevonden", value: 0 });
                }
            },
            generateCategoryOptions() {
                if (this.jobCategories !== undefined && this.jobCategories !== null && this.jobCategories.length > 0) {
                    this.categoryOptions.push({ text: "Selecteer categorie", value: 0 });
                    for (let i = 0; i < this.jobCategories.length; i++) {
                        this.categoryOptions.push({
                            text: this.jobCategories[i].label,
                            value: this.jobCategories[i].id,
                        });
                    }
                } else {
                    this.categoryOptions.push({ text: "Geen categorieen gevonden", value: 0 });
                }
            },
            generateWorkMethodOptions() {
                if (this.workMethods !== undefined && this.workMethods !== null && this.workMethods.length > 0) {
                    this.workMethodOptions.push({ text: "Selecteer gewenste werkmethode", value: 0 });
                    for (let i = 0; i < this.workMethods.length; i++) {
                        this.workMethodOptions.push({
                            text: this.workMethods[i].label,
                            value: this.workMethods[i].id,
                        });
                    }
                } else {
                    this.workMethodOptions.push({ text: "Geen werkmethodes gevonden", value: 0 });
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
    #job-form {
        display: flex;
        flex-direction: row;
        #job-form__left {
            flex: 2;
        }
        #job-form__right {
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
        #job-form {
            flex-wrap: wrap;
            #job-form__left, #job-form__right {
                flex: 0 0 100%;
            }
            #job-form__left {
                .page-controls {
                    display: none;
                }
            }
            #job-form__right {
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