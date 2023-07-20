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

<div class="flex flex-col h-full px-4 mx-auto py-12 lg:max-w-5xl">
    <div>
        {{ question }}
    </div>
    <div class="divider"></div> 
    <div class="grid gap-2 mt-auto grid-rows4 lg:grid-cols-2">
        <div 
            v-for="choice in choices" 
            @click="chooseAnswer(choice, '3:00', questionId)"
            class="card card-clickable">
            {{choice}}
        </div>
    </div>
</div>

</template>