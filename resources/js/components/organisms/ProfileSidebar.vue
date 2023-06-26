<script>

export default{
    data() {
        return {
        elements: [
            {
                title: "Dashboard elements",
                content: [
                    {
                        linkText: "element one",
                        linkId: "elementOne"
                    }
                ]
            }
        ]
        }
    }
}
</script>


<template>
<div class="absolute flex-col justify-between hidden w-64 p-6 shadow bg-gray-50 sm:relative sm:h-full sm:flex">
        <div v-for="element in elements">
            <div class="text-gray-400">{{ element.title }}</div>
            
            <div v-for="link in element.content">
                <a class="block ml-2 btn btn-tertiary" :href="'#' + link.linkId">
                    {{ link.linkText }}
                </a>
            </div>
        </div>
        <button class="text-left btn btn-tertiary">
            Logout
        </button>
</div>
</template>
