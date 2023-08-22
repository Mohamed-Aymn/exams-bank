<script>
export default{
    props: {
        next:{
            type: Function,
            required: true
        },
        prev:{
            type: Function,
            required: true
        },
    }
}
</script>

<template>
    <div class="flex items-center justify-between w-full p-5 bg-white border-t border-gray-200">
        <div class="flex gap-2">
            <button @click="prev" class="btn btn-primary">Back</button>
            <button class="btn btn-primary btn-outline" disabled>Revise later</button>
        </div>
        <button @click="next" class="btn btn-primary">Next</button>
    </div>
</template>
