<template>
    hello from teacher requests
<div class="mt-6 overflow-hidden card">
    <table class="table">
        <thead>
            <tr class="tr">
                <th class="th" ></th>
                <th class="th">Name</th>
                <th class="th">Date</th>
                <th class="th">Description</th>
            </tr>
        </thead>
        <tbody>
                <tr 
                    tabindex="0" 
                    v-on:click="changeRoute('manage/teachers/teacher')"
                    class="tr-button"
                    >
                    <td class="td">
                        <span>#</span>
                    </td>
                    <td class="td" >
                        <p class="font-medium">Sanjeet Nthanda</p>
                    </td>
                    <td class="td">
                        Date
                    </td>
                    <td class="td">
                        <p class="overflow-hidden whitespace-nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis dolore labore obcaecati dolorem in! Exercitationem qui quasi ipsa, quo quaerat vero velit veniam rerum quam dolore repellat quod temporibus natus? </p>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
</template>


<script>
import {changeRoute} from '@/globalFunctions.js'
export default {
    methods:{
        changeRoute,
    }
}
</script>