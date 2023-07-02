<script>
import ProfileSidebar from "../components/organisms/ProfileSidebar.vue"
import { getToken } from '@/globalFunctions.js'
import { useRoute } from 'vue-router';
import { ref, watchEffect, onMounted } from 'vue'

export default {
    name: 'profileTemplate',
    components: {
        ProfileSidebar
    },
    setup(){
    // get user id
    const route = useRoute();
    const userData = ref(null);
    const url = '/api/v1/users/';

    // getToken()

    watchEffect(() => {
        const userId = route.query.id;
        if (userId) {
            axios.get(url + userId)
                .then(response => {
                    userData.value = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    });

    return {
        userData
    }
},
}
</script>

<template>
    <div
        v-if="userData" 
        class="flex h-[calc(100vh-80px)] w-screen"
        >
        <profile-sidebar></profile-sidebar>
        <div class="flex-grow p-6">
            <div class="w-full card">    
                Hello {{ userData.name }}!
            </div>
            <div>
                data visualization here
            </div>
        </div>
    </div>
</template>