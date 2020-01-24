<template>
    <div class="assignments-field__wrapper">

        <!-- Form field -->
        <div class="assignments-field">
            <div class="assignments-field__label">{{ labelText }}</div>
            <div class="assignments-field__assignments" v-if="mutableAssignments.length > 0">
                <div class="assignment" v-for="(assignment, ai) in mutableAssignments" :key="ai">
                    <div class="assignment-fields">
                        <div class="assignment-field">
                            <div class="field-key">Ministerie</div>
                            <div class="field-val">{{ getMinistryName(assignment.ministry_id) }}</div>
                        </div>
                        <div class="assignment-field">
                            <div class="field-key">Organisatie</div>
                            <div class="field-val">{{ getOrganizationName(assignment.organization_id) }}</div>
                        </div>
                        <div class="assignment-field">
                            <div class="field-key">Departement</div>
                            <div class="field-val">{{ getDepartmentName(assignment.department_id) }}</div>
                        </div>
                        <div class="assignment-field">
                            <div class="field-key">Functietitel</div>
                            <div class="field-val">{{ getJobTitleName(assignment.job_title_id) }}</div>
                        </div>
                    </div>
                    <div class="assignment-current" v-if="assignment.current">
                        Huidige aanstelling
                    </div>
                    <div class="assignment-actions">
                        <div class="action edit" @click="onClickEditAssignment(ai)">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                        <div class="action delete" @click="onClickDeleteAssignment(ai)">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="assignments-field__no-assignments" v-if="mutableAssignments.length === 0">
                Je hebt nog geen aanstellingen toegevoegd.
            </div>
            <div class="assignments-field__actions">
                <v-btn small color="primary" @click="onClickAddAssignment">
                    <i class="fas fa-plus"></i>
                    Aanwijzing toevoegen
                </v-btn>
            </div>
        </div>

        <!-- Add assignment dialog -->
        <v-dialog v-model="dialogs.add.show" width="500">
            <div class="dialog">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.add.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">Aanstelling toevoegen</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.add.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.add.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Ministry -->
                    <div class="form-field">
                        <v-select
                            label="Ministerie"
                            :items="ministryOptions"
                            v-model="dialogs.add.form.ministry_id">
                        </v-select>
                    </div>
                    <!-- Organization -->
                    <div class="form-field" v-if="dialogs.add.form.ministry_id > 0">
                        <v-select
                            label="Organisatie"
                            :items="dialogs.add.organizationOptions"
                            v-model="dialogs.add.form.organization_id">
                        </v-select>
                    </div>
                    <!-- Department -->
                    <div class="form-field" v-if="dialogs.add.form.organization_id > 0">
                        <v-select
                            label="Departement"
                            :items="dialogs.add.departmentOptions"
                            v-model="dialogs.add.form.department_id">
                        </v-select>
                    </div>
                    <!-- Job title -->
                    <div class="form-field" v-if="dialogs.add.form.department_id > 0">
                        <v-select
                            label="Functietitel"
                            :items="jobTitleOptions"
                            v-model="dialogs.add.form.job_title_id">
                        </v-select>
                    </div>
                    <!-- Current assignment toggle -->
                    <div class="form-field">
                        <v-checkbox
                            label="Huidige aanstelling"
                            v-model="dialogs.add.form.current">
                        </v-checkbox>
                    </div>
                </div>
                <!-- Controls -->
                <div class="dialog-controls">
                    <!-- Cancel -->
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.add.show = false">
                            <i class="fas fa-arrow-left"></i>
                            Annuleren
                        </v-btn>
                    </div>
                    <!-- Confirm delete -->
                    <div class="dialog-controls__right">
                        <v-btn depressed color="success" dark @click="onClickConfirmAddAssignment" :loading="dialogs.add.loading" :disabled="addAssignmentDisabled">
                            <i class="far fa-save"></i>
                            Opslaan
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Edit assignment dialog -->
        <v-dialog v-model="dialogs.edit.show" width="500">
            <div class="dialog" v-if="dialogs.edit.index !== null">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.edit.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">Aanstelling aanpassen</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.edit.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.edit.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Ministry -->
                    <div class="form-field">
                        <v-select
                            label="Ministerie"
                            :items="ministryOptions"
                            v-model="dialogs.edit.form.ministry_id">
                        </v-select>
                    </div>
                    <!-- Organization -->
                    <div class="form-field" v-if="dialogs.edit.form.ministry_id > 0">
                        <v-select
                            label="Organisatie"
                            :items="dialogs.edit.organizationOptions"
                            v-model="dialogs.edit.form.organization_id">
                        </v-select>
                    </div>
                    <!-- Department -->
                    <div class="form-field" v-if="dialogs.edit.form.organization_id > 0">
                        <v-select
                            label="Departement"
                            :items="dialogs.edit.departmentOptions"
                            v-model="dialogs.edit.form.department_id">
                        </v-select>
                    </div>
                    <!-- Job title -->
                    <div class="form-field" v-if="dialogs.edit.form.department_id > 0">
                        <v-select
                            label="Functietitel"
                            :items="jobTitleOptions"
                            v-model="dialogs.edit.form.job_title_id">
                        </v-select>
                    </div>
                    <!-- Current assignment toggle -->
                    <div class="form-field">
                        <v-checkbox
                            label="Huidige aanstelling"
                            v-model="dialogs.edit.form.current">
                        </v-checkbox>
                    </div>
                </div>
                <!-- Controls -->
                <div class="dialog-controls">
                    <!-- Cancel -->
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.edit.show = false">
                            <i class="fas fa-arrow-left"></i>
                            Annuleren
                        </v-btn>
                    </div>
                    <!-- Confirm delete -->
                    <div class="dialog-controls__right">
                        <v-btn depressed color="success" dark @click="onClickConfirmEditAssignment" :loading="dialogs.edit.loading" :disabled="editAssignmentDisabled">
                            <i class="far fa-save"></i>
                            Opslaan
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Delete assignment dialog -->
        <v-dialog v-model="dialogs.delete.show" width="500">
            <div class="dialog" v-if="dialogs.delete.index !== null">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.delete.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">Aanstelling verwijderen</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.delete.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.delete.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Text -->
                    <div class="dialog-text">
                        Weet je zeker dat je deze aanstelling wilt verwijderen?
                    </div>
                </div>
                <!-- Controls -->
                <div class="dialog-controls">
                    <!-- Cancel -->
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.delete.show = false">
                            <i class="fas fa-arrow-left"></i>
                            Nee, annuleren
                        </v-btn>
                    </div>
                    <!-- Confirm delete -->
                    <div class="dialog-controls__right">
                        <v-btn depressed color="red" dark @click="onClickConfirmDeleteAssignment" :loading="dialogs.delete.loading">
                            <i class="fas fa-trash-alt"></i>
                            Ja, verwijder
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Hidden input field -->
        <input type="hidden" :name="name" :value="encodedMutableAssignments">

    </div>
