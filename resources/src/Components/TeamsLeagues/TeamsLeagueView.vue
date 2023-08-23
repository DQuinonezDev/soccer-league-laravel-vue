<template>
  <div class="container">
    <div class="header">
      <h1 class="title"></h1>
      <a href="/teamLeagues/create" class="create-league-button">Create Relation</a>
    </div>

    <div class="filter-container">
      <select v-model="selectedLeague" @change="updateFilteredTeams" class="league-select">
        <option value="">Select a league</option>
        <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
      </select>
      <button v-if="selectedLeague && !hasGeneratedMatches[selectedLeague]" @click="createRandomMatches" class="action-button">
        Create Matches
      </button>
      <button v-if="hasGeneratedMatches[selectedLeague]" @click="saveMatchesToLocal" class="action-button">
        Save Matches
      </button>
    </div>

    <div class="table-container">
      <table class="data-table">
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
    </div>

    <h2>Matches</h2>

    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>first Match</th>
            <th>Second Match</th>
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
const hasGeneratedMatches = ref({});

const saveMatchesToLocal = () => {
  const selectedLeagueId = selectedLeague.value;
  const matchesKey = `generatedMatches${selectedLeagueId}`;

  const savedMatches = localStorage.getItem(matchesKey) ? JSON.parse(localStorage.getItem(matchesKey)) : [];
  savedMatches.push(...generatedMatches.value);

  localStorage.setItem(matchesKey, JSON.stringify(savedMatches));
  console.log('Partidos guardados en localStorage para la liga:', selectedLeagueId);

  hasGeneratedMatches.value[selectedLeagueId] = true;
}

const loadMatchesFromLocalStorage = (leagueId) => {
  const matchesKey = `generatedMatches${leagueId}`;
  const savedMatches = localStorage.getItem(matchesKey);
  return savedMatches ? JSON.parse(savedMatches) : [];
}

onMounted(() => {
  fetchTeams();
  fetchLeagues();
  fetchTeamsLeagues();

  for (const league of leagues.value) {
    hasGeneratedMatches.value[league.id] = loadMatchesFromLocalStorage(league.id).length > 0;
  }

  const savedMatches = loadMatchesFromLocalStorage(selectedLeague.value);
  generatedMatches.value = savedMatches;
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
  const selectedLeagueId = selectedLeague.value;
  const teamsInSelectedLeague = teamsLeagues.value
    .filter(teamLeague => teamLeague.league_id === selectedLeagueId)
    .map(teamLeague => teamLeague.team_id);

  const matches = [];

  for (let i = 0; i < teamsInSelectedLeague.length; i++) {
    for (let j = i + 1; j < teamsInSelectedLeague.length; j++) {
      const matchIda = {
        home_team_name: getTeamName(teamsInSelectedLeague[i]),
        away_team_name: getTeamName(teamsInSelectedLeague[j]),
        league_id: selectedLeagueId
      };

      const matchVuelta = {
        home_team_name: getTeamName(teamsInSelectedLeague[j]),
        away_team_name: getTeamName(teamsInSelectedLeague[i]),
        league_id: selectedLeagueId
      };

      matches.push({ ida: matchIda, vuelta: matchVuelta });
    }
  }

  const savedMatches = loadMatchesFromLocalStorage('all') || [];
  savedMatches.push(...matches);

  localStorage.setItem('generatedMatches', JSON.stringify(savedMatches));
  generatedMatches.value = savedMatches;

  console.log('Partidos generados y guardados:', generatedMatches.value);

  hasGeneratedMatches.value[selectedLeagueId] = true;
};
</script>
<style scoped>
.container {
  text-align: center;
  padding: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.title {
  font-size: 32px;
  font-weight: bold;
  color: #333;
}

.create-league-button {
  background-color: #ff7f50;
  color: white;
  font-weight: bold;
  padding: 12px 24px;
  border-radius: 8px;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.create-league-button:hover {
  background-color: #ff6347;
}

.filter-container {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 24px;
}

.league-select {
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-right: 12px;
  font-size: 18px;
  font-family: Gabarito1;
}

.action-button {
  background-color: #4caf50;
  color: white;
  font-weight: bold;
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.action-button:hover {
  background-color: #45a049;
}

.data-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  font-family: Gabarito1;
}

.data-table th,
.data-table td {
  border: 1px solid #ccc;
  padding: 12px;
  text-align: left;
  font-size: 16px;
  background-color: #f2f2f2;
}

.data-table th {
  font-weight: bold;
}

h2 {
  font-size: 26px;
  font-weight: bold;
  margin-top: 30px;
  margin-bottom: 18px;
  color: #333;
}
</style>