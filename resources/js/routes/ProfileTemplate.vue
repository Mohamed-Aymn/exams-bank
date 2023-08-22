<script>
    import ProfileSidebar from "../components/organisms/ProfileSidebar.vue"
    import { useRoute } from 'vue-router';
    import { ref, watchEffect} from 'vue'

    export default {
        name: 'profileTemplate',
        components: {
            ProfileSidebar
        },
        setup() {
            // get user id
            const route = useRoute();
            const userData = ref(null);
            const url = '/api/v1/users/';

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
        components: {
            ProfileSidebar
        }
    }
</script>

<template>
    <div v-if="userData" class="flex h-[calc(100vh-80px)] w-screen">
        <profile-sidebar
            :elements="[
                {
                    title: 'Settings',
                    content: [{
                        linkText: 'profile Settings',
                        linkId: '/profile/settings?id=asdf'
                    }]
                },{
                title: 'Dashboard elements',
                content: [{
                    linkText: 'Right and wrong answers',
                    linkId: '#rightAndWrongA'
                }]
            }]">
        </profile-sidebar>
        <div class="flex-grow p-6 overflow-y-auto">
            <div class="w-full card flex flex-row items-end">
                <span> Hello</span>
                <span class="font-bold inline ml-2 text-2xl"> {{ userData . name }}!</span>
            </div>
            <div class="card mt-5">
                Data visualization that represents profile stats to make student user 
                able to moitor his progress
                <div class="card card-alert mt-5">
                    Not all features are made or will be made (typed features in SRS) as this is a Experimental project, and the main purpose is digging deep to real life project and also to explore php/laravel world.</div>
            </div>
        </div>
    </div>
</template>
