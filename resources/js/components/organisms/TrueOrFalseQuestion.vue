<script>
export default{
    props:{
        question: {
            type: String,
            required: true
        },
        choices: {
            type: Array,
            required: true
        },
        chooseAnswer:{
            type: Function,
            required: true
        },
        questionId:{
            type: Number,
            required: true
        }
    }
}
</script>

<template>
    this is true or false question
</template>