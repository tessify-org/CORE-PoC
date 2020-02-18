<template>
    <div id="project-resource-list">

        <div id="resources" v-if="mutableResources.length > 0">

        </div>

        <div id="no-resources" v-if="mutableResources.length === 0">
            {{ emptyText }}
        </div>

    </div>
</template>

<script>
    export default {
        props: [
            "resources",
            "emptyText",
        ],
        data: () => ({
            tag: "[project-resource-list]",
            mutableResources: [],
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" resources: ", this.resources);
                console.log(this.tag+" empty text: ", this.emptyText);
                console.log(this.tag+" ");
                this.initializeData();
            },
            initializeData() {
                if (this.resources !== undefined && this.resources !== null && this.resources.length > 0) {
                    for (let i = 0; i < this.resources.length; i++) {
                        this.mutableResources.push(this.resources[i]);
                    }
                }
            },
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    #project-resource-list {

    }
</style>