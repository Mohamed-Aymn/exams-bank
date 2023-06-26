<script>
import ProfileSidebar from "../components/organisms/ProfileSidebar.vue"


export default {
    name: 'profileTemplate',
    components: {
        ProfileSidebar
    },
}
</script>

<template>
    <div class="flex h-[calc(100vh-80px)]">
        <div>
            <profile-sidebar></profile-sidebar>
        </div>
        <div class="p-6">
            data visualization here
        </div>
    </div>
</template>