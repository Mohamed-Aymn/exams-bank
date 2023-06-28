<script>
import ControllerBar from "../components/organisms/ControllerBar.vue";
import McqQuestion from "../components/organisms/McqQuestion.vue";
import TrueOrFalseQuestion from "../components/organisms/TrueOrFalseQuestion.vue";
import ProgressBar from "../components/molecules/ProgressBar.vue";
import SideController from "../components/organisms/SideController.vue";
import { computed } from 'vue';
import { useExamsStore } from '../stores/ExamStore.js';

export default {
    name: "exam",
    setup(){
        const store = useExamsStore();
        return {
            currentQuestion: computed(() => store.currentQuestion),
            nextQuestion: () => store.nextQuestion(),
            prevQuestion: () => store.prevQuestion()
        }
    },
    data(){
        return {
            duration: null,
            questions: [],
        }
    },
    beforeMount(){
        // get questions
        this.getExamInfoAndQuestions();
        // get question number
        const store = useExamsStore();
        store.setCurrentQuestion(this.$route.query.n);
    },
    methods:{
        getExamInfoAndQuestions(){
            const examId = this.$route.query.id;
            const url = '/api/v1/exams/' + examId;

            axios.get(url)
            .then(response => {
                this.duration = response.data.duration;
                this.questions = response.data.questions;
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
        },
        nextQuestion(){
            const store = useExamsStore();
            store.nextQuestion(this.questions.length);
            this.$router.push({
                path: '/exam',
                query: { ...this.$route.query, n: store.currentQuestion }
            })
        },
        prevQuestion(){
            const store = useExamsStore();
            store.prevQuestion();
            this.$router.push({
                path: '/exam',
                query: { ...this.$route.query, n: store.currentQuestion }
            })
        }
    },
    components:{
        ControllerBar,
        McqQuestion,
        TrueOrFalseQuestion,
        ProgressBar,
        SideController
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
                <SideController />
            </div>

            <!-- question area -->
            <div class="flex-grow">
                <template v-if="questions.length > 0">
                    <McqQuestion 
                        v-if="questions[currentQuestion - 1].type === 1"
                        :question="questions[currentQuestion - 1].question"
                        :choices="[
                            questions[currentQuestion - 1].choice1,
                            questions[currentQuestion - 1].choice2,
                            questions[currentQuestion - 1].choice3,
                            questions[currentQuestion - 1].choice4,
                        ]"
                        />
                    <TrueOrFalseQuestion 
                        v-else
                        :question="questions[currentQuestion - 1].question"
                        :choices="[
                            questions[currentQuestion - 1].choice1,
                            questions[currentQuestion - 1].choice2,
                        ]"
                        />
                </template>
            </div>
        </div>
        <ControllerBar :next="nextQuestion" :prev="prevQuestion" />
    </div>
</template>