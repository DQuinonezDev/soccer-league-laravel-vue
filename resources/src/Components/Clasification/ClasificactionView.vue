<template>
    <div class="p-8 min-h-screen bg-gray-100">
      <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold mb-4 text-gray-800 p-4">Tabla de Clasificación</h1>
        <div class="flex items-center space-x-4 mb-6 p-4">
          <label for="league" class="font-semibold text-gray-700">Seleccionar liga:</label>

          <select v-model="selectedLeague"
          class="w-64 py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-600">
          <option value="">Select a league</option>

         
            <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
          </select>
        </div>
        <div v-if="selectedLeague">
          <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
              <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Equipo</th>
                    <th class="py-3 px-4">PJ</th>
                    <th class="py-3 px-4">PG</th>
                    <th class="py-3 px-4">PE</th>
                    <th class="py-3 px-4">PP</th>
                    <th class="py-3 px-4">GF</th>
                    <th class="py-3 px-4">GC</th>
                    <th class="py-3 px-4">Dif</th>
                    <th class="py-3 px-4">Pts</th>
                  </tr>
              </thead>
              <tbody>
                <tr v-for="(team, index) in filteredTeams" :key="team.id" :class="index % 2 === 0 ? 'bg-gray-100' : 'bg-gray-50'">
                  <td class="py-4 px-4">
                    <div class="flex items-center">
                      <span class="text-gray-600 mr-2">{{ index + 1 }}.</span>
                      <img :src="getTeamImage(team.team_id)" alt="Equipo" class="w-8 h-8 rounded-full">
                      <span class="ml-2">{{ getTeamName(team.team_id) }}</span>
                    </div>
                  </td>
                  <td class="py-4 px-4">{{ team.played }}</td>
                  <td class="py-4 px-4">{{ team.won }}</td>
                  <td class="py-4 px-4">{{ team.drawn }}</td>
                  <td class="py-4 px-4">{{ team.lost }}</td>
                  <td class="py-4 px-4">{{ team.goals_for }}</td>
                  <td class="py-4 px-4">{{ team.goals_against }}</td>
                  <td class="py-4 px-4">{{ team.goal_difference }}</td>
                  <td class="py-4 px-4">{{ team.points }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </template>
  
<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const teams = ref([]);
const teamNames = ref({});
const teamImg = ref({});
const leagues = ref([]);
const selectedLeague = ref(null);
const DEFAULT_LEAGUE = '';
// Método para obtener los datos de clasificación
const fetchClasification = async () => {
    try {
        const response = await fetch('/clasification');
        const data = await response.json();
        teams.value = data;
    } catch (error) {
        console.error('Error fetching clasification:', error);
    }
};

// Método para obtener los nombres de los equipos
const fetchTeams = async () => {
    try {
        const response = await axios.get('/teams');
        const teamData = response.data;
        teamData.forEach((team) => {
            teamNames.value[team.id] = team.name;
            teamImg.value[team.id] = team.img;
        });
    } catch (error) {
        console.error(error);
    }
};

// Método para obtener la lista de ligas
async function fetchLeagues() {
    try {
        const response = await axios.get('/leagues');
        leagues.value = response.data;
        console.log(leagues.value);
    } catch (error) {
        console.error(error);
    }
}
// Método para obtener el nombre de un equipo por su ID
const getTeamName = (teamId) => {
    return teamNames.value[teamId];
};

const getTeamImage = (teamId) => {
    return teamImg.value[teamId];

};

const filteredTeams = computed(() => {
    if (selectedLeague.value) {
        return teams.value.filter((team) => team.league_id === selectedLeague.value);
    } else {
        return teams.value;
    }
});

onMounted(() => {
    fetchClasification();
    fetchTeams();
    fetchLeagues();
    selectedLeague.value = DEFAULT_LEAGUE;
});
</script>
  