<script>
    import ProfileSidebar from "../components/organisms/ProfileSidebar.vue"
    import {
        getToken
    } from '@/globalFunctions.js'
    import {
        useRoute
    } from 'vue-router';
    import {
        ref,
        watchEffect,
        onMounted
    } from 'vue'
    import Chart from '../components/organisms/Chart.vue';

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
        components: {
            Chart,
            ProfileSidebar
        }
    }
</script>

<template>
    <div v-if="userData" class="flex h-[calc(100vh-80px)] w-screen">
        <profile-sidebar :elements="[{
 title: 'Dashboard elements',
                    content: [{
                        linkText: 'Right and wrong answers',
                    linkId: 'rightAndWrongA'
                    }]
                }]"></profile-sidebar>
        <div class="flex-grow p-6 overflow-y-auto">
            <div class="w-full card flex flex-row items-end">
                <span> Hello</span>
                <span class="font-bold inline ml-2 text-2xl"> {{ userData . name }}!</span>
            </div>
            <div class="py-6">
                <div class="max-w-md card">
                    <div class="bold mb-4" id="rightAndWrongA">Right & wrong answers</div>
                    <Chart componentId="first"
                        :appendText="false"
                        :data="[{ name: 'first', value: 50, color: '#ff0000' }, {
                            name: 'second',
                            value: 100,
                            color: '#008000'
                        }]" />
                    <span class="flex gap-1 items-center">
                        <span class="w-[0.75em] h-[0.75em] bg-[#008000]" />
                        <sapn>Right</sapn>
                    </span>
                    <span class="flex gap-1 items-center">
                        <span class="w-[0.75em] h-[0.75em] bg-[#ff0000]" />
                        <sapn>wrong</sapn>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
