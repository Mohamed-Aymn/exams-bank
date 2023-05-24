<template>

    <x-card class="mt-6 overflow-hidden">
        <table class="w-full whitespace-nowrap">
            <thead class="bg-white ">
                <tr class="text-left">
                    <th ></th>
                    <th class="mr-4">Title</th>
                    <th class="pr-4">Author</th>
                    <th class="pr-4 text-left">Date</th>
                    <th>Question</th>
                </tr>
            </thead>
            <tbody>
                <tr 
                    tabindex="0" 
                    onclick="location.href='{{url('bank/questions/question')}}'"
                    class="h-16 border border-gray-100 rounded cursor-pointer focus:outline-none dark:border-gray-600"
                    >
                    <td>
                        <div class="mx-5">#</div>
                    </td>
                    <td class="pr-4">
                        <p class="font-medium">Marketing Keynote Presentation</p>
                    </td>
                    <td>
                        Author
                    </td>
                    <td>
                        Date
                    </td>
                    <td>
                        <p class="overflow-hidden whitespace-nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dolore labore obcaecati dolorem in! Exercitationem qui quasi ipsa, quo quaerat vero velit veniam rerum quam dolore repellat quod temporibus natus? </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </x-card>
</template>
<script>

// import card from '@/views/components/molecules/card.php';

export default {

}

// export default {
//     setup() {},
// };

</script>