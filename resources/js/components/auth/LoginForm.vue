<template>
    <div id="login-form">
        
        <!-- Email --> 
        <div class="form-field">
            <v-text-field 
                label="E-mail" 
                name="email" 
                v-model="form.email" 
                :error="hasErrors('email')" 
                :error-messages="getErrors('email')">
            </v-text-field>
        </div>
        
        <!-- Password -->
        <div class="form-field">
            <v-text-field 
                type="password" 
                label="Password" 
                name="password" 
                v-model="form.password" 
                :error="hasErrors('password')" 
                :error-messages="getErrors('password')">
            </v-text-field>
        </div>
        
        <div class="form-field">
            <remember-me v-model="form.rememberMe" name="remember_me"></remember-me>
        </div>
        
        <!-- Controls -->
        <div class="form-controls">
            <!-- Remember me -->
            <div class="form-controls__left">
                <v-btn type="submit" color="primary">Inloggen</v-btn>
            </div>
            <!-- Submit form -->
            <div class="form-controls__right">
                <a href="#">
                    Wachtwoord vergeten?
                </a>
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
            },
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
        },
    }
</script>

<style lang="scss">
    #login-form {
        // width: 600px;
        // padding: 25px;
        // margin: 0 auto;
        // border-radius: 3px;
        // box-sizing: border-box;
        // background-color: #ffffff;
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
