<script>
    export default {
        props: {
            length: {
                type: Number,
                required: true
            },
            clickHanlder: {
                type: Function,
                required: true
            },
            submitHanlder: {
                type: Function,
                required: true
            },currentQuestion:{
                type: Number,
            }
        }
    }
</script>

<template>
    <!-- small screens questions pagination -->
    <div class="drawer absolute top-1/2 z-50 right-4">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-circle drawer-button">></label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 h-full bg-white text-base-content">
                <!-- Sidebar content here -->
                <div class="flex flex-wrap gap-2">
                    <div v-for="i in length" @click="() => {
                        clickHanlder(i);
                        }" 
                        :key="i"
                        class="flex items-center justify-center w-16 h-16 card card-clickable hover:cursor-pointer"
                        :class="{'bg-[#4b4fbe] text-white hover:bg-[#4b4fbe]': currentQuestion == i}" 
                        >
                        {{ i }}
                    </div>
                </div>
                <button @click="submitHanlder" class="w-full mt-auto btn btn-primary">
                    Submit
                </button>
            </ul>
        </div>
    </div>
</template>
