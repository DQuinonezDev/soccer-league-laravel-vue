<template>
    <div class="teams-view">
        <teams-list :leagues="leagues" @deleteLeague="deleteLeague" />
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import TeamsList from './LeagueList.vue';

const leagues = ref([]);

onMounted(leagueView);

async function leagueView() {
    try {
        const response = await axios.get('/leagues');
        leagues.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function deleteLeague(id) {
    try {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "The League will never come back!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        });

        if (result.isConfirmed) {
            await axios.delete(`/leagues/${id}`);
            leagueView();

            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                icon: 'success',
                title: 'successfully deleted'
            });
        }
    } catch (error) {
        console.error(error);
    }
}
</script>
  
<style scoped>


.teams-view {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: Gabarito;
    color: #333;
}
</style>