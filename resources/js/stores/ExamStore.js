import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useExamsStore = defineStore('exam', () => {
    const currentQuestion = ref(1)
    function nextQuestion(numberOfQuestions) {
        currentQuestion.value != numberOfQuestions? currentQuestion.value++: null;
    }
    function prevQuestion() {
        currentQuestion.value != 1 ? currentQuestion.value-- : null;
    }

    function setCurrentQuestion(value) {
        currentQuestion.value = value;
    }

    return { currentQuestion, nextQuestion, prevQuestion, setCurrentQuestion }
})