<template>
    <div>
        <a href="/teamLeagues/create" class="create-league-button">Create Relation</a>

      <h1>{{ title }}</h1>
      <select v-model="selectedLeague">
        <option value="">Seleccione una liga</option>
        <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
      </select>
      <table>
        <thead>
          <tr>
            <th>Team</th>
            <th>League</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="teamLeague in filteredTeamsLeagues" :key="teamLeague.id">
            <td>{{ getTeamName(teamLeague.team_id) }}</td>
            <td>{{ getLeagueName(teamLeague.league_id) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, computed } from 'vue';
  import axios from 'axios';
  
  const title = ref('Lista de Equipos');
  const teams = ref([]);
  const leagues = ref([]);
  const teamsLeagues = ref([]);
  const selectedLeague = ref(''); // Set an empty string here
  
  onMounted(() => {
    fetchTeams();
    fetchLeagues();
    fetchTeamsLeagues();
  });
  
  const fetchTeams = async () => {
    try {
      const response = await axios.get('/teams');
      teams.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const fetchLeagues = async () => {
    try {
      const response = await axios.get('/leagues');
      leagues.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const fetchTeamsLeagues = async () => {
    try {
      const response = await axios.get('/teamLeagues');
      teamsLeagues.value = response.data;
    } catch (error) {
      console.error(error);
    }
  };
  
  const getTeamName = teamId => {
    const team = teams.value.find(team => team.id === teamId);
    return team ? team.name : '';
  };
  
  const getLeagueName = leagueId => {
    const league = leagues.value.find(league => league.id === leagueId);
    return league ? league.name : '';
  };
  
  const filteredTeamsLeagues = computed(() => {
    if (!selectedLeague.value) {
      return teamsLeagues.value;
    }
    return teamsLeagues.value.filter(teamLeague => teamLeague.league_id === selectedLeague.value);
  });
  
  
  </script>
<style scoped>
div {
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}
</style>