</template>

<script>
    export default {
        props: [
            "value",
            "label",
            "name",
            "errors",
            "ministries",
            "organizations",
            "departments",
            "jobTitles",
        ],
        data: () => ({
            tag: "[assignments-field]",
            mutableAssignments: [
                {
                    ministry_id: 1,
                    organization_id: 1,
                    department_id: 1,
                    job_title_id: 1,
                    current: true,
                }
            ],
            ministryOptions: [],
            jobTitleOptions: [],
            dialogs: {
                add: {
                    show: false,
                    loading: false,
                    errors: [],
                    organizationOptions: [],
                    departmentOptions: [],
                    form: {
                        ministry_id: 0,
                        organization_id: 0,
                        department_id: 0,
                        department_name: "",
                        job_title_id: 0,
                        job_title_name: "",
                        current: false,
                    }
                },
                edit: {
                    show: false,
                    index: null,
                    loading: false,
                    errors: [],
                    organizationOptions: [],
                    departmentOptions: [],
                    form: {
                        ministry_id: 0,
                        organization_id: 0,
                        department_id: 0,
                        department_name: "",
                        job_title_id: 0,
                        job_title_name: "",
                        current: false,
                    }
                },
                delete: {
                    show: false,
                    index: null,
                    loading: false,
                    errors: [],
                }
            }
        }),
        computed: {
            labelText() {
                return this.label !== undefined && this.label !== null && this.label !== "" ? this.label : "Aanstellingen";
            },
            addAssignmentDisabled() {
                return this.dialogs.add.ministry_id === 0 ||
                    this.dialogs.add.organization_id === 0 ||
                    this.dialogs.add.department_id === 0 ||
                    this.dialogs.add.job_title_id === 0;
            },
            editAssignmentDisabled() {
                return this.dialogs.edit.ministry_id === 0 ||
                    this.dialogs.edit.organization_id === 0 ||
                    this.dialogs.edit.department_id === 0 ||
                    this.dialogs.edit.job_title_id === 0;
            },
            encodedMutableAssignments() {
                return JSON.stringify(this.mutableAssignments);
            },
        },
        watch: {
            "dialogs.add.form.ministry_id": function() {
                if (this.dialogs.add.form.ministry_id > 0) {
                    this.dialogs.add.organizationOptions = this.generateOrganizationOptions(this.dialogs.add.form.ministry_id);
                }
            },
            "dialogs.add.form.organization_id": function() {
                if (this.dialogs.add.form.organization_id > 0) {
                    this.dialogs.add.departmentOptions = this.generateDepartmentOptions(this.dialogs.add.form.organization_id);
                }
            },
            "dialogs.edit.form.ministry_id": function() {
                if (this.dialogs.edit.form.ministry_id > 0) {
                    this.dialogs.edit.organizationOptions = this.generateOrganizationOptions(this.dialogs.edit.form.ministry_id);
                }
            },
            "dialogs.edit.form.organization_id": function() {
                if (this.dialogs.edit.form.organization_id > 0) {
                    this.dialogs.edit.departmentOptions = this.generateDepartmentOptions(this.dialogs.edit.form.organization_id);
                }
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" value: ", this.value);
                console.log(this.tag+" label: ", this.label);
                console.log(this.tag+" name: ", this.name);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" ministries: ", this.ministries);
                console.log(this.tag+" organizations: ", this.organizations);
                console.log(this.tag+" departments: ", this.departments);
                console.log(this.tag+" job titles: ", this.jobTitles);
                this.initializeData();
                this.generateMinistryOptions();
                this.generateJobTitleOptions();
            },
            initializeData() {
                if (this.value !== undefined && this.value !== null && this.value.length > 0) {
                    for (let i = 0; i < this.value.length; i++) {
                        this.mutableAssignments.push(this.value[i]);
                    }
                }
            },
            generateMinistryOptions() {
                if (this.ministries !== undefined && this.ministries !== null && this.ministries.length > 0) {
                    for (let i = 0; i < this.ministries.length; i++) {
                        this.ministryOptions.push({ 
                            text: this.ministries[i].name, 
                            value: this.ministries[i].id
                        });
                    }
                } else {
                    this.ministryOptions.push({ text: "Geen ministeries gevonden", value: 0 });
                }
            },
            generateOrganizationOptions(ministry_id) {
                let out = [];
                if (this.organizations !== undefined && this.organizations !== null && this.organizations.length > 0) {
                    for (let i = 0; i < this.organizations.length; i++) {
                        if (this.organizations[i].ministry_id === ministry_id) {
                            out.push({
                                text: this.organizations[i].name,
                                value: this.organizations[i].id,
                            });
                        }
                    }
                } else {
                    out.push({ text: "Geen organisaties gevonden", value: 0 });
                }
                return out;
            },
            generateDepartmentOptions(organization_id) {
                let out = [];
                if (this.departments !== undefined && this.departments !== null && this.departments.length > 0) {
                    for (let i = 0; i < this.departments.length; i++) {
                        if (this.departments[i].organization_id === organization_id) {
                            out.push({
                                text: this.departments[i].name,
                                value: this.departments[i].id,
                            });
                        }
                    }
                } else {
                    out.push({ text: "Geen departementen gevonden", value: 0 });
                }
                out.push({ text: "Anders, namelijk..", value: -1 });
                return out;
            },
            generateJobTitleOptions() {
                if (this.jobTitles !== undefined && this.jobTitles !== null && this.jobTitles.length > 0) {
                    for (let i = 0; i < this.jobTitles.length; i++) {
                        this.jobTitleOptions.push({
                            text: this.jobTitles[i].name,
                            value: this.jobTitles[i].id,
                        });
                    }
                } else {
                    this.jobTitleOptions.push({ text: "Geen functies gevonden", value: 0, });
                }
                this.jobTitleOptions.push({ text: "Anders, namelijk..", value: -1 });
            },
                onClickAddAssignment() {
                this.dialogs.add.show = true;
            },
            onClickConfirmAddAssignment() {
                
                if (this.dialogs.add.form.current && this.mutableAssignments.length > 0) {
                    for (let i = 0; i < this.mutableAssignments.length; i++) {
                        if (this.mutableAssignments[i].current) {
                            this.mutableAssignments[i].current = false;
                            break;
                        }
                    }
                }
                
                this.mutableAssignments.push({
                    ministry_id: this.dialogs.add.form.ministry_id,
                    organization_id: this.dialogs.add.form.organization_id,
                    department_id: this.dialogs.add.form.department_id,
                    job_title_id: this.dialogs.add.form.job_title_id,
                    current: this.dialogs.add.form.current,
                });
                
                this.dialogs.add.show = false;

            },
            onClickEditAssignment(index) {
                
                this.dialogs.edit.index = index;
                
                this.dialogs.edit.form.ministry_id = this.mutableAssignments[index].ministry_id;
                this.dialogs.edit.form.organization_id = this.mutableAssignments[index].organization_id;
                this.dialogs.edit.form.department_id = this.mutableAssignments[index].department_id;
                this.dialogs.edit.form.job_title_id = this.mutableAssignments[index].job_title_id;
                this.dialogs.edit.form.current = this.mutableAssignments[index].current;
                
                this.dialogs.edit.show = true;

            },
            onClickConfirmEditAssignment() {
                
                this.mutableAssignments[this.dialogs.edit.index].ministry_id = this.dialogs.edit.form.ministry_id;
                this.mutableAssignments[this.dialogs.edit.index].organization_id = this.dialogs.edit.form.organization_id;
                this.mutableAssignments[this.dialogs.edit.index].department_id = this.dialogs.edit.form.department_id;
                this.mutableAssignments[this.dialogs.edit.index].job_title_id = this.dialogs.edit.form.job_title_id;
                this.mutableAssignments[this.dialogs.edit.index].current = this.dialogs.edit.form.current;

                if (this.dialogs.edit.form.current && this.mutableAssignments.length > 1) {
                    for (let i = 0; i < this.mutableAssignments.length; i++) {
                        if (i !== index && this.mutableAssignments[i].current) {
                            this.mutableAssignments[i].current = false;
                        }
                    }
                }

                this.dialogs.edit.show = false;

            },
            onClickDeleteAssignment(index) {
                this.dialogs.delete.index = index;
                this.dialogs.delete.show = true;
            },
            onClickConfirmDeleteAssignment() {
                this.mutableAssignments.splice(this.dialogs.delete.index, 1);
                this.dialogs.delete.show = false;
            },
            getMinistryName(id) {
                if (this.ministries !== undefined && this.ministries !== null && this.ministries.length > 0) {
                    for (let i = 0; i < this.ministries.length; i++) {
                        if (this.ministries[i].id === id) {
                            return this.ministries[i].name;
                        }
                    }
                }
                return "-";
            },
            getOrganizationName(id) {
                if (this.organizations !== undefined && this.organizations !== null && this.organizations.length > 0) {
                    for (let i = 0; i < this.organizations.length; i++) {
                        if (this.organizations[i].id === id) {
                            return this.organizations[i].name;
                        }
                    }
                }
                return "-";
            },
            getDepartmentName(id) {
                if (this.departments !== undefined && this.departments !== null && this.departments.length > 0) {
                    for (let i = 0; i < this.departments.length; i++) {
                        if (this.departments[i].id === id) {
                            return this.departments[i].name;
                        }
                    }
                }
                return "-";
            },
            getJobTitleName(id) {
                if (this.jobTitles !== undefined && this.jobTitles !== null && this.jobTitles.length > 0) {
                    for (let i = 0; i < this.jobTitles.length; i++) {
                        if (this.jobTitles[i].id === id) {
                            return this.jobTitles[i].name;
                        }
                    }
                }
                return "-";
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    .assignments-field__wrapper {
        .assignments-field {
            .assignments-field__label {
                margin: 0 0 5px 0;
            }
            .assignments-field__assignments {
                .assignment {
                    padding: 15px;
                    margin: 0 0 15px 0;
                    border-radius: 3px;
                    position: relative;
                    box-sizing: border-box;
                    background-color: hsl(0, 0%, 95%);
                    .assignment-fields {
                        .assignment-field {
                            display: flex;
                            flex-direction: row;
                            .field-key {
                                font-weight: 500;
                                flex: 1;
                            }
                            .field-val {
                                flex: 3;
                            }
                        }
                    }
                    .assignment-current {
                        right: 15px;
                        bottom: 15px;
                        font-weight: 500;
                        position: absolute;
                    }
                    .assignment-actions {
                        top: 15px;
                        right: 15px;
                        display: flex;
                        position: absolute;
                        flex-direction: row;
                        .action {
                            width: 24px;
                            height: 24px;
                            display: flex;
                            font-size: .7em;
                            color: #ffffff;
                            border-radius: 3px;
                            margin: 0 0 0 10px;
                            transition: all .3s;
                            align-items: center;
                            justify-content: center;
                            background-color: #000;
                            &:first-child {
                                margin: 0;
                            }
                            &:hover {
                                cursor: pointer;
                                background-color: hsl(0, 0%, 25%);
                            }
                        }
                    }
                }
            }
            .assignments-field__no-assignments {
                font-size: .9em;
                padding: 10px 15px;
                border-radius: 3px;
                box-sizing: border-box;
                background-color: hsl(0, 0%, 95%);
            }
            .assignments-field__actions {
                display: flex;
                margin: 15px 0 0 0;
                flex-direction: row;
                align-items: center;
                justify-content: flex-end;
            }
        }
    }
</style>