<template>
    <div class="flex flex-col w-screen h-screen">
        <div class="">
            <ProgressBar color="red-500" text="n solved from m" />
            <ProgressBar color="blue-500" text="20:00" />
        </div>
        <div class="flex flex-grow">
            <div class="flex-grow">
                {{ $route.params.id }}
                <!-- <router-view></router-view> -->
            </div>
            <div class="w-3/12">
                <SideController />
            </div>
        </div>
        <ControllerBar />
    </div>
</template>

<script>
import ControllerBar from "../../components/organisms/ControllerBar.vue";
import ProgressBar from "../../components/molecules/ProgressBar.vue";
import SideController from "../../components/organisms/SideController.vue";

export default {
    name: "exam",
    components:{
        ControllerBar,
        ProgressBar,
        SideController
    }
};
</script>