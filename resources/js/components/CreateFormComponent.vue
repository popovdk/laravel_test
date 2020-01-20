<template>
    <div id="CreateFormComponent">
        <form :action="action" method="post">
            <input type="hidden" name="_token" :value="csrf_token">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3"> Заголовок: </span>
                </div>
                <input v-model="title" name="title" type="text" class="form-control" aria-describedby="basic-addon3">
            </div> <br>

            <div class="input-group" v-for="(question, key) in questions">
                <div class="input-group-prepend" v-on:dblclick="delQuestion(key)">
                    <span class="input-group-text"> Вопрос #{{++key}} </span>
                </div>
                <textarea v-model="question.text" name="questions[]" class="form-control"/>
            </div>
            <br>
            <button type="button" class="btn btn-primary" v-on:click="addQuestion"> Добавить вопрос </button>
            <button class="btn btn-success" type="submit"> Создать </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            csrf_token: String,
            action: String,
            old_values: Array,
        },
        data () {
            return {
                title: '',
                questions: [],

            }
        },

        methods: {
            addQuestion () {
                this.questions.push({'text': ''})
            },
            delQuestion (key) {
                this.questions.splice(--key, 1);
            },
        },
        mounted: function () {
            let decode_old_value = JSON.parse(this.old_values);

            if (decode_old_value.length !== 0) {
                this.title = decode_old_value['title'];

                let questions = [];
                decode_old_value['questions'].forEach(function (item) {
                        questions.push({'text': item})
                });
                this.questions = questions;
            } else
                this.questions.push({'text': ''},  {'text': ''})



        }
    }
</script>
