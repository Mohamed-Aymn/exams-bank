<script>
import ControllerBar from "../components/organisms/ControllerBar.vue";
import ProgressBar from "../components/molecules/ProgressBar.vue";
import SideController from "../components/organisms/SideController.vue";

export default {
    name: "exam",
    return:{
        duration: null,
        questions: []
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
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    components:{
        ControllerBar,
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
            <div class="flex-grow">
                <router-view></router-view>
            </div>
        </div>
        <ControllerBar />
    </div>
</template>