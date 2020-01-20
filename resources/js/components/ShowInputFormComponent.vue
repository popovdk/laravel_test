<template>
    <div id="ShowInputForm">
        <span v-if="isShow" v-on:click="ShowInputForm"> Найти анкету по ID </span>
        <span v-if="!isShow">
            <form :action="action + '/' + formID" method="get">
                <div class="input-group">
                    <!-- <input type="hidden" name="_token" :value="csrf_token"> -->
                    <input class="form-control" type="text" v-model="formID">
                    <button class="btn btn-success"> Найти </button>
                </div>
            </form>
        </span>
    </div>
</template>

<script>
    export default {
        name: "ShowInputForm",
        //props: ['csrf_token'],
        props: {
            action: String
        },
        data () {
            return {
                formID: '',
                isShow: true,
            }
        },

        methods: {
            ShowInputForm () {
                this.isShow = false;
            }
        }
    }
</script>

<style scoped>

</style>
