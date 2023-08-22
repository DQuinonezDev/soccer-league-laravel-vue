<template>
  <div>
    <a href="/teamLeagues/create" class="create-league-button">Create Relation</a>

    <h1>{{ title }}</h1>
    <select v-model="selectedLeague" @change="updateFilteredTeams">
      <option value="">Seleccione una liga</option>
      <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
    </select>
    <button v-if="selectedLeague" @click="createRandomMatches">Crear Partidos Aleatorios</button>
    <table>
      <thead>
        <tr>
          <th>Team</th>
          <th v-if="!selectedLeague">League</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="teamLeague in filteredTeamsLeagues" :key="teamLeague.id">
          <td>{{ getTeamName(teamLeague.team_id) }}</td>
          <td v-if="!selectedLeague">{{ getLeagueName(teamLeague.league_id) }}</td>
        </tr>
      </tbody>
    </table>
    <h2>Partidos Generados</h2>
    <table>
      <thead>
        <tr>
          <th>Ida</th>
          <th>Vuelta</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(match, index) in generatedMatches" :key="index">
          <td>{{ match.ida.home_team_name }} - {{ match.ida.away_team_name }}</td>
          <td>{{ match.vuelta.home_team_name }} - {{ match.vuelta.away_team_name }}</td>
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
const selectedLeague = ref('');
const generatedMatches = ref([]);

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

const updateFilteredTeams = () => {
  // No es necesario realizar ningún filtrado manual aquí.
  // La propiedad computed filteredTeamsLeagues se actualizará automáticamente.
};

const filteredTeamsLeagues = computed(() => {
  if (!selectedLeague.value) {
    return teamsLeagues.value;
  }
  return teamsLeagues.value.filter(teamLeague => teamLeague.league_id === selectedLeague.value);
});
const createRandomMatches = () => {
  const teamsInSelectedLeague = teamsLeagues.value
    .filter(teamLeague => teamLeague.league_id === selectedLeague.value)
    .map(teamLeague => teamLeague.team_id);

  const matches = [];

  for (let i = 0; i < teamsInSelectedLeague.length; i++) {
    for (let j = i + 1; j < teamsInSelectedLeague.length; j++) {
      const matchIda = {
        home_team_name: getTeamName(teamsInSelectedLeague[i]),
        away_team_name: getTeamName(teamsInSelectedLeague[j])
      };

      const matchVuelta = {
        home_team_name: getTeamName(teamsInSelectedLeague[j]),
        away_team_name: getTeamName(teamsInSelectedLeague[i])
      };

      matches.push({ ida: matchIda, vuelta: matchVuelta });
    }
  }

  // Asignar los partidos generados a la referencia generatedMatches
  generatedMatches.value = matches;

  console.log('Partidos generados:', generatedMatches.value);
};
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
