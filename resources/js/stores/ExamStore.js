import { defineStore } from "pinia";
import { ref } from "vue";

export const useExamsStore = defineStore("exam", () => {
    // state
    const currentQuestion = ref(1);
    const answers = ref([]); // {questionId, answers, answerTime, isSent}

    // methods
    function nextQuestion(numberOfQuestions) {
        currentQuestion.value != numberOfQuestions
            ? currentQuestion.value++
            : null;
    }
    function prevQuestion() {
        currentQuestion.value != 1 ? currentQuestion.value-- : null;
    }
    function setCurrentQuestion(value) {
        currentQuestion.value = value;
    }
    function addAnswer(questionId, answer, answerTime) {
        const newRecord = { questionId, answer, answerTime };
        const index = answers.value.findIndex(
            (a) => a.questionId === newRecord.questionId
        );

        // update if exists and create one if not
        if (index !== -1) {
            answers.value[index] = newRecord;
        } else {
            answers.value.push(newRecord);
        }
    }
    function setAllAnswers(newAnswers) {
        answers.value = newAnswers;
    }
    function userChoice(questionId) {
        let result = null;
        answers.value.map((a) => {
            if (a.questionId == questionId) {
                result = a.answer;
            }
        });
        return result;
    }

    return {
        currentQuestion,
        answers,
        nextQuestion,
        prevQuestion,
        setCurrentQuestion,
        addAnswer,
        setAllAnswers,
        userChoice,
    };
});
