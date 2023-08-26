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
                        <div class=" mt-5 alert alert-warning">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            <span>
                Not all features are done or opened to be used by the end-user or ready to be benchmarked (as typed in SRS -software requirements specification- that is attached in the documentation) as this is an Experimental project, and the primary purpose is digging deep to a real-life project and to explore php/Laravel world and being responsible for managing a whole website.
            </span>
          </div>
            </div>
        </div>
    </div>
</template>
