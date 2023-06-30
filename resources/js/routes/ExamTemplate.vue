<script>
import ControllerBar from "../components/organisms/ControllerBar.vue";
import McqQuestion from "../components/organisms/McqQuestion.vue";
import TrueOrFalseQuestion from "../components/organisms/TrueOrFalseQuestion.vue";
import ProgressBar from "../components/molecules/ProgressBar.vue";
import QuestionsPagination from "../components/organisms/QuestionsPagination.vue";
import { useExamsStore } from '../stores/ExamStore.js';
import { ref, onBeforeMount } from 'vue'

export default {
    name: "exam",
    setup(){
        const examStore = useExamsStore();

        let duration = ref(0);
        let questions = ref([]);

        onBeforeMount(() => {
            const urlParams = new URLSearchParams(window.location.search);
            const examId = urlParams.get('id'); 
            const url = '/api/v1/exams/' + examId;

            axios.get(url)
                .then(response => {
                    duration.value = response.data.duration;
                    questions.value = response.data.questions;
                })
                .catch(error => {
                    console.log(error);
                });
        })
        return {
            examStore,
            duration,
            questions,
        }
    },
    methods:{
        nextQuestion(){
            this.examStore.nextQuestion(this.questions.length);
            this.$router.push({
                path: '/exam',
                query: { ...this.$route.query, n: this.examStore.currentQuestion }
            })
        },
        prevQuestion(){
            this.examStore.prevQuestion();
            this.$router.push({
                path: '/exam',
                query: { ...this.$route.query, n: this.examStore.currentQuestion }
            })
        },
        setQuestion(newIndex){
            this.examStore.setCurrentQuestion(newIndex);
            this.$router.push({
                path: '/exam',
                query: { ...this.$route.query, n: this.examStore.currentQuestion }
            })
        }
    },
    components:{
        ControllerBar,
        McqQuestion,
        TrueOrFalseQuestion,
        ProgressBar,
        QuestionsPagination
    }
};
</script>

<template>
    <div class="flex flex-col w-screen h-screen">
        <div class="">
            <ProgressBar color="red-500" text="n solved from m" />
            <ProgressBar color="blue-500" text="20:00" />
        </div>
        <div class="flex flex-grow">
            <div class="w-3/12">
                <QuestionsPagination 
                    :length="questions.length"
                    :clickHanlder="setQuestion"
                    />
            </div>

            <div class="flex-grow">
                <template v-if="questions.length > 0">
                    <McqQuestion 
                        v-if="questions[examStore.currentQuestion - 1].type === 1"
                        :question="questions[examStore.currentQuestion - 1].question"
                        :choices="[
                            questions[examStore.currentQuestion - 1].choice1,
                            questions[examStore.currentQuestion - 1].choice2,
                            questions[examStore.currentQuestion - 1].choice3,
                            questions[examStore.currentQuestion - 1].choice4,
                        ]"
                        />
                    <TrueOrFalseQuestion 
                        v-else
                        :question="questions[examStore.currentQuestion - 1].question"
                        :choices="[
                            questions[examStore.currentQuestion - 1].choice1,
                            questions[examStore.currentQuestion - 1].choice2,
                        ]"
                        />
                </template>
            </div>
        </div>
        <ControllerBar :next="nextQuestion" :prev="prevQuestion" />
    </div>
</template>