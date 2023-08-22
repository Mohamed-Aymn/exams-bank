<script>
export default {
    props: {
        text: {
            type: String,
            required: true
        },
        color: {
            type: String,
            required: true
        },percentage:{
            type: Number 
        },
    },
    computed: {
        colorClass() {
            return "bg-" + this.color;
        },
        widthClass(){
            return `w-[${this.percentage}%]`
        }
    }
}
</script>
<template>

<div class="w-full h-4 relative">
    <div
    :class="[colorClass, widthClass]"
    class="flex justify-center items-center w-full text-xs text-center h-full">
        {{text}} 
    </div>

    <!-- <div class="bg-green-500 h-4 w-full absolute bottom-0"> -->
    <div class=" h-4 w-full absolute bottom-0">
        <div class="bg-green-500 h-full z-10" :class="widthClass"></div>
    </div>
</div>

</template>

