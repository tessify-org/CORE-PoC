<template>
    <div id="project-dashboard-sidebar-categories" class="project-overview__sidebar-panel elevation-1">
        <div class="sidebar-panel__header">{{ title }}</div>
        <div class="sidebar-panel__content">
            <div id="categories" v-if="mutableCategories.length > 0">
                <div class="category-wrapper" v-for="(category, ci) in mutableCategories" :key="ci">
                    <div class="category">
                        <v-checkbox
                            v-model="mutableCategories[ci].selected"
                            :value="category.id"
                            :label="category.label"
                            class="mt-0" hide-details
                            @change="onCheckboxValueChanged(ci)">
                        </v-checkbox>
                    </div>
                </div>
            </div>
            <div id="no-categories" v-if="mutableCategories.length === 0">
                {{ noRecordsText }}
            </div>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../../event-bus.js';
    export default {
        props: [
            "categories",
            "title",
            "noRecordsText",
        ],
        data: () => ({
            tag: "[project-dashboard-sidebar-categories]",
            mutableCategories: [],
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" categories: ", this.categories);
                console.log(this.tag+" title: ", this.title);
                console.log(this.tag+" no records text: ", this.noRecordsText);
                this.initializeData();
            },
            initializeData() {
                if (this.categories !== undefined && this.categories !== null && this.categories.length > 0) {
                    for (let i = 0; i < this.categories.length; i++) {
                        let category = this.categories[i];
                        category.selected = false;
                        this.mutableCategories.push(category);
                    }
                }
            },
            onCheckboxValueChanged(index) {
                console.log(this.tag+" checkbox value changed for: ", index);
                let selected = [];
                for (let i = 0; i < this.mutableCategories.length; i++) {
                    if (this.mutableCategories[i].selected) {
                        selected.push(this.mutableCategories[i].id);
                    }
                }
                EventBus.$emit("project-dashboard__selected-categories", selected);
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #task-dashboard-sidebar-categories {

    }
</style>