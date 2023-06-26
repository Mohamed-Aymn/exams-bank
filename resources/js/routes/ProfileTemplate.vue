<script>
import ProfileSidebar from "../components/organisms/ProfileSidebar.vue"
import { getToken } from '@/globalFunctions.js'

export default {
    name: 'profileTemplate',
    components: {
        ProfileSidebar
    },
    mounted(){
        this.getToken();
    },
    methods:{
        getToken,
    }
}
</script>

<template>
    <div class="flex h-[calc(100vh-80px)]">
        <div>
            <profile-sidebar></profile-sidebar>
        </div>
        <div class="p-6">
            <div>               
                data visualization here
            </div>
            <button class="btn btn-primary" @click="getToken">
                click me
            </button>
        </div>
    </div>
</template>