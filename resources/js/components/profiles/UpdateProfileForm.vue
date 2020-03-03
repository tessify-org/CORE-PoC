<template>
    <div id="update-profile-form__wrapper">

        <!-- Form -->
        <div id="update-profile-form" class="elevation-1">

            <!-- Annotation, first- & last name -->
            <div class="form-fields">
                <div class="form-field double">
                    <v-text-field 
                        :label="firstNameText"
                        v-model="form.first_name" 
                        name="first_name"
                        :error="hasErrors('first_name')"
                        :error-messages="getErrors('first_name')">
                    </v-text-field>
                </div>
                <div class="form-field double">
                    <v-text-field 
                        :label="lastNameText"
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
                    :label="emailText"
                    v-model="form.email" 
                    name="email"
                    :error="hasErrors('email')"
                    :error-messages="getErrors('email')">
                </v-text-field>
            </div>

            <!-- Phone number -->
            <div class="form-field">
                <v-text-field 
                    :label="phoneText"
                    v-model="form.phone" 
                    name="phone"
                    :error="hasErrors('phone')"
                    :error-messages="getErrors('phone')">
                </v-text-field>
            </div>

            <!-- Avatar & Header bg-->
            <div class="form-fields">
                <div class="image-field">
                    <div class="image-field__label">{{ avatarText }}</div>
                    <div class="image-field__image-wrapper">
                        <img class="image-field__image" :src="user.avatar_url">
                    </div>
                    <div class="image-field__input">
                        <input type="file" name="avatar">
                    </div>
                </div>
                <div class="image-field">
                    <div class="image-field__label">Header background</div>
                    <div class="image-field__image-wrapper">
                        <img class="image-field__image" :src="user.header_bg_url">
                    </div>
                    <div class="image-field__input">
                        <input type="file" name="header_bg">
                    </div>
                </div>
            </div>

            <!-- Headline -->
            <div class="form-field">
                <v-text-field
                    :label="headlineText"
                    v-model="form.headline"
                    name="headline"
                    :errors="hasErrors('headline')"
                    :error-messages="getErrors('headline')">
                </v-text-field>
            </div>

            <!-- Interests -->
            <div class="form-field">
                <v-textarea
                    :label="interestsText"
                    v-model="form.interests"
                    name="interests"
                    :errors="hasErrors('interests')"
                    :error-messages="getErrors('interests')">
                </v-textarea>
            </div>

            <!-- Current assignment -->
            <div class="form-field">
                <profile-current-assignment-field
                    name="current_assignment_id"
                    v-model="form.current_assignment_id"
                    :user="user"
                    :assignment-types="assignmentTypes"
                    :organizations="organizations"
                    :organization-locations="organizationLocations"
                    :departments="departments"
                    :create-api-endpoint="createAssignmentApiEndpoint">
                </profile-current-assignment-field>
            </div>

            <!-- Skills -->
            <div class="form-field">
                <profile-skills-field
                    name="skills"
                    v-model="form.skills"
                    :user="user"
                    :skills="skills"
                    label-text="Skills">
                </profile-skills-field>
            </div>

        </div>

        <!-- Controls -->
        <div class="form-controls">
            <div class="form-controls__left">
                <v-btn :href="backHref" outlined>
                    <i class="fas fa-arrow-left"></i>
                    {{ backText }}
                </v-btn>
            </div>
            <div class="form-controls__right">
                <v-btn color="success" type="submit" depressed>
                    <i class="far fa-save"></i>
                    {{ saveText }}
                </v-btn>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        props: [
            "user",
            "skills",
            "assignmentTypes",
            "organizations",
            "organizationLocations",
            "departments",
            "errors",
            "oldInput",
            "firstNameText",
            "lastNameText",
            "headlineText",
            "emailText",
            "phoneText",
            "avatarText",
            "interestsText",
            "assignmentsText",
            "backHref",
            "backText",
            "saveText",
            "createAssignmentApiEndpoint",
        ],
        data: () => ({
            tag: "[update-profile-form]",
            form: {
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                avatar: null,
                headline: "",
                interests: "",
                current_assignment_id: 0,
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
                console.log(this.tag+" skills: ", this.skills);
                console.log(this.tag+" assignment types: ", this.assignmentTypes);
                console.log(this.tag+" organizations: ", this.organizations);
                console.log(this.tag+" organization locations: ", this.organizationLocations);
                console.log(this.tag+" departments: ", this.departments);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" first name text: ", this.firstNameText);
                console.log(this.tag+" last name text: ", this.lastNameText);
                console.log(this.tag+" headline text: ", this.headlineText);
                console.log(this.tag+" interests text: ", this.interestsText);
                console.log(this.tag+" email text: ", this.emailText);
                console.log(this.tag+" phone text: ", this.phoneText);
                console.log(this.tag+" avatar text: ", this.avatarText);
                console.log(this.tag+" interests text: ", this.interestsText);
                console.log(this.tag+" assignments text: ", this.assignmentsText);
                console.log(this.tag+" back href: ", this.backHref);
                console.log(this.tag+" back text: ", this.backText);
                console.log(this.tag+" save text: ", this.saveText);
                console.log(this.tag+" create assignment api endpoint: ", this.createAssignmentApiEndpoint);
                this.initializeData();
            },
            initializeData() {
                if (this.user !== undefined && this.user !== null) {
                    this.form.first_name = this.user.first_name;
                    this.form.last_name = this.user.last_name;
                    this.form.email = this.user.email;
                    this.form.phone = this.user.phone;
                    this.form.headline = this.user.headline;
                    this.form.interests = this.user.interests;
                    if (this.user.assignments !== undefined && this.user.assignments !== null && this.user.assignments.length > 0) {
                        for (let i = 0; i < this.user.assignments.length; i++) {
                            if (this.user.assignments[i].current) {
                                this.form.current_assignment_id = this.user.assignments[i].id;
                            }
                        }
                    }
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.first_name !== null) this.form.first_name = this.oldInput.first_name;
                    if (this.oldInput.last_name !== null) this.form.last_name = this.oldInput.last_name;
                    if (this.oldInput.email !== null) this.form.email = this.oldInput.email;
                    if (this.oldInput.phone !== null) this.form.phone = this.oldInput.phone;
                    if (this.oldInput.headline !== null) this.form.headline = this.oldInput.headline;
                    if (this.oldInput.interests !== null) this.form.interests = this.oldInput.interests;
                    if (this.oldInput.current_assignment_id !== null) this.form.current_assignment_id = parseInt(this.oldInput.current_assignment_id);
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
    #update-profile-form__wrapper {
        #update-profile-form {
            padding: 25px;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: #fff;
        }
    }
    @media (max-width: 490px) {
        #update-profile-form__wrapper {
            #update-profile-form {
                .form-fields {
                    flex-direction: column;
                }
            }
        }
    }
</style>