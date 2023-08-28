<template>
    <div class="teams-list">
        <h1 class="teams-list__title">Team List</h1>
        <a href="/createTeams" class="create-team-button">Create Team</a>

        <div class="team-cards">
            <team-card v-for="team in teams" :key="team.id" :team="team" :deleteTeam="deleteTeam" />
        </div>
    </div>
</template>
  
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import TeamCard from './TeamCards.vue';

const teams = ref([]);

onMounted(teamView);

async function teamView() {
    try {
        const response = await axios.get('/teams');
        teams.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function deleteTeam(id) {
    try {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "The team will never come back!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        });

        if (result.isConfirmed) {
            await axios.delete(`/teams/${id}`);
            teamView();

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
.teams-list {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: Gabarito;
    color: #333;
}

.teams-list__title {
    font-size: 2.5rem;
    margin-bottom: 20px;
    text-align: center;
}

.create-team-button {
    display: block;
    margin-bottom: 20px;
    text-align: right;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.create-team-button:hover {
    color: #0056b3;
}

.team-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    justify-content: center;
}

.team-card {
    background-color: #f5f5f5;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
}

@media screen and (max-width: 768px) {
    .team-cards {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 10px;
    }
}

/* Adjust font sizes and spacing for smaller screens */
@media screen and (max-width: 480px) {
    .teams-list__title {
        font-size: 24px;
        margin-bottom: 10px;
    }

}
</style>
  