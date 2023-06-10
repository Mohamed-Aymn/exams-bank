<template>
    <div
        :class="colorClass"
        class="w-full text-xs text-center">
        {{text}} 
    </div>
</template>

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
        }
    },
    computed: {
        colorClass() {
            return "bg-" + this.color;
        }
    }
}
</script>