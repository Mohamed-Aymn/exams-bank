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
        }
    }
}
</script>

<template>

<div class="px-4 mx-auto mt-12 lg:max-w-5xl">
    <div class="card">
        {{ question }}
            <!-- question -->
    </div>
    <div class="grid gap-2 mt-6 grid-rows4 lg:grid-cols-2">
        <div v-for="choice in choices" class="card card-clickable">{{choice}}</div>
    </div>
</div>

</template>