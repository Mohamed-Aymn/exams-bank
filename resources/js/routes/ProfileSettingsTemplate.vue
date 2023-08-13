<script>
import { ref, onBeforeMount } from 'vue'
export default {
    name: "profile-settings",
    setup() {

        let userData = ref({})

        onBeforeMount(async () => {
            await axios
                .get("/api/v1/users/current-user")
                .then((response) => {
                    userData.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        });

        const clickHandler = async (userData) => {
            // get csrf token
            await axios.get("/sanctum/csrf-cookie");

            // submit data
            await axios.post(`/api/v1/users/${userData.user_id}`, userData)
                .then((response) => {
                    console.log(response)
                })
                .catch((error) => {
                    console.log(error);
                });

            // redirect to profile page
            window.location.href = "http://localhost:8000/profile?id=" + userData.user_id;
        }

        return {
            userData,
            clickHandler
        };
    }
};
</script>
<template>
    <div class="centralization-container py-6 h-full">
        <form class="flex flex-col gap-4 h-full" >
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <input class="input" type="text" v-model="userData.name"  name="name" />
            <input
                class="input"
                type="email"
                v-model="userData.email"
                email="email"
            />
            <!-- <div class="flex flex-col gap-2">
                <div class="font-bold">Profie photo</div>
                <input type="file" class="file-input w-full max-w-xs" />
            </div> -->
            <div class="mt-auto flex justify-between items-center">
                <button class="btn btn-primary btn-outline" >Cancel</button>
                    <button @click.prevent="clickHandler(userData)" class="btn btn-primary" >Submit</button>
                </div>
                </form>
            </div>
</template>
