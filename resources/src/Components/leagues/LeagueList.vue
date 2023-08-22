<template>
    <div class="leagues-view">
        <h1 class="leagues-view__title">League List</h1>
        <a href="/leagues/create" class="create-league-button">Create League</a>

        <div class="league-cards">
            <league-card v-for="league in leagues" :key="league.id" :league="league" @deleteLeague="deleteLeague" />
            
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import LeagueCard from './LeagueCards.vue';

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
            text: 'The league will be deleted permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d9534f',
            cancelButtonColor: '#5bc0de',
            confirmButtonText: 'Delete',
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
                title: 'League deleted successfully',
            });
        }
    } catch (error) {
        console.error(error);
    }
}
</script>
  
<style scoped>
.leagues-view {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Gabarito', sans-serif;
    color: #333;
}

.leagues-view__title {
    font-size: 2.5rem;
    margin-bottom: 20px;
    text-align: center;
}

.create-league-button {
    display: block;
    margin-bottom: 20px;
    text-align: right;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}


.create-league-button:hover {
    color: #0056b3;
}

.league-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    justify-content: center;
}

.league-card {
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.league-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
}

.league-card__content {
    flex-grow: 1;
}

.league-card__actions {
    margin-top: 10px;
}

.delete-button {
    background-color: #d9534f;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.2s;
}

.delete-button:hover {
    background-color: #c9302c;
}
.league-card__header {
    font-size: 1.25rem;
    margin-bottom: 10px;
}
s


.league-card__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Loading and error messages */
.loading-message,
.error-message {
    text-align: center;
    margin-top: 20px;
    color: #d9534f;
}
</style>
  