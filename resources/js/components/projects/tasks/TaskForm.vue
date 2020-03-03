<template>
    <div id="task-form__wrapper">

        <!-- Form -->
        <div id="task-form" class="elevation-1">

            <!-- Status -->
            <div class="form-field" v-if="editing">
                <v-select
                    :label="statusText"
                    :items="statusOptions"
                    v-model="form.task_status_id"
                    :errors="hasErrors('task_status_id')"
                    :error-messages="getErrors('task_status_id')">
                </v-select>
                <input type="hidden" name="task_status_id" :value="form.task_status_id">
            </div>

            <!-- Category -->
            <div class="form-field">
                <v-select
                    :label="categoryText"
                    :items="categoryOptions"
                    v-model="form.task_category_id"
                    :errors="hasErrors('task_category_id')"
                    :error-messages="getErrors('task_category_id')">
                </v-select> 
                <input type="hidden" name="task_category_id" :value="form.task_category_id">
            </div>

            <!-- Seniority -->
            <div class="form-field">
                <v-select
                    :label="seniorityText"
                    :items="seniorityOptions"
                    v-model="form.task_seniority_id"
                    :errors="hasErrors('task_seniority_id')"
                    :error-messages="getErrors('task_seniority_id')">
                </v-select>
                <input type="hidden" name="task_seniority_id" :value="form.task_seniority_id">
            </div>

            <!-- Title -->
            <div class="form-field">
                <v-text-field
                    name="title"
                    :label="titleText"
                    v-model="form.title"
                    :errors="hasErrors('title')"
                    :error-messages="getErrors('title')">
                </v-text-field>
            </div>

            <!-- Description -->
            <div class="form-field">
                <v-textarea
                    name="description"
                    :label="descriptionText"
                    v-model="form.description"
                    :errors="hasErrors('description')"
                    :error-messages="getErrors('description')">
                </v-textarea>
            </div>

            <!-- Complexity -->
            <div class="form-field">
                <v-select
                    :label="complexityText"
                    :items="complexityOptions"
                    v-model="form.complexity"
                    :errors="hasErrors('complexity')"
                    :error-messages="getErrors('complexity')">
                </v-select>
                <input type="hidden" name="complexity" :value="form.complexity">
            </div>

            <!-- Estimated hours -->
            <div class="form-field">
                <v-text-field
                    :label="estimatedHoursText"
                    name="estimated_hours"
                    v-model="form.estimated_hours"
                    :errors="hasErrors('estimated_hours')"
                    :error-messages="getErrors('estimated_hours')">
                </v-text-field>
            </div>

            <!-- Realized hours -->
            <div class="form-field" v-if="editing && isCompleted">
                <v-text-field
                    name="realized_hours"
                    :label="realizedHoursText"
                    v-model="form.realized_hours"
                    :errors="hasErrors('realized_hours')"
                    :error-messages="getErrors('realized_hours')">
                </v-text-field>
            </div>

            <!-- Required skills -->
            <div class="form-field">
                <required-skills-field
                    :task="task"
                    :skills="skills"
                    label-text="Required skills"
                    name="required_skills"
                    v-model="form.required_skills">
                </required-skills-field>
            </div>

            <!-- Urgency -->
            <div class="form-field">
                <v-select
                    label="Urgentie"
                    v-model="form.urgency"
                    :items="urgencyOptions"
                    :errors="hasErrors('urgency')"
                    :error-messages="getErrors('urgency')">
                </v-select>
                <input type="hidden" name="urgency" :value="form.urgency">
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
                <v-btn type="submit" color="success">
                    <i class="fas fa-save"></i>
                    {{ submitText }}
                </v-btn>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            "task",
            "skills",
            "errors",
            "oldInput",
            "statuses",
            "categories",
            "seniorities",
            "statusText",
            "categoryText",
            "seniorityText",
            "titleText",
            "descriptionText",
            "complexityText",
            "estimatedHoursText",
            "realizedHoursText",
            "selectCategoryText",
            "noCategoriesText",
            "selectSeniorityText",
            "noSenioritiesText",
            "selectStatusText",
            "noStatusesText",
            "backHref",
            "backText",
            "submitText",
        ],
        data: () => ({
            tag: "[task-form]",
            complexityOptions: [],
            seniorityOptions: [],
            categoryOptions: [],
            urgencyOptions: [],
            statusOptions: [],
            form: {
                task_status_id: 0,
                task_category_id: 0,
                task_seniority_id: 0,
                title: "",
                description: "",
                complexity: 1,
                estimated_hours: 0,
                realized_hours: 0,
                required_skills: [],
                urgency: 2,
            }
        }),
        computed: {
            editing() {
                return this.task !== undefined && this.task !== null && this.task !== "";
            },
            isCompleted() {
                let status = this.getStatusById(this.form.task_status_id);
                return status && status.name === "completed";
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" task: ", this.task);
                console.log(this.tag+" skills: ", this.skills);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" categories: ", this.categories);
                console.log(this.tag+" seniorities: ", this.seniorities);
                console.log(this.tag+" category text: ", this.categoryText);
                console.log(this.tag+" seniority text: ", this.seniorityText);
                console.log(this.tag+" title text: ", this.titleText);
                console.log(this.tag+" description text: ", this.descriptionText);
                console.log(this.tag+" complexity text: ", this.complexityText);
                console.log(this.tag+" estimated hours text: ", this.estimatedHoursText);
                console.log(this.tag+" realized hours text: ", this.realizedHoursText);
                console.log(this.tag+" select category text: ", this.selectCategoryText);
                console.log(this.tag+" no categories text: ", this.noCategoriesText);
                console.log(this.tag+" select seniority text: ", this.selectSeniorityText);
                console.log(this.tag+" no seniorities text: ", this.noSenioritiesText);
                console.log(this.tag+" select status text: ", this.selectStatusText);
                console.log(this.tag+" no statuses text: ", this.noStatusesText);
                console.log(this.tag+" back href: ", this.backHref);
                console.log(this.tag+" back text: ", this.backText);
                console.log(this.tag+" submit text: ", this.submitText);
                this.generateComplexityOptions();
                this.generateSeniorityOptions();
                this.generateCategoryOptions();
                this.generateUrgencyOptions();
                this.generateStatusOptions();
                this.initializeData();
            },
            generateComplexityOptions() {
                for (let i = 1; i <= 10; i++) {
                    this.complexityOptions.push({
                        text: i+"/10",
                        value: i
                    });
                }
            },
            generateSeniorityOptions() {
                if (this.seniorities !== undefined && this.seniorities !== null && this.seniorities.length > 0) {
                    this.seniorityOptions.push({
                        text: this.selectSeniorityText,
                        value: 0
                    });
                    for (let i = 0; i < this.seniorities.length; i++) {
                        this.seniorityOptions.push({
                            text: this.seniorities[i].label,
                            value: this.seniorities[i].id,
                        });
                    }
                } else {
                    this.seniorityOptions.push({
                        text: this.noSenioritiesText,
                        value: 0,
                    });
                }
            },
            generateCategoryOptions() {
                if (this.categories !== undefined && this.categories !== null && this.categories.length > 0) {
                    this.categoryOptions.push({ text: this.selectCategoryText, value: 0 });
                    for (let i = 0; i < this.categories.length; i++) {
                        this.categoryOptions.push({
                            text: this.categories[i].name,
                            value: this.categories[i].id,
                        });
                    }
                } else {
                    this.categoryOptions.push({ text: this.noCategoriesText, value: 0 });
                }
            },
            generateUrgencyOptions() {
                this.urgencyOptions.push({ text: "Laag", value: 1 });
                this.urgencyOptions.push({ text: "Normaal", value: 2 });
                this.urgencyOptions.push({ text: "Hoog", value: 3 });
            },
            generateStatusOptions() {
                if (this.statuses !== undefined && this.statuses !== null && this.statuses.length > 0) {
                    for (let i = 0; i < this.statuses.length; i++) {
                        this.statusOptions.push({
                            text: this.statuses[i].label,
                            value: this.statuses[i].id,
                        });
                    }
                } else {
                    this.statusOptions.push({
                        text: this.noStatusesText,
                        value: 0
                    });
                }
            },
            initializeData() {
                if (this.task !== undefined && this.task !== null) {
                    this.form.task_status_id = this.task.task_status_id;
                    this.form.task_category_id = this.task.task_category_id;
                    this.form.task_seniority_id = this.task.task_seniority_id;
                    this.form.title = this.task.title;
                    this.form.complexity = this.task.complexity;
                    this.form.description = this.task.description;
                    this.form.estimated_hours = this.task.estimated_hours;
                    this.form.realized_hours = this.task.realized_hours;
                    this.form.urgency = this.task.urgency;
                    if (this.task.skills !== undefined && this.task.skills !== null && this.task.skills.length > 0) {
                        for (let i = 0; i < this.task.skills.length; i++) {

                        }
                    }
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.task_status_id !== null) this.form.task_status_id = parseInt(this.oldInput.task_status_id);
                    if (this.oldInput.task_category_id !== null) this.form.task_category_id = parseInt(this.oldInput.task_category_id);
                    if (this.oldInput.task_seniority_id !== null) this.form.task_seniority_id = parseInt(this.oldInput.task_seniority_id);
                    if (this.oldInput.title !== null) this.form.title = this.oldInput.title;
                    if (this.oldInput.description !== null) this.form.description = this.oldInput.description;
                    if (this.oldInput.complexity !== null) this.form.complexity = parseInt(this.oldInput.complexity);
                    if (this.oldInput.estimated_hours !== null) this.form.estimated_hours = this.oldInput.estimated_hours;
                    if (this.oldInput.realized_hours !== null) this.form.realized_hours = this.oldInput.realized_hours;
                    if (this.oldInput.urgency !== null) this.form.urgency = this.oldInput.urgency;
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
            getStatusById(id) {
                if (this.statuses !== undefined && this.statuses !== null && this.statuses.length > 0) {
                    for (let i = 0; i < this.statuses.length; i++) {
                        if (this.statuses[i].id === id) {
                            return this.statuses[i];
                        }
                    }
                }
                return false;
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #task-form__wrapper {
        #task-form {
            padding: 25px;
            margin: 0 0 30px 0;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: #ffffff;
        }
    }
</style>