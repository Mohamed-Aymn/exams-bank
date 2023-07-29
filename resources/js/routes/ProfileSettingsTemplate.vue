<script>
export default {};
</script>
<template>
    <div class="centralization-container py-6 h-full">
        <form class="flex flex-col gap-4 h-full" method="POST" action="/user">
            <input class="input" type="text" placeholder="name" name="name" />
            <input
                class="input"
                type="email"
                placeholder="email"
                email="email"
            />
            <div class="flex flex-col gap-2">
                <div class="font-bold">Profie photo</div>
                <input type="file" class="file-input w-full max-w-xs" />
            </div>
            <div class="mt-auto flex justify-between items-center">
                <button class="btn btn-primary btn-outline">Cancel</button>
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
