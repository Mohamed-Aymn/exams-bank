<script>
import ControllerBar from "../components/organisms/ControllerBar.vue";
import McqQuestion from "../components/organisms/McqQuestion.vue";
import TrueOrFalseQuestion from "../components/organisms/TrueOrFalseQuestion.vue";
import ProgressBar from "../components/molecules/ProgressBar.vue";
import SideController from "../components/organisms/SideController.vue";

export default {
    name: "exam",
    data(){
        return {
            duration: null,
            questions: [],
            currentQuestion: 1,
        }
    },
    mounted(){
        this.getExamInfoAndQuestions();
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
                    <McqQuestion v-if="questions[currentQuestion].type === 1">
                    </McqQuestion>
                    <TrueOrFalseQuestion v-else></TrueOrFalseQuestion>
                </template>
            </div>

        </div>
        <ControllerBar />
    </div>
</template>