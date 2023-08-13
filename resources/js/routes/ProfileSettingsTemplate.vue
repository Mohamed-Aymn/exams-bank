<script>
import { ref, onBeforeMount } from 'vue'
export default {
    name: "profile-settings",
    setup() {

        let userData = ref({})

        onBeforeMount(() => {
            axios
                .get("/api/v1/users/current-user")
                .then((response) => {
                    userData.value = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        });

        return {
            userData
        };
    }
};
</script>
<template>
    <div class="centralization-container py-6 h-full">
        <form class="flex flex-col gap-4 h-full" method="POST" :action="`/api/v1/users/${userData.user_id}`">
            @csrf
            <input class="input" type="text" :value="userData.name" name="name" />
            <input
                class="input"
                type="email"
                :value="userData.email"
                email="email"
            />
            <!-- <div class="flex flex-col gap-2">
                <div class="font-bold">Profie photo</div>
                <input type="file" class="file-input w-full max-w-xs" />
            </div> -->
            <div class="mt-auto flex justify-between items-center">
                <button class="btn btn-primary btn-outline" type="button">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
