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
            return `w-[calc(100% / ${this.percentage})]`
        }
    }
}
</script>
<template>
    <div
        :class="[colorClass, widthClass]"
        class="w-full text-xs text-center">
        {{text}} 
    </div>
</template>

