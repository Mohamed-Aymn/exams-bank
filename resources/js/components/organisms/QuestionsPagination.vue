<script>
export default{
    props:{
        length:{
            type: Number,
            required: true
        },
        clickHanlder:{
            type: Function,
            required: true
        }
    }
}
</script>

<template>
<div class="h-full overflow-y-scroll bg-white ">
    <div class="flex flex-wrap gap-4 p-4 bg-white border-l border-gray-200">
        <div v-for="i in length" @click="clickHanlder(i)" :key="i" class="flex items-center justify-center w-16 h-16 bg-blue-500 hover:cursor-pointer">
            {{ i }}
        </div>
    </div>
</div>
</template>