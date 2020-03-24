<template>
    <div id="required-skills-field">

        <!-- Label -->
        <div id="required-skills-field__label">{{ labelText }}</div>

        <!-- Skills -->
        <div id="required-skills-field__skills" v-if="mutableSkills.length > 0">
            <div class="required-skills-field__skill" v-for="(skill, si) in mutableSkills" :key="si">
                <div class="skill-name">{{ skill.skill }}</div>
                <div class="skill-required-mastery">{{ skill.required_mastery }}/10</div>
                <div class="skill-actions">
                    <div class="skill-action view" @click="onClickView(si)">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="skill-action edit" @click="onClickEdit(si)">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="skill-action delete" @click="onClickDelete(si)">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- No skills -->
        <div id="required-skills-field__no-records" v-if="mutableSkills.length === 0">
            {{ noRecordsText }}
        </div>

        <!-- Actions -->
        <div id="required-skills-field__actions">
            <v-btn color="primary" depressed small @click="onClickAdd">
                <i class="fas fa-plus"></i>
                {{ addButtonText }}
            </v-btn>
        </div>

        <!-- View required skill dialog -->
        <v-dialog v-model="dialogs.view.show" width="500">
            <div class="dialog" v-if="this.dialogs.view.index !== null">
                <div class="dialog__close-button" @click="dialogs.view.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <div class="dialog-content">
                    <h3 class="dialog-title">{{ viewTitleText }}</h3>
                    <div class="dialog-text">
                        <div class="details bordered mb-0">
                            <div class="detail">
                                <div class="key">{{ viewSkillText }}</div>
                                <div class="val">{{ mutableSkills[this.dialogs.view.index].skill }}</div>
                            </div>
                            <div class="detail">
                                <div class="key">{{ viewRequiredMasteryText }}</div>
                                <div class="val">{{ mutableSkills[this.dialogs.view.index].required_mastery }} / 10</div>
                            </div>
                            <div class="detail" v-if="mutableSkills[this.dialogs.view.index].description !== '' && mutableSkills[this.dialogs.view.index].description !== null">
                                <div class="key">{{ viewDescriptionText }}</div>
                                <div class="val">{{ mutableSkills[this.dialogs.view.index].description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialog-controls">
                    <div class="dialog-controls__right">
                        <v-btn depressed color="warning" @click="onClickEdit(dialogs.view.index)">
                            <i class="fas fa-edit"></i>
                            {{ viewEditText }}
                        </v-btn>
                        <v-btn depressed dark color="red" @click="onClickDelete(dialogs.view.index)">
                            <i class="fas fa-trash-alt"></i>
                            {{ viewDeleteText }}
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Add required skill dialog -->
        <v-dialog v-model="dialogs.add.show" width="500">
            <div class="dialog">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.add.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">{{ addTitleText }}</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.add.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.add.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Skill -->
                    <div class="form-field">
                        <v-combobox
                            :label="formSkillText"
                            :items="skillOptions"
                            v-model="dialogs.add.form.skill">
                        </v-combobox>
                    </div>
                    <!-- Mastery -->
                    <div class="form-field">
                        <v-select
                            :items="masteryOptions"
                            :label="formRequiredMasteryText"
                            v-model="dialogs.add.form.required_mastery">
                        </v-select>
                    </div>
                    <!-- Description -->
                    <div class="form-field">
                        <v-textarea
                            :label="formDescriptionText"
                            v-model="dialogs.add.form.description">
                        </v-textarea>
                    </div>
                </div>
                <!-- Controls -->
                <div class="dialog-controls">
                    <!-- Cancel -->
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.add.show = false">
                            <i class="fas fa-arrow-left"></i>
                            {{ addCancelText }}
                        </v-btn>
                    </div>
                    <!-- Confirm delete -->
                    <div class="dialog-controls__right">
                        <v-btn
                            depressed
                            color="success"
                            @click="onClickConfirmAdd"
                            :dark="!confirmAddDisabled"
                            :loading="dialogs.add.loading"
                            :disabled="confirmAddDisabled">
                            <i class="far fa-save"></i>
                            {{ addSubmitText }}
                        </v-btn>
                    </div>
                </div>

            </div>
        </v-dialog>

        <!-- Edit required skill dialog -->
        <v-dialog v-model="dialogs.edit.show" width="500">
            <div class="dialog">
                <div class="dialog__close-button" @click="dialogs.edit.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">{{ editTitleText }}</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.edit.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.edit.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Skill -->
                    <div class="form-field">
                        <v-combobox
                            :label="formSkillText"
                            :items="skillOptions"
                            v-model="dialogs.edit.form.skill">
                        </v-combobox>
                    </div>
                    <!-- Mastery -->
                    <div class="form-field">
                        <v-select
                            :label="formRequiredMasteryText"
                            :items="masteryOptions"
                            v-model="dialogs.edit.form.required_mastery">
                        </v-select>
                    </div>
                    <!-- Description -->
                    <div class="form-field">
                        <v-textarea
                            :label="formDescriptionText"
                            v-model="dialogs.edit.form.description">
                        </v-textarea>
                    </div>
                </div>
                <div class="dialog-controls">
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.edit.show = false">
                            <i class="fas fa-arrow-left"></i>
                            {{ editCancelText }}
                        </v-btn>
                    </div>
                    <div class="dialog-controls__right">
                        <v-btn 
                            depressed 
                            color="success"
                            @click="onClickConfirmEdit" 
                            :dark="!confirmEditDisabled"
                            :disabled="confirmEditDisabled">
                            <i class="far fa-save"></i>
                            {{ editSubmitText }}
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Delete required skill dialog -->
        <v-dialog v-model="dialogs.delete.show" width="500">
            <div class="dialog">
                <div class="dialog__close-button" @click="dialogs.delete.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">{{ deleteTitleText }}</h3>
                    <!-- Text -->
                    <div class="dialog-text">{{ deleteText }}</div>
                </div>
                <div class="dialog-controls">
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.delete.show = false">
                            <i class="fas fa-arrow-left"></i>
                            {{ deleteCancelText }}
                        </v-btn>
                    </div>
                    <div class="dialog-controls__right">
                        <v-btn 
                            depressed dark color="red"
                            @click="onClickConfirmDelete">
                            <i class="fas fa-trash-alt"></i>
                            {{ deleteSubmitText }}
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

        <!-- Hidden input -->
        <input type="hidden" :name="name" :value="encodedSkills">

    </div>
</template>

<script>
    export default {
        props: [
            "name",
            "value",
            "task",
            "skills",
            "oldInput",
            "labelText",
            "noRecordsText",
            "addButtonText",
            "viewTitleText",
            "viewSkillText",
            "viewRequiredMasteryText",
            "viewDescriptionText",
            "addTitleText",
            "formSkillText",
            "formRequiredMasteryText",
            "formDescriptionText",
            "addCancelText",
            "addSubmitText",
            "editTitleText",
            "editCancelText",
            "editSubmitText",
            "deleteTitleText",
            "deleteText",
            "deleteCancelText",
            "deleteSubmitText",
        ],
        data: () => ({
            tag: "[required-skills-field]",
            masteryOptions: [],
            skillOptions: [],
            mutableSkills: [],
            dialogs: {
                view: {
                    show: false,
                    index: null,
                },
                add: {
                    show: false,
                    loading: false,
                    errors: [],
                    form: {
                        skill: "",
                        required_mastery: 1,
                        description: "",
                    }
                },
                edit: {
                    show: false,
                    loading: false,
                    errors: [],
                    form: {
                        skill: "",
                        required_mastery: 1,
                        description: "",
                    }
                },
                delete: {
                    show: false,
                    index: null,
                }
            }
        }),
        computed: {
            confirmAddDisabled() {
                return this.dialogs.add.form.skill === "";
            },
            confirmEditDisabled() {
                return this.dialogs.edit.form.skill === "";
            },
            encodedSkills() {
                return JSON.stringify(this.mutableSkills);
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" name: ", this.name);
                console.log(this.tag+" value: ", this.value);
                console.log(this.tag+" user: ", this.task);
                console.log(this.tag+" skills: ", this.skills);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" label text: ", this.labelText);
                console.log(this.tag+" no records text: ", this.noRecordsText);
                console.log(this.tag+" create text: ", this.createText);
                this.initializeData();
                this.generateSkillOptions();
                this.generateMasteryOptions();
            },
            initializeData() {
                if (this.task !== undefined && this.task !== null && this.task.skills !== undefined && this.task.skills !== null && this.task.skills.length > 0) {
                    for (let i = 0; i < this.task.skills.length; i++) {
                        this.mutableSkills.push({
                            skill: this.task.skills[i].name,
                            description: this.task.skills[i].pivot.description,
                            required_mastery: this.task.skills[i].pivot.required_mastery,
                        });
                    }
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    
                }
            },
            generateMasteryOptions() {
                for (let i = 1; i <= 10; i++) {
                    this.masteryOptions.push({
                        text: i+"/10",
                        value: i,
                    });
                }
            },
            generateSkillOptions() {
                if (this.skills !== undefined && this.skills !== null && this.skills.length > 0) {
                    for (let i = 0; i < this.skills.length; i++) {
                        this.skillOptions.push(this.skills[i].name);
                    }
                }
            },
            onClickAdd() {
                this.dialogs.add.show = true;
            },
            onClickConfirmAdd() {
                this.mutableSkills.push({
                    skill: this.dialogs.add.form.skill,
                    description: this.dialogs.add.form.description,
                    required_mastery: this.dialogs.add.form.required_mastery,
                });
                this.dialogs.add.show = false;
            },
            onClickView(index) {
                this.dialogs.view.index = index;
                this.dialogs.view.show = true;
            },
            onClickEdit(index) {
                if (this.dialogs.view.show) this.dialogs.view.show = false;
                this.dialogs.edit.index = index;
                this.dialogs.edit.form.skill = this.mutableSkills[index].skill;
                this.dialogs.edit.form.description = this.mutableSkills[index].description;
                this.dialogs.edit.form.required_mastery = this.mutableSkills[index].required_mastery; 
                this.dialogs.edit.show = true;
            },
            onClickConfirmEdit() {
                this.mutableSkills[this.dialogs.edit.index].skill = this.dialogs.edit.form.skill;
                this.mutableSkills[this.dialogs.edit.index].description = this.dialogs.edit.form.description;
                this.mutableSkills[this.dialogs.edit.index].required_mastery = this.dialogs.edit.form.required_mastery;
                this.dialogs.edit.show = false;
            },
            onClickDelete(index) {
                if (this.dialogs.view.show) this.dialogs.view.show = false;
                this.dialogs.delete.index = index;
                this.dialogs.delete.show = true;
            },
            onClickConfirmDelete() {
                this.mutableSkills.splice(this.dialogs.delete.index, 1);
                this.dialogs.delete.show = false;
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #required-skills-field {
        #required-skills-field__label {
            font-size: .85em;
            margin: 0 0 10px 0;
            color: hsl(0, 0%, 45%);
        }
        #required-skills-field__skills {
            margin: 0 0 15px 0;
            background-color: hsl(0, 0%, 95%);
            .required-skills-field__skill {
                display: flex;
                padding: 10px;
                flex-direction: row;
                box-sizing: border-box;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                &:last-child {
                    border-bottom: 0;
                }
                .skill-name {
                    flex: 1;
                    display: flex;
                    padding: 0 0 0 10px;
                    flex-direction: row;
                    align-items: center;
                }
                .skill-required-mastery {
                    flex: 1;
                    display: flex;
                    padding: 0 0 0 10px;
                    flex-direction: row;
                    align-items: center;
                }
                .skill-actions {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    .skill-action {
                        width: 26px;
                        height: 26px;
                        display: flex;
                        font-size: .8em;
                        cursor: pointer;
                        color: #ffffff;
                        border-radius: 3px;
                        margin: 0 0 0 10px;
                        flex-direction: row;
                        align-items: center;
                        justify-content: center;
                        background-color: #333333;
                        &:first-child {
                            margin: 0;
                        }
                        &.view {
                            background-color: #0088ff;
                            &:hover {
                                background-color: #0072d6;
                            }
                        }
                        &.edit {
                            background-color: #f35900;
                            &:hover {
                                background-color: #e25300;
                            }
                        }
                        &.delete {
                            background-color: #b70000;
                            &:hover {
                                background-color: #990000;
                            }
                        }
                    }
                }
            }
        }
        #required-skills-field__no-records {
            padding: 10px 15px;
            margin: 0 0 15px 0;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: hsl(0, 0%, 95%);
        }
        #required-skills-field__actions {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-end;
        }
    }
</style>