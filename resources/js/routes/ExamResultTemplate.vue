<script>
    import {
        ref,
        onBeforeMount,
        onMounted
    } from 'vue'
    import Chart from '../components/organisms/Chart.vue'

    export default {
        setup() {
            // get exam results
            const examId = ref(null);
            const results = ref(null);
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

            return {
                results
            }
        },
        components: {
            Chart
        }
    }
</script>

<template>
    <div v-if="results" class="centralization-container h-full flex flex-col py-10">
        <div class="font-bold text-6xl">
            {{ results . grade }}
        </div>
        <div>{{ results . correct }} out of {{ results . number_of_questions }}</div>
        <div>wrong answers: {{ results . wrong }}</div>
        <div>

        </div>
        <div class="my-6">
            <Chart componentId="examResult" :appendText="false"
                :data="[
                    { name: 'correct', value: results.correct, color: '#7999' },
                    { name: 'wrong', value: results.wrong, color: '#ff0000' }
                ]" />
        </div>
        <a href="/profile?id=" class="mt-auto btn btn-primary">Back to profile page</a>
    </div>
</template>
