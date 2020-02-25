<template>
    <div id="task-dashboard-overview">

        <div id="tasks" v-if="paginatedTasks.length > 0">
            <div class="task-wrapper" v-for="(task, ti) in paginatedTasks" :key="ti">
                <div class="task elevation-1">
                    {{ task.title }}
                </div>
            </div>
        </div>

        <div id="no-records" class="elevation-1" v-if="paginatedTasks.length === 0">
            No tasks found
        </div>

        <div id="pagination-wrapper" v-if="numPaginatedPages > 1">
            <v-pagination
                v-model="pagination.currentPage"
                :length="numPaginatedPages"
                total-visible="10">
            </v-pagination>
        </div>

    </div>
</template>

<script>
    import { EventBus } from './../../event-bus.js';
    export default {
        props: [
            "tasks",
        ],
        data: () => ({
            tag: "[task-dashboard-overview]",
            mutableTasks: [],
            filteredTasks: [],
            paginatedTasks: [],
            filters: {
                search_query: "",
                selected_categories: [],
                selected_seniorities: [],
                time_range: {
                    min: 0,
                    max: 40
                }
            },
            pagination: {
                perPage: 12,
                currentPage: 1,
            }
        }),
        computed: {
            numPaginatedPages() {
                return Math.ceil(this.filteredTasks.length/this.pagination.perPage);
            },
        },
        watch: {
            "pagination.currentPage": function() {
                this.paginateTasks();
            },
            "filters": {
                deep: true,
                handler: function() {
                    this.filterTasks();
                }
            }
        },
        methods: {
            initialize() {
                
                console.log(this.tag+" initializing");
                console.log(this.tag+" tasks: ", this.tasks);
                console.log(this.tag+" statuses: ", this.statuses);
                console.log(this.tag+" categories: ", this.categories);
                console.log(this.tag+" seniorities: ", this.seniorities);
                
                this.initializeData();
                this.startListening();

            },
            initializeData() {
                
                if (this.tasks !== undefined && this.tasks !== null && this.tasks.length > 0) {
                    for (let i = 0; i < this.tasks.length; i++) {
                        this.mutableTasks.push(this.tasks[i]);
                    }
                }
                
                this.filterTasks();

            },
            startListening() {
                
                EventBus.$on("task-dashboard__search-query", function(searchQuery) {
                    this.filters.search_query = searchQuery;
                }.bind(this));

                EventBus.$on("task-dashboard__selected-categories", function(selectedCategories) {
                    this.filters.selected_categories = selectedCategories;
                }.bind(this));

                EventBus.$on("task-dashboard__selected-seniorities", function(selectedSeniorities) {
                    this.filters.selected_seniorities = selectedSeniorities;
                }.bind(this));

            },
            filterTasks() {

                this.filteredTasks = [];

                if (this.mutableTasks.length > 0) {
                    for (let i = 0; i < this.mutableTasks.length; i++) {

                        let task = this.mutableTasks[i];

                        if (this.filters.search_query !== "") {
                            let in_title = task.title.toLowerCase().includes(this.filters.search_query);
                            let in_desc = task.description.toLowerCase().includes(this.filters.search_query);
                            if (!in_title && !in_desc) continue;
                        }

                        if (this.filters.selected_categories.length > 0) {
                            let matches = false;
                            for (let i = 0; i < this.filters.selected_categories.length; i++) {
                                if (task.task_category_id === this.filters.selected_categories[i]) {
                                    matches = true;
                                    break;
                                }
                            }
                            if (!matches) continue;
                        }

                        if (this.filters.selected_seniorities.length > 0) {
                            let matches = false;
                            for (let i = 0; i < this.filters.selected_seniorities.length; i++) {
                                if (task.task_seniority_id === this.filters.selected_seniorities[i]) {
                                    matches = true;
                                    break;
                                }
                            }
                            if (!matches) continue;
                        }

                        if (this.filters.time_range.min !== null && task.estimated_hours < this.filters.time_range.min) continue;
                        if (this.filters.time_range.max !== null && task.estimated_hours > this.filters.time_range.max) continue;

                        this.filteredTasks.push(task);

                    }
                }

                this.paginateTasks();

            },
            paginateTasks() {

                let start_slicing_at = (this.pagination.currentPage - 1) * this.pagination.perPage;
                let stop_slicing_at = start_slicing_at + this.pagination.perPage;
                
                this.paginatedTasks = this.filteredTasks.slice(start_slicing_at, stop_slicing_at);
                
                if (this.pagination.currentPage > this.numPaginationPages) this.pagination.currentPage = 1;
                
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #task-dashboard-overview {
        #tasks {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            .task-wrapper {
                flex: 0 0 50%;
                box-sizing: border-box;
                padding: 0 15px 30px 15px;
                .task {
                    padding: 15px;
                    border-radius: 3px;
                    background-color: #fff;
                }
            }
        }
        #no-records {
            padding: 15px;
            border-radius: 3px;
            margin: 0 0 30px 0;
            text-align: center;
            box-sizing: border-box;
            background-color: #ffffff;
        }
        #pagination-wrapper {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    }
</style>