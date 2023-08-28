<template>
  <div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
      <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-800">{{ title }}</h1>
          <a href="/teamLeagues/create" class="bg-blue-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Create Relation</a>
        </div>

        <div class="flex items-center space-x-4">
          <select v-model="selectedLeague" @change="updateFilteredTeams" class="w-64 py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-600">
            <option value="">Select a league</option>
            <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
          </select>
          <button v-if="selectedLeague && !hasGeneratedMatches[selectedLeague]" @click="createRandomMatches" class="bg-green-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-green-600 transition">Create Matches</button>
          <button v-if="hasGeneratedMatches[selectedLeague]" @click="saveMatchesToLocal" class="bg-indigo-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-indigo-600 transition">Save Matches</button>
        </div>
      </div>

      <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-6 text-left font-semibold text-gray-700">Team</th>
              <th v-if="!selectedLeague" class="py-3 px-6 text-left font-semibold text-gray-700">League</th>
            </tr>
          </thead>
          <tbody class="text-gray-600">
            <tr v-for="teamLeague in filteredTeamsLeagues" :key="teamLeague.id">
              <td class="py-4 px-6 border-b">{{ getTeamName(teamLeague.team_id) }}</td>
              <td v-if="!selectedLeague" class="py-4 px-6 border-b">{{ getLeagueName(teamLeague.league_id) }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <h2 class="text-2xl font-bold text-gray-800 mt-8">Matches</h2>

      <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-6 text-left font-semibold text-gray-700">First Match</th>
              <th class="py-3 px-6 text-left font-semibold text-gray-700">Second Match</th>
            </tr>
          </thead>
          <tbody class="text-gray-600">
            <tr v-for="(match, index) in generatedMatches" :key="index">
              <td class="py-4 px-6 border-b">{{ match.ida.home_team_name }} - {{ match.ida.away_team_name }}</td>
              <td class="py-4 px-6 border-b">{{ match.vuelta.home_team_name }} - {{ match.vuelta.away_team_name }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

const title = ref('Lista de Equiposs');
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
  savedMatches.push(...generatedMatches.value.map(match => ({ ...match, league_id: selectedLeagueId })));

  localStorage.setItem(matchesKey, JSON.stringify(savedMatches));
  console.log('Partidos guardados en localStorage para la liga:', selectedLeagueId);

  hasGeneratedMatches.value[selectedLeagueId] = true;
};
const loadMatchesFromLocalStorage = (leagueId) => {
  const matchesKey = `generatedMatches${leagueId}`;
  const savedMatches = localStorage.getItem(matchesKey);
  return savedMatches ? JSON.parse(savedMatches) : [];
};

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

  const savedMatches = loadMatchesFromLocalStorage(selectedLeagueId) || [];
  savedMatches.push(...matches);

  localStorage.setItem(`generatedMatches${selectedLeagueId}`, JSON.stringify(savedMatches));
  generatedMatches.value = savedMatches;

  console.log('Partidos generados y guardados:', generatedMatches.value);

  hasGeneratedMatches.value[selectedLeagueId] = true;
};
</script>

<style scoped>
.container {
  padding: 1.5rem;
}

.create-league-button {
  transition: background-color 0.2s ease;
}

.create-league-button:hover {
  background-color: #2563eb;
}

.league-select {
  padding: 0.5rem;
  border: 1px solid #e2e8f0;
  border-radius: 0.375rem;
  font-size: 1rem;
}

.action-button {
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: background-color 0.2s ease;
  font-weight: bold;
}

.action-button:hover {
  filter: brightness(90%);
}


.data-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1.5rem;
}

.data-table th,
.data-table td {
  border: 1px solid #e2e8f0;
  padding: 1rem;
  text-align: left;
  font-size: 1rem;
  background-color: #f7fafc;
}

.data-table th {
  font-weight: bold;
}

h2 {
  font-size: 1.5rem;
  font-weight: bold;
  margin-top: 2rem;
  margin-bottom: 1.5rem;
  color: #333;
}
</style>