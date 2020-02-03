<template>
    <div id="job-view">

        <!-- Project title -->
        <h1 id="job-title">{{ job.title }}</h1>

        <!-- Project slogan -->
        <h2 id="job-slogan">{{ job.slogan }}</h2>

        <!-- Project status -->
        <div id="job-stats">
            <!-- Status -->
            <div id="job-status" class="elevation-1" :class="job.status.name">
                <div id="job-status__label">Status</div>
                <div id="job-status__value">{{ job.status.label }}</div>
            </div>
        </div>
        
        <!-- Project content -->
        <v-tabs v-model="currentTab" id="job-tabs" class="elevation-1">
            <!-- Tabs -->
            <v-tab>Algemene informatie</v-tab>
            <v-tab>Het Team</v-tab>
            <v-tab>Taken</v-tab>
            <v-tab>Geschiedenis</v-tab>
            <!-- General info tab -->
            <v-tab-item>
                <div class="tab-content">
                
                    <div id="job-info">
                        <div id="job-info__left">
                            
                            <!-- Probleemstelling -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Probleem dat wordt opgelost</h3>
                                <div class="job-paragraph__text">{{ job.problem }}</div>
                            </div>
        
                            <!-- Projectomschrijving -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Projectomschrijving</h3>
                                <div class="job-paragraph__text">{{ job.description }}</div>
                            </div>

                            <!-- Comments -->
                            <comments
                                :user="user"
                                :comments="comments"
                                per-page="3"
                                target-type="job"
                                :target-id="job.id"
                                :create-comment-api-endpoint="createCommentApiEndpoint"
                                :update-comment-api-endpoint="updateCommentApiEndpoint"
                                :delete-comment-api-endpoint="deleteCommentApiEndpoint">
                            </comments>

                        </div>
                        <div id="job-info__right">

                            <!-- Details -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Details</h3>
                                <div id="job-details">
                                    <!-- ID -->
                                    <div class="detail">
                                        <div class="key">ID</div>
                                        <div class="val">{{ job.id }}</div>
                                    </div>
                                    <!-- Category -->
                                    <div class="detail">
                                        <div class="key">Categorie</div>
                                        <div class="val">{{ job.category.label }}</div>
                                    </div>
                                    <!-- Work method -->
                                    <div class="detail">
                                        <div class="key">Werkmethode</div>
                                        <div class="val">{{ job.work_method.label }}</div>
                                    </div>
                                    <!-- Starts at -->
                                    <div class="detail">
                                        <div class="key">Start op</div>
                                        <div class="val">
                                            <span class="italic" v-if="job.formatted_starts_at === null">Nader te bepalen</span>
                                            <span v-if="job.formatted_starts_at !== null">{{ job.formatted_starts_at }}</span>
                                        </div>
                                    </div>
                                    <!-- Ends at -->
                                    <div class="detail">
                                        <div class="key">Stopt op</div>
                                        <div class="val">
                                            <span class="italic" v-if="job.formatted_ends_at === null">Nader te bepalen</span>
                                            <span v-if="job.formatted_ends_at !== null">{{ job.formatted_ends_at }}</span>
                                        </div>
                                    </div>
                                    <!-- Created by -->
                                    <div class="detail">
                                        <div class="key">Toegevoegd door</div>
                                        <div class="val">
                                            <a :href="job.author.profile_href">{{ job.author.formatted_name }}</a>
                                        </div>
                                    </div>
                                    <!-- Created at -->
                                    <div class="detail">
                                        <div class="key">Toegevoegd op</div>
                                        <div class="val">{{ job.formatted_created_at }}</div>
                                    </div>
                                    <!-- Updated at -->
                                    <div class="detail">
                                        <div class="key">Laatste gewijzigd op</div>
                                        <div class="val">{{ job.formatted_updated_at }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Author of the job -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Project gestart door</h3>
                                <div id="job-author">
                                    <user-pill :user="job.author" dark></user-pill>
                                </div>
                            </div>

                            <!-- Team roles -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Teamleden & rollen</h3>
                                <div id="job-team-roles">
                                    <div id="job-team-roles__list" v-if="job.team_roles.length > 0">
                                        <div class="team-role" v-for="(role, ri) in job.team_roles" :key="ri">
                                            <div class="team-role__avatar-wrapper">
                                                <div class="team-role__avatar"></div>
                                            </div>
                                            <div class="team-role__text-wrapper">
                                                <div class="role-name">{{ role.name }}</div>
                                                <div class="member-name" v-if="role.team_member">
                                                    {{ role.team_member.formattedName }}
                                                </div>
                                                <div class="not-fulfilled" v-if="!role.team_member">
                                                    Nog niemand aangesteld
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="job-team-roles__empty" v-if="job.team_roles.length === 0">
                                        Er zijn nog geen rollen gedefinieert
                                    </div>
                                    <div id="job-team-roles__actions">
                                        <v-btn small depressed color="primary" @click="onClickViewTeam">
                                            Bekijk details
                                        </v-btn>
                                    </div>
                                </div>
                            </div>

                            <!-- Resources -->
                            <div class="job-paragraph">
                                <h3 class="job-paragraph__title">Resources</h3>
                                <div id="job-resources">
                                    <div id="job-resources__list" v-if="job.resources.length > 0">
                                        <div class="resource" v-for="(resource, ri) in job.resources" :key="ri">
                                            <div class="resource-icon">
                                                <i class="far fa-file"></i>
                                            </div>
                                            <div class="resource-title">{{ resource.title }}</div>
                                            <div class="resource-size">{{ resource.file_size }} kb</div>
                                        </div>
                                    </div>
                                    <div id="job-resources__empty" v-if="job.resources.length === 0">
                                        Er zijn nog geen resources toegevoegd.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </v-tab-item>
            <!-- The team tab -->
            <v-tab-item>
                <div class="tab-content">
                    
                    <h3 class="content-subtitle">Team rollen</h3>
                    
                    <div class="content-desc">
                        Alle rollen die vervult dienen te worden om dit project tot een succes te maken.
                    </div>
                    
                    <div id="team">
                        <div id="team-roles" v-if="job.team_roles.length > 0">
                            <div class="team-role" v-for="(role, ri) in job.team_roles" :key="ri">
                                <div class="team-role__avatar-wrapper">
                                    <div class="team-role__avatar"></div>
                                </div>
                                <div class="team-role__text-wrapper">
                                    <div class="role-name">{{ role.name }}</div>
                                    <div class="role-skills__wrapper" v-if="role.skills.length > 0"> 
                                        <div class="role-skills__label">Vereiste skills</div>
                                        <div class="role-skills">
                                            <div class="role-skill" v-for="(skill, si) in role.skills" :key="si">
                                                {{ skill.name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="team-role__member" v-if="role.team_member">
                                    <div class="team-role__member-label">Vervuld door:</div>
                                    <user-pill :user="role.team_member.user"></user-pill>
                                </div>
                                <div class="team-role__actions" v-if="!role.team_member">
                                    <v-btn color="primary" large depressed @click="onClickApplyForRole(ri)">
                                        Meld je aan!
                                    </v-btn>
                                </div>
                            </div>
                        </div>
                        <div id="no-team-roles" v-if="job.team_roles.length === 0">
                            Er zijn nog geen rollen gedefineert.
                        </div>
                    </div>
                    
                    <h3 class="content-subtitle">Aanmeldingen</h3>



                </div>
            </v-tab-item>
            <!-- Tasks tab -->
            <v-tab-item>
                <div class="tab-content">
                
                </div>
            </v-tab-item>
            <!-- History tab -->
            <v-tab-item>
                <div class="tab-content">
                
                </div>
            </v-tab-item>
        </v-tabs>


        <!-- Apply for team member position dialog -->
        <v-dialog v-model="dialogs.apply.show" width="500">
            <div class="dialog">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.apply.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">Aanmelden als {{ getApplicationJobTitle() }}</h3>
                    <!-- Errors -->
                    <div class="dialog-errors" v-if="dialogs.apply.errors.length > 0">
                        <div class="dialog-error" v-for="(error, ei) in dialogs.apply.errors" :key="ei">
                            {{ error }}
                        </div>
                    </div>
                    <!-- Motivation -->
                    <div class="form-field">
                        <v-textarea 
                            label="Motivatie" 
                            placeholder="Waarom zou je deze rol willen vervullen?"
                            :loading="dialogs.apply.loading"
                            v-model="dialogs.apply.form.motivation">
                        </v-textarea>
                    </div>
                </div>
                <!-- Controls -->
                <div class="dialog-controls">
                    <!-- Cancel -->
                    <div class="dialog-controls__left">
                        <v-btn text @click="dialogs.apply.show = false">
                            <i class="fas fa-arrow-left"></i>
                            Annuleren
                        </v-btn>
                    </div>
                    <!-- Confirm delete -->
                    <div class="dialog-controls__right">
                        <v-btn depressed color="success" dark 
                            @click="onClickConfirmApply" 
                            :loading="dialogs.apply.loading" 
                            :disabled="submitApplicationDisabled">
                            <i class="far fa-save"></i>
                            Opslaan
                        </v-btn>
                    </div>
                </div>
            </div>
        </v-dialog>

    </div>
</template>

<script>
    export default {
        props: [
            "job",
            "user",
            "comments",
            "createCommentApiEndpoint",
            "updateCommentApiEndpoint",
            "deleteCommentApiEndpoint",
            "createTeamMemberApplicationApiEndpoint",
            "updateTeamMemberApplicationApiEndpoint",
            "deleteTeamMemberApplicationApiEndpoint",
        ],
        data: () => ({
            tag: "[job-view]",
            currentTab: 1,
            mutableApplications: [],
            dialogs: {
                apply: {
                    show: false,
                    index: null,
                    errors: [],
                    loading: false,
                    form: {
                        motivation: "",
                    }
                }
            }
        }),
        computed: {
            submitApplicationDisabled() {
                return false;
            },
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" job: ", this.job);
                console.log(this.tag+" user: ", this.user);
                console.log(this.tag+" comments: ", this.comments);
                console.log(this.tag+" create comment api endpoint: ", this.createCommentApiEndpoint);
                console.log(this.tag+" update comment api endpoint: ", this.updateCommentApiEndpoint);
                console.log(this.tag+" delete comment api endpoint: ", this.deleteCommentApiEndpoint);
                console.log(this.tag+" create team member application api endpoint: ", this.createTeamMemberApplicationApiEndpoint);
                console.log(this.tag+" update team member application api endpoint: ", this.updateTeamMemberApplicationApiEndpoint);
                console.log(this.tag+" delete team member application api endpoint: ", this.deleteTeamMemberApplicationApiEndpoint);
                // console.log(this.tag+" ");
                this.initializeData();
            },
            initializeData() {
                if (this.job !== undefined && this.job !== null && this.job.team_member_applications !== undefined && this.job.team_member_applications !== null && this.job.team_member_applications.length > 0) {
                    for (let i = 0; i < this.job.team_member_applications.length; i++) {
                        
                    }
                }
            },
            onClickViewTeam() {
                this.currentTab = 1;
            },
            onClickApplyForRole(index) {
                console.log(this.tag+" clicked apply for role button", index);
                this.dialogs.apply.index = index;
                this.dialogs.apply.show = true;
            },
            onClickConfirmApply() {
                this.dialogs.apply.loading = true;
                this.dialogs.apply.errors = [];
                let payload = new FormData();
                payload.append("job_id", this.job.id);
                payload.append("team_role_id", this.job.team_roles[this.dialogs.apply.index].id);
                payload.append("motivation", this.dialogs.apply.form.motivation);
                this.axios.post(this.createTeamMemberApplicationApiEndpoint, payload)
                    .then(function(response) {
                        if (response.data.status === "success") {
                            
                            this.dialogs.apply.loading = false;
                            this.dialogs.apply.show = false;
                            this.dialogs.apply.form.description = "";
                        } else {
                            this.dialogs.apply.loading = false;
                            this.dialogs.apply.errors = [response.data.error];
                        }
                    }.bind(this))
                    .catch(function(error) {
                        this.dialogs.apply.loading = false;
                        this.dialogs.apply.errors = [error];
                    }.bind(this));
            },
            getApplicationJobTitle() {
                if (this.dialogs.apply.index !== null && this.job.team_roles[this.dialogs.apply.index] !== undefined) {
                    return this.job.team_roles[this.dialogs.apply.index].name;
                }
                return "..";
            }
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #job-view {
        #team {
            #team-roles {
                margin: 0 0 30px 0;
                .team-role {
                    display: flex;
                    padding: 30px;
                    border-radius: 3px;
                    margin: 0 0 30px 0;
                    flex-direction: row;
                    box-sizing: border-box;
                    background-color: hsl(0, 0%, 95%);
                    &:last-child {
                        margin: 0;
                    }
                    .team-role__avatar-wrapper {
                        flex: 0 0 120px;
                        margin: 0 30px 0 0;
                        .team-role__avatar {
                            width: 120px;
                            height: 120px;
                            border-radius: 60px;
                            background-color: hsl(0, 0%, 100%);
                        }
                    }
                    .team-role__text-wrapper {
                        flex: 1;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        .role-name {
                            font-size: 2em;
                            font-weight: 500;
                            margin: 0 0 5px 0;
                        }
                        .role-skills__wrapper {
                            .role-skills__label {
                                font-size: .8em;
                                margin: 0 0 5px 0;
                                color: hsl(0, 0%, 0%);
                            }
                            .role-skills {
                                display: flex;
                                flex-direction: row;
                                .role-skill {
                                    font-size: .8em;
                                    margin: 0 5px 0 0;
                                    border-radius: 2px;
                                    box-sizing: border-box;
                                    padding: 3px 3px 3px 5px;
                                    background-color: hsl(0, 0%, 100%);
                                }
                            }
                            .role-member {
                                
                            }
                        }
                    }
                    .team-role__member {
                        display: flex;
                        flex: 0 0 300px;
                        flex-direction: column;
                        justify-content: center;
                        .team-role__member-label {
                            font-size: .8em;
                            margin: 0 0 5px 0;
                        }
                    }
                    .team-role__actions {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                    }
                }
            }
        }
    }
</style>