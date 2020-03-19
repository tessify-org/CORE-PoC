<template>
    <div id="task-dashboard-sidebar-duration" class="task-overview__sidebar-panel elevation-1">
        <div class="sidebar-panel__header">
            Tijdsbestek
        </div>
        <div class="sidebar-panel__content">
            <v-range-slider
                :min="1"
                max="40"
                hide-details
                v-model="range"
                class="align-center">
                <template v-slot:prepend>
                    <v-text-field
                        v-model="range[0]"
                        class="mt-0 pt-0"
                        hide-details
                        single-line
                        type="number"
                        style="width: 60px">
                    </v-text-field>
                </template>
                <template v-slot:append>
                    <v-text-field
                        v-model="range[1]"
                        class="mt-0 pt-0"
                        hide-details
                        single-line
                        type="number"
                        style="width: 60px">
                    </v-text-field>
                </template>
            </v-range-slider>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../../../event-bus.js';
    export default {
        data: () => ({
            tag: "[task-dashboard-sidebar-duration]",
            range: [0, 40]
        }),
        watch: {
            range: {
                deep: true,
                handler: function() {
                    EventBus.$emit("task-dashboard__duration-range", this.range);
                }
            }
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                // console.log(this.tag+" ");
            }
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #task-dashboard-sidebar-duration {

    }
</style>