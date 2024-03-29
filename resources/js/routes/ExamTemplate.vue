<script>
import ControllerBar from "../components/organisms/ControllerBar.vue";
import McqQuestion from "../components/organisms/McqQuestion.vue";
import TrueOrFalseQuestion from "../components/organisms/TrueOrFalseQuestion.vue";
import ProgressBar from "../components/molecules/ProgressBar.vue";
import QuestionsPagination from "../components/organisms/QuestionsPagination.vue";
import { useExamsStore } from "../stores/ExamStore.js";
import { ref, computed, onBeforeMount, onMounted } from "vue";
import {timeProgress, questionsProgress} from '../examFunctions';

export default {
    name: "exam",
    setup() {
        const examStore = useExamsStore();

        let duration = ref(0);
        let questions = ref([]);
        let examQuestionsProgress = ref(0);
        examQuestionsProgress.value = questionsProgress(questions.value.length, examStore.answers)

        //timer
        let timer = ref(0);
        let examTimer = ref(0)
        setInterval(() => {
            timer.value += 1;
                examTimer.value = timeProgress(duration.value, timer.value) 
        }, 1000);

        onBeforeMount(() => {
            const urlParams = new URLSearchParams(window.location.search);
            const examId = urlParams.get("id");
            const url = "/api/v1/exams/" + examId;

            axios
                .get(url)
                .then((response) => {
                    duration.value = response.data.duration;
                    questions.value = response.data.questions;
                })
                .catch((error) => {
                    console.log(error);
                });

            const request = window.indexedDB.open("examDB", 1);

            request.onerror = function () {
                console.error("Database connection error");
            };

            request.onupgradeneeded = function (event) {
                const db = event.target.result;
                const objectStore = db.createObjectStore("answers", {
                    keyPath: "questionId",
                });
            };

            request.onsuccess = function (event) {
                const db = event.target.result;
                const transaction = db.transaction(["answers"], "readonly");
                const objectStore = transaction.objectStore("answers");

                const getAllRequest = objectStore.getAll();
                getAllRequest.onerror = (event) => {
                    console.error("Error getting data:", event.target.error);
                };
                getAllRequest.onsuccess = (event) => {
                    examStore.setAllAnswers(event.target.result);
                };
            };
        });

        return {
            examStore,
            duration,
            questions,
            examTimer,
            examQuestionsProgress
        };
    },
    methods: {
        nextQuestion() {
            this.examStore.nextQuestion(this.questions.length);
            this.$router.push({
                path: "/exam",
                query: {
                    ...this.$route.query,
                    n: this.examStore.currentQuestion,
                },
            });
        },
        prevQuestion() {
            this.examStore.prevQuestion();
            this.$router.push({
                path: "/exam",
                query: {
                    ...this.$route.query,
                    n: this.examStore.currentQuestion,
                },
            });
        },
        setQuestion(newIndex) {
            this.examStore.setCurrentQuestion(newIndex);
            this.$router.push({
                path: "/exam",
                query: {
                    ...this.$route.query,
                    n: this.examStore.currentQuestion,
                },
            });
        },
        chooseAnswer(answer, answerTime, questionId) {
            // store in exams store (client state)
            this.examStore.addAnswer(questionId, answer, answerTime);


            // store in indexeddb
            const request = window.indexedDB.open("examDB", 1);
            request.onupgradeneeded = function (event) {
                const db = event.target.result;
                if (!db.objectStoreNames.contains("answers")) {
                    const objectStore = db.createObjectStore("answers", {
                        keyPath: "questionId",
                    });
                }
            };

            request.onerror = function () {
                console.error("Database connection error");
            };

            request.onsuccess = function (event) {
                const db = event.target.result;

                const transaction = db.transaction(["answers"], "readwrite");
                const objectStore = transaction.objectStore("answers");

                const getRequest = objectStore.get(questionId);
                getRequest.onsuccess = function (event) {
                    const question = event.target.result;
                    // console.log(answer);
                    const recordData = {
                        questionId,
                        answer,
                        isSent: false,
                        answerTime,
                    };
                    if (!question) {
                        const addRequest = objectStore.add(recordData);
                        addRequest.onerror = function (event) {
                            console.error(
                                "Error adding question: " + event.target.error
                            );
                        };
                        addRequest.onsuccess = function () {
                            // console.log('Question added successfully');
                        };
                    } else {
                        const updateRequest = objectStore.put(recordData);
                        updateRequest.onsuccess = function () {
                            // console.log('Data updated successfully');
                        };

                        updateRequest.onerror = function (event) {
                            console.error(
                                "Error updating data: ",
                                event.target.error
                            );
                        };
                    }
                };
                getRequest.onerror = function (event) {
                    console.log("Error retrieving user: ", event.target.error);
                };
            };
        },
        submitHanlder() {
            if (this.examStore.answers.length == this.questions.length) {
                const urlParams = new URLSearchParams(window.location.search);
                const examId = urlParams.get("id");
                const url = "/api/v1/exams/" + examId;

                axios
                    .post(url, { answers: this.examStore.answers })
                    .then((response) => {
                        // detele answers in indexed database
                        const dbName = "examDB";
                        const request = window.indexedDB.open(dbName, 1);
                        request.onerror = function () {
                            console.error("Database connection error");
                        };
                        request.onsuccess = function (event) {
                            console.log("success");
                            const request = indexedDB.deleteDatabase(dbName);
                        };
                        window.location.href = "/exams/" + examId + "/results";
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
    },
    components: {
        ControllerBar,
        McqQuestion,
        TrueOrFalseQuestion,
        ProgressBar,
        QuestionsPagination,
    },
};
</script>

<template>
    <div class="flex flex-col w-screen h-screen">
        <div v-if="duration">
            <div class="">
                <!-- <ProgressBar color="" text="n solved from m" /> -->
                <!-- <ProgressBar color="" text="20:00" :percentage="examTimer" /> -->
            </div>
        </div>

        <div class="flex flex-grow">
            <div>
                <QuestionsPagination
                    :length="questions.length"
                    :clickHanlder="setQuestion"
                    :submitHanlder="submitHanlder"
                    :currentQuestion="examStore.currentQuestion"
                />
            </div>

            <div class="flex-grow">
                <template v-if="questions.length > 0">
                    <McqQuestion
                        v-if="
                            questions[examStore.currentQuestion - 1].type === 1
                        "
                        :question="
                            questions[examStore.currentQuestion - 1].question
                        "
                        :choices="[
                            questions[examStore.currentQuestion - 1].choice1,
                            questions[examStore.currentQuestion - 1].choice2,
                            questions[examStore.currentQuestion - 1].choice3,
                            questions[examStore.currentQuestion - 1].choice4,
                        ]"
                        :chooseAnswer="chooseAnswer"
                        :questionId="
                            questions[examStore.currentQuestion - 1].question_id
                        "
                        :userChoice="
                        examStore.userChoice(questions[examStore.currentQuestion - 1].question_id)
                        "
                    />
                    <TrueOrFalseQuestion
                        v-else
                        :question="
                            questions[examStore.currentQuestion - 1].question
                        "
                        :choices="[
                            questions[examStore.currentQuestion - 1].choice1,
                            questions[examStore.currentQuestion - 1].choice2,
                        ]"
                        :chooseAnswer="chooseAnswer"
                        :questionId="
                            questions[examStore.currentQuestion - 1].question_id
                        "
                    />
                </template>
            </div>
        </div>

        <ControllerBar :next="nextQuestion" :prev="prevQuestion" />
    </div>
</template>
