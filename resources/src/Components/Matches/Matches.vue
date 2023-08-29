<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de partidos por liga</h1>
    <div v-for="league in leagues" :key="league.id" class="mb-6">
      <h2 class="text-xl font-semibold mb-2">{{ league.name }}</h2>
      <ul class="list-disc list-inside ml-6 space-y-2">
        <li v-for="match in getMatchesForLeague(league.id)" :key="match.id">
          {{ getTeamName(match.homeTeam_id) }} vs {{ getTeamName(match.awayTeam_id) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const matches = ref([]);
const teams = ref([]);
const leagues = ref([]);

onMounted(matchesView);

async function matchesView() {
  try {
    const response = await axios.get('/matches');
    matches.value = response.data;
    fetchTeams();
    fetchLeagues(); // Fetch leagues after fetching matches
  } catch (error) {
    console.error(error);
  }
}

async function fetchTeams() {
  try {
    const response = await axios.get('/teams');
    teams.value = response.data;
  } catch (error) {
    console.error(error);
  }
}

async function fetchLeagues() {
  try {
    const response = await axios.get('/leagues');
    leagues.value = response.data;
  } catch (error) {
    console.error(error);
  }
}

const getTeamName = teamId => {
  const team = teams.value.find(team => team.id === teamId);
  return team ? team.name : '';
};


const getTeamNameImg = teamId => {
  const team = teams.value.find(team => team.id === teamId);
  return team ? team.img : '';
};

const getMatchesForLeague = leagueId => {
  return matches.value.filter(match => match.league_id === leagueId);
};
</script>
