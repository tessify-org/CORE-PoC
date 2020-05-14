<template>
    <div id="project-team-member-overview">

        <!-- Header -->
        <div id="project-team-member-overview__header">
            <div id="project-team-member-overview__header-left">
                <h1 id="project-title">{{ strings.title }}</h1>
            </div>
            <div id="project-team-member-overview__header-right">
                
            </div>
        </div>

        <!-- Team members -->
        <div id="project-team-member-overview__team-members" v-if="mutableMembers.length > 0">
            <div class="team-member" v-for="(member, mi) in mutableMembers" :key="mi" @click="onClickMember(mi)">
                <div class="team-member__avatar" :style="{ backgroundImage: 'url('+member.user.avatar_url+')' }"></div>
                <div class="team-member__text">
                    <div class="team-member__name">{{ member.user.formatted_name }}</div>
                    <div class="team-member__roles">
                        <div class="role-wrapper" v-for="(role, ri) in member.team_roles" :key="ri">
                            <div class="role">
                                {{ role.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- No team members -->
        <div id="project-team-member-overview__no-team-members" v-if="mutableMembers.length === 0">
            {{ strings.no_members }}
        </div>

        <!-- View team member dialog -->
        <v-dialog v-model="dialogs.view.show" width="500">
            <div class="dialog" v-if="dialogs.view.index !== null && mutableMembers[dialogs.view.index] !== undefined">
                <!-- Close button -->
                <div class="dialog__close-button" @click="dialogs.view.show = false">
                    <i class="fas fa-times"></i>
                </div>
                <!-- Content -->
                <div class="dialog-content">
                    <!-- Title -->
                    <h3 class="dialog-title">{{ strings.view_dialog_title }}</h3>
                    <!-- Details -->
                    <div class="details bordered compact mb-0">
                        <div class="detail">
                            <div class="key">{{ strings.view_dialog_user }}</div>
                            <div class="val">
                                <a :href="mutableMembers[dialogs.view.index].user.profile_href">
                                    {{ mutableMembers[dialogs.view.index].user.formatted_name }}
                                </a>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">{{ strings.view_dialog_roles }}</div>
                            <div class="val">
                                <div class="tags">
                                    <div class="tag-wrapper" v-for="(role, ri) in mutableMembers[dialogs.view.index].team_roles" :key="ri">
                                        {{ role.name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">{{ strings.view_dialog_joined_on }}</div>
                            <div class="val">{{ mutableMembers[dialogs.view.index].created_at }}</div>
                        </div>
                    </div>
                </div>
                <!-- Controls
                <div class="dialog-controls">

                </div>
                -->
            </div>
        </v-dialog>

    </div>
</template>

<script>
    export default {
        props: [
            "project",
            "members",
            "strings",
        ],
        data: () => ({
            tag: "[project-team-member-overview]",
            mutableMembers: [],
            dialogs: {
                view: {
                    show: false,
                    index: null,
                },
            }
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" project: ", this.project);
                console.log(this.tag+" members: ", this.members);
                console.log(this.tag+" strings: ", this.strings);
                this.initializeData();
            },
            initializeData() {
                if (this.members !== undefined && this.members !== null && this.members.length > 0) {
                    for (let i = 0; i < this.members.length; i++) {
                        this.mutableMembers.push(this.members[i]);
                    }
                }
            },
            onClickMember(index) {
                this.dialogs.view.index = index;
                this.dialogs.view.show = true;
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #project-team-member-overview {
        #project-team-member-overview__header {
            display: flex;
            margin: 0 0 30px 0;
            flex-direction: row;
            #project-team-member-overview__header-left {
                flex: 1;
                display: flex;
                flex-direction: row;
                align-items: center;
                #project-title {
                    margin: 0 !important;
                }
            }   
            #project-team-member-overview__header-left {
                display: flex;
                flex-direction: row;
                align-items: center;
            }
        }
        #project-team-member-overview__team-members {
            border: 1px solid rgba(0, 0, 0, 0.1);
            .team-member {
                display: flex;
                padding: 15px;
                overflow: hidden;
                border-radius: 3px;
                flex-direction: row;
                align-items: center;
                box-sizing: border-box;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                &:last-child {
                    border-bottom: 0;
                }
                &:hover {
                    cursor: pointer;
                    background-color: hsl(0, 0%, 98%);
                }
                .team-member__avatar {
                    height: 40px;
                    flex: 0 0 40px;
                    border-radius: 3px;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center center;
                }
                .team-member__text {
                    flex: 1;
                    margin: 0 0 0 15px;
                    .team-member__name {
                        font-size: 1.1em;
                        margin: 0 0 3px 0;
                    }
                    .team-member__roles {
                        display: flex;
                        flex-direction: row;
                        margin: 0 -10px -10px -10px;
                        .role-wrapper {
                            box-sizing: border-box;
                            padding: 0 10px 10px 10px;
                            .role {
                                color: #fff;
                                padding: 0 5px;
                                font-size: .8em;
                                border-radius: 2px;
                                box-sizing: border-box;
                                background-color: #111;
                            }
                        }
                    }
                }
            }
        }
        #project-team-member-overview__no-team-members {

        }
    }
</style>