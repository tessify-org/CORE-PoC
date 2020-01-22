<template>
    <div id="login-form">
        
        <!-- Email --> 
        <div class="field">
            <v-text-field 
                label="E-mail" 
                name="email" 
                v-model="form.email" 
                :error="hasErrors('email')" 
                :error-messages="getErrors('email')">
            </v-text-field>
        </div>
        
        <!-- Password -->
        <div class="field">
            <v-text-field 
                type="password" 
                label="Password" 
                name="password" 
                v-model="form.password" 
                :error="hasErrors('password')" 
                :error-messages="getErrors('password')">
            </v-text-field>
        </div>
        
        <!-- Controls -->
        <div id="login-form__controls">
            <!-- Remember me -->
            <div id="login-form__controls-left">
                <remember-me v-model="form.rememberMe" name="remember_me"></remember-me>
            </div>
            <!-- Submit form -->
            <div id="login-form__controls-right">
                <v-btn type="submit" color="primary">Login</v-btn>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            "oldInput",
            "errors",
            "prefillEmail",
        ],
        data: () => ({
            tag: "[login-form]",
            form: {
                email: "",
                password: "",
                rememberMe: true,
            }
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" old input: ", this.oldInput);
                console.log(this.tag+" errors: ", this.errors);
                console.log(this.tag+" prefill email: ", this.prefillEmail);
                this.initializeData();
            },
            initializeData() {
                if (this.prefillEmail !== undefined && this.prefillEmail !== null && this.prefillEmail !== "") {
                    this.form.email = this.prefillEmail;
                }
                if (this.oldInput !== undefined && this.oldInput !== null) {
                    if (this.oldInput.email !== null) this.form.email = this.oldInput.email;
                    if (this.oldInput.rememberMe !== null) this.form.rememberMe = this.oldInput.rememberMe ===  "true" ? true : false;
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
    #login-form {
        #login-form__controls {
            display: flex;
            margin: 15px 0 0 0;
            flex-direction: row;
            #login-form__controls-left, #login-form__controls-right {
                flex: 1;
                display: flex;
                flex-direction: row;
                align-items: center;
            }
            #login-form__controls-left {
                
            }
            #login-form__controls-right {
                justify-content: flex-end;
                .v-btn {
                    margin: 0 0 0 15px;
                }
            }
        }
    }
</style>
