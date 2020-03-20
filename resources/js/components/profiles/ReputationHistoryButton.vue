<template>
    <div class="reputation-history-button__wrapper">

        <v-btn small color="primary" @click="onClickButton">
            Bekijk reputatie geschiedenis
        </v-btn>



    </div>
</template>

<script>
    export default {
        props: [
            "transactions",
        ],
        data: () => ({
            tag: "[reputation-history-button]",
            mutableTransactions: [],
            dialogs: {
                view: {
                    show: false,
                }
            }
        }),
        methods: {
            initialize() {
                console.log(this.tag+" initializing");
                console.log(this.tag+" transactions: ", this.transactions);
                this.initializeData();
            },
            initializeData() {
                if (this.transactions !== undefined && this.transactions !== null && this.transactions.length > 0) {
                    for (let i = 0; i < this.transactions.length; i++) {
                        this.mutableTransactions.push(this.transactions[i]);
                    }
                }
            },
            onClickButton() {
                this.dialogs.view.show = true;
            }
        },
        mounted() {
            this.initialize();
        }
    }
</script>

<style lang="scss">
    .reputation-history-button__wrapper {
        
    }
</style>