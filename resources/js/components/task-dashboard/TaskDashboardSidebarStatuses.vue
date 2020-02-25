<template>
    <div id="task-dashboard-sidebar-statuses" class="task-overview__sidebar-panel elevation-1">
        <div class="sidebar-panel__header">{{ title }}</div>
        <div class="sidebar-panel__content">
            <div id="statuses" v-if="mutableStatuses.length > 0">
                <div class="status-wrapper" v-for="(status, si) in mutableStatuses" :key="si">
                    <div class="status">
                        <v-checkbox
                            v-model="mutableStatuses[si].selected"
                            :value="status.id"
                            :label="status.label"
                            class="mt-0" hide-details
                            @change="onCheckboxValueChanged(si)">
                        </v-checkbox>
                    </div>
                </div>
            </div>
            <div id="no-categories" v-if="mutableStatuses.length === 0">
                {{ noRecordsText }}
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../../event-bus.js';
    export default {
        props: [
            "statuses",
            "title",
            "noRecordsText",
        ],
        data: () => ({
            tag: "[task-dashboard-sidebar-statuses]",
            mutableStatuses: [],
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" statuses: ", this.statuses);
                console.log(this.tag+" title: ", this.title);
                console.log(this.tag+" no records text: ", this.noRecordsText);
                this.initializeData();
            },
            initializeData() {
                if (this.statuses !== undefined && this.statuses !== null && this.statuses.length > 0) {
                    for (let i = 0; i < this.statuses.length; i++) {
                        let status = this.statuses[i];
                        status.selected = false;
                        this.mutableStatuses.push(status);
                    }
                }
            },
            onCheckboxValueChanged(index) {
                console.log(this.tag+" checkbox value changed for: ", index);
                let selected = [];
                for (let i = 0; i < this.mutableStatuses.length; i++) {
                    if (this.mutableStatuses[i].selected) {
                        selected.push(this.mutableStatuses[i].id);
                    }
                }
                EventBus.$emit("task-dashboard__selected-statuses", selected);
            }
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #task-dashboard-sidebar-statuses {

    }
</style>