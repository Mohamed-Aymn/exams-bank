<script>
import { ref, onBeforeMount, onMounted } from 'vue'

export default{
    setup(){
        // get exam results
        const examId = ref(null);
        const results = ref({});
        onBeforeMount(() => {
            const pathSegments = window.location.pathname.split('/');
            examId.value = pathSegments[pathSegments.length - 2];
        });
        onMounted(() => {
            const url = '/api/v1/exams/' + examId.value + '/results';
            axios.get(url)
                .then(response => {
                    results.value = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        });
    
        return{
            results: results
        }
    }
}
</script>

<template>
    {{ results.grade }}
    {{ results.correct }} / {{ results.number_of_questions }}
    you missed {{ results.wrong }}
</template>