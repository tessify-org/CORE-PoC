<template>
    <div id="update-profile-form" class="elevation-1">

        <!-- Annotation, first- & last name -->
        <div class="form-fields">
            <div class="form-field">
                <v-select
                    label="Annotation"
                    v-model="form.annotation"
                    :items="annotationOptions"
                    :error="hasErrors('annotation')"
                    :error-messages="getErrors('annotation')">
                </v-select>
                <input type="hidden" name="annotation" :value="form.annotation">
            </div>
            <div class="form-field double">
                <v-text-field 
                    label="First name" 
                    v-model="form.first_name" 
                    name="first_name"
                    :error="hasErrors('first_name')"
                    :error-messages="getErrors('first_name')">
                </v-text-field>
            </div>
            <div class="form-field double">
                <v-text-field 
                    label="Last name" 
                    v-model="form.last_name" 
                    name="last_name"
                    :error="hasErrors('last_name')"
                    :error-messages="getErrors('last_name')">
                </v-text-field>
            </div>
        </div>

        <!-- Email address -->
        <div class="form-field">
            <v-text-field 
                label="Email address" 
                v-model="form.email" 
                name="email"
                :error="hasErrors('email')"
                :error-messages="getErrors('email')">
            </v-text-field>
        </div>

        <!-- Phone number -->
        <div class="form-field">
            <v-text-field 
                label="Phone number" 
                v-model="form.phone" 
                name="phone"
                :error="hasErrors('phone')"
                :error-messages="getErrors('phone')">
            </v-text-field>
        </div>

        <!-- Avatar -->
        <div class="image-field">
            <div class="image-field__label">Avatar</div>
            <div class="image-field__input">
                <input type="file" ref="add_file" v-on:change="onAvatarUpload('add')">
            </div>
        </div>

        <!-- Assignments -->
        <div class="form-field">
            <assignments-field
                name="assignments"
                label="Aanstellingen"
                :ministries="ministries"
                :organizations="organizations"
                :departments="departments"
                :job-titles="jobTitles"
                v-model="form.assignments">
            </assignments-field>
        </div>

        <!-- Controls -->
        <div class="form-controls">
            <div class="form-controls__left">
                <v-btn :href="backHref" outlined>
                    <i class="fas fa-arrow-left"></i>
                    Terug
                </v-btn>
            </div>
            <div class="form-controls__right">
                <v-btn color="success" type="submit" depressed>
                    <i class="far fa-save"></i>
                    Opslaan
                </v-btn>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            "user",
            "ministries",
            "organizations",
            "departments",
            "jobTitles",
            "errors",
            "oldInput",
            "backHref",
        ],
        data: () => ({
            tag: "[update-profile-form]",
            annotationOptions: [],
            ministryOptions: [],
            organizationOptions: [],
            departmentOptions: [],
            jobTitleOptions: [],
            form: {
                annotation: "",
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                assignments: [],
                avatar: null,
            }
        }),
        computed: {
            currentAssignmentId() {
                return 0;
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" user: ", this.user);
                console.log(this.tag+" ministries: ", this.ministries);
                console.log(this.tag+" organizations: ", this.organizations);
                console.log(this.tag+" departments: ", this.departments);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" back href: ", this.backHref);
                console.log(this.tag+" ");
                console.log(this.tag+" ");
                this.generateAnnotationOptions();
                this.initializeData();
            },
            initializeData() {
                if (this.user !== undefined && this.user !== null) {
                    this.form.annotation = this.user.annotation;
                    this.form.first_name = this.user.first_name;
                    this.form.last_name = this.user.last_name;
                    this.form.email = this.user.email;
                    this.form.phone = this.user.phone;
                    if (this.user.assignments !== undefined && this.user.assignments !== null && this.user.assignments.length > 0) {
                        
                    }
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.annotation !== null) this.form.annotation = this.oldInput.annotation;
                    if (this.oldInput.first_name !== null) this.form.first_name = this.oldInput.first_name;
                    if (this.oldInput.last_name !== null) this.form.last_name = this.oldInput.last_name;
                    if (this.oldInput.email !== null) this.form.email = this.oldInput.email;
                    if (this.oldInput.phone !== null) this.form.phone = this.oldInput.phone;
                    if (this.oldInput.assignments !== null) this.form.assignments = JSON.parse(this.oldInput.assignments);
                }
            },
            generateAnnotationOptions() {
                this.annotationOptions.push({ text: "Dhr.", value: "Dhr." });
                this.annotationOptions.push({ text: "Mevr.", value: "Mevr." });
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
            onAvatarUpload() {
                console.log("on avatar upload", dialog);
                this.form.avatar = this.$refs.edit_file.files[0];
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #update-profile-form {
        padding: 25px;
        border-radius: 3px;
        box-sizing: border-box;
        background-color: #fff;
    }
</style>