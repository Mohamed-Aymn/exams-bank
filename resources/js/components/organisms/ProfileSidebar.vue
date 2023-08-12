<script>
    export default {
        props: {
            elements: Array,
        }
    }
</script>


<template>
    <div class="drawer absolute top-1/2 z-50 right-4 lg:hidden">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer" class="btn btn-circle drawer-button">></label>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 h-full bg-white text-base-content">
                <!-- Sidebar content here -->
                <div v-for="element in elements">
                    <div class="text-gray-400">{{ element . title }}</div>

                    <div v-for="link in element.content">
                        <a class="block ml-2 link link-hover" :href="link.linkId">
                            {{ link . linkText }}
                        </a>
                    </div>
                </div>

            </ul>
        </div>
    </div>

    <!-- big screen approach -->
    <div class="absolute flex-col justify-between hidden w-64 p-6 shadow bg-gray-50 sm:relative sm:h-full lg:flex">
        <div class="flex flex-col gap-4">
            <div v-for="element in elements">
                <div class="text-gray-400">{{ element . title }}</div>

                <div v-for="link in element.content">
                    <a class="block ml-2 link link-hover" :href="link.linkId">
                        {{ link . linkText }}
                    </a>
                </div>
            </div>
        </div>
        <a href="/auth/logout" class="link link-hover">logout</a>
    </div>
</template>
