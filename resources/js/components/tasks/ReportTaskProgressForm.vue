<template>
    <div id="report-task-progress-form">

        <!-- Form -->
        <div id="progress-form" class="elevation-1">

            <!-- Message -->
            <div class="form-field">
                <v-textarea
                    name="message"
                    :label="messageText"
                    v-model="form.message"
                    :placeholder="messagePlaceholderText"
                    :errors="hasErrors('message')"
                    :error-messages="getErrors('message')">
                </v-textarea>
            </div>

            <!-- Attachments -->
            <div class="file-field" :class="{ 'has-errors': hasErrors('attachment') }">
                <div class="file-field__label">{{ attachmentText }}</div>
                <div class="file-field__input">
                    <input type="file" name="attachment">
                </div>
                <div class="file-field__errors" v-if="hasErrors('attachment')">
                    <div class="file-field__error" v-for="(error, ei) in getErrors('attachment')" :key="ei">
                        {{ error }}
                    </div>
                </div>
            </div>

            <!-- Flag as completed -->
            <div class="form-field">
                <v-checkbox
                    :label="completedText"
                    v-model="form.completed"
                    :errors="hasErrors('completed')"
                    :error-messages="getErrors('completed')">
                </v-checkbox>
                <input type="hidden" name="completed" :value="form.completed">
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
            "report",
            "errors",
            "oldInput",
            "backHref",
            "backText",
            "submitText",
            "messageText", 
            "messagePlaceholderText",
            "attachmentText",
            "completedText",
        ],
        data: () => ({
            tag: "[report-task-progress-form]",
            form: {
                message: "",
                completed: false,
            }
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" report: ", this.report);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" back href: ", this.backHref);
                console.log(this.tag+" back text: ", this.backText);
                console.log(this.tag+" submit text: ", this.submitText);
                console.log(this.tag+" message text: ", this.messageText);
                console.log(this.tag+" message placeholder text: ", this.messagePlaceholderText);
                console.log(this.tag+" attachment text: ", this.attachmentText);
                console.log(this.tag+" completed text: ", this.completedText);
                // console.log(this.tag+" ");
                this.initializeData();
            },
            initializeData() {
                if (this.oldInput !== undefined && this.oldInput !== null) {

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
    #report-task-progress-form {
        #progress-form {
            padding: 25px;
            border-radius: 3px;
            box-sizing: border-box;
            background-color: #ffffff;
        }
    }
</style>