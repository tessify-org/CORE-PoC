<template>
    <div id="job-form">
        <div id="job-form__left">
            
            <div class="content-card elevation-1">
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

                    <!-- Status -->
                    <div class="form-field">
                        <v-select
                            label="Status"
                            :items="statusOptions"
                            v-model="form.job_status_id">
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
                            label="Starts at"
                            v-model="form.starts_at"
                            :error="hasErrors('starts_at')"
                            :error-messages="getErrors('starts_at')">
                        </datepicker>
                    </div>

                    <!-- Ends at -->
                    <div class="form-field">
                        <datepicker
                            name="ends_at"
                            label="Ends at"
                            v-model="form.ends_at"
                            :error="hasErrors('ends_at')"
                            :error-messages="getErrors('ends_at')">
                        </datepicker>
                    </div>

                </div>
            </div>

            <div class="page-controls mt">
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
            "errors",
            "oldInput",
            "backHref",
        ],
        data: () => ({
            tag: "[job-form]",
            statusOptions: [],
            form: {
                job_status_id: 0,
                title: "",
                description: "",
                starts_at: "",
                ends_at: "",
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
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                this.generateStatusOptions();
                this.initializeData();
            },
            initializeData() {
                this.form.job_status_id = this.statusOptions[0].value;
                if (this.job !== undefined && this.job !== null) {
                    this.form.job_status_id = this.job.job_status_id;
                    this.form.title = this.job.title;
                    this.form.description = this.job.description;
                    this.form.starts_at = this.job.starts_at;
                    this.form.ends_at = this.job.ends_at;
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.job_status_id !== null) this.form.job_status_id = this.oldInput.job_status_id;
                    if (this.oldInput.title !== null) this.form.title = this.oldInput.title;
                    if (this.oldInput.description !== null) this.form.description = this.oldInput.description;
                    if (this.oldInput.starts_at !== null) this.form.starts_at = this.oldInput.starts_at;
                    if (this.oldInput.ends_at !== null) this.form.ends_at = this.oldInput.ends_at;
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
        }
    }
</style>