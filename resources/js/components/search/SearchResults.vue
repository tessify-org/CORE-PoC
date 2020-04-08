<template>
    <div id="search-results__wrapper">

        <!-- Controls -->
        <div id="search-controls">
            <div id="search-controls__input">
                <v-text-field
                    solo hide-details
                    :placeholder="searchPlaceholderText"
                    v-model="form.query">
                </v-text-field>
            </div>
        </div>

        <!-- Results -->
        <div id="search-results" class="elevation-1">
            <div class="search-result" v-for="(result, ri) in paginatedResults" :key="ri">
                <div class="search-result__title">{{ result.title }}</div>
            </div>
        </div>

        <!-- No results -->
        <div id="no-results" class="elevation-1" v-if="paginatedResults.length === 0 && searched">
            {{ noResultsText }}
        </div>
        <div id="no-results" class="elevation-1" v-if="paginatedResults.length === 0 && !searched">
            {{ enterQueryText }}
        </div>
        
        <!-- Pagination -->
        <div id="pagination" v-if="numPaginatedPages > 1">
            <v-pagination
                v-model="pagination.currentPage"
                :length="numPaginatedPages"
                total-visible="10">
            </v-pagination>
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            "results",
            "apiEndpoint",
            "searchPlaceholderText",
            "noResultsText",
            "enterQueryText",
        ],
        data: () => ({
            tag: "[search-results]",
            mutableResults: [],
            filters: {

            },
            filteredResults: [],
            pagination: {
                perPage: 10,
                currentPage: 1,
            },
            paginatedResults: [],
            form: {
                query: "",
            },
            searched: false,
        }),
        computed: {
            numPaginatedPages() {
                return Math.ceil(this.filteredResults.length/this.pagination.perPage);
            },
        },
        watch: {
            "filters": {
                deep: true,
                handler: function() {
                    this.filter();
                }
            },
            "pagination.currentPage": function() {
                this.paginate();
            },
            "form.query": _.debounce(function() {
                if (!this.searched) this.searched = true;
                this.search();
            }, 250),
        },
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" results: ", this.results);
                // console.log(this.tag+" ");
                this.initializeData();
            },
            initializeData() {
                if (this.results !== undefined && this.results !== null && this.results.length > 0) {
                    for (let i = 0; i < this.results.length; i++){
                        this.mutableResults.push(this.results[i]);
                    }
                }
                this.filter();
            },
            filter() {
                this.filteredResults = [];
                for (let i = 0; i < this.mutableResults.length; i++) {
                    -
                    this.filteredResults.push(this.mutableResults[i]);
                }
                this.paginate();
            },
            paginate() {
                let start_slicing_at = (this.pagination.currentPage - 1) * this.pagination.perPage;
                let stop_slicing_at = start_slicing_at + this.pagination.perPage;
                this.paginatedResults = this.filteredResults.slice(start_slicing_at, stop_slicing_at);
                if (this.pagination.currentPage > this.numPaginationPages) this.pagination.currentPage = 1;
            },
            search() {
                if (this.form.query !== "") {
                    
                    let payload = new FormData();
                    payload.append("search_query", this.form.query);

                    this.axios.post(this.apiEndpoint, payload)
                        .then(function(response) {
                            console.log(this.tag+" response: ", response.data);
                            this.mutableResults = response.data.results;
                            this.filter();
                        }.bind(this))
                        .catch(function(error) {
                            console.warn(this.tag+" search request failed: ", error);
                        }.bind(this));

                }
            }
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #search-results__wrapper {
        #search-controls {
            margin: 0 0 30px 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            #search-controls__input {
                flex: 0 0 500px;
            }
        }
        #search-results {
            border-radius: 3px;
            background-color: #fff;
            .search-result {
                display: flex;
                padding: 15px 20px;
                flex-direction: row;
                box-sizing: border-box;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                &:last-child {
                    border-bottom: 0;
                }
            }
        }
        #no-results {
            padding: 25px;
            text-align: center;
            box-sizing: border-box;
            background-color: #fff;
        }
        #pagination {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
    }
</style>