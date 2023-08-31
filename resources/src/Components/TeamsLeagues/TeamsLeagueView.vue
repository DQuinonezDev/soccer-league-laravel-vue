<template>
  <div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
      <div class="bg-white rounded-lg shadow-md p-6 space-y-6">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold text-gray-800">{{ title }}</h1>
          <a href="/teamLeagues/create"
            class="bg-blue-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-600 transition">Create
            Relation</a>
        </div>

        <div class="flex items-center space-x-4">
          <select v-model="selectedLeague" @change="matchesView"
            class="w-64 py-2 px-4 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-600">
            <option value="">Select a league</option>
            <option v-for="league in leagues" :key="league.id" :value="league.id">{{ league.name }}</option>
          </select>
          <div class="flex items-center space-x-4" v-if="selectedLeague">
            <button @click="generateMatches"
              class="bg-green-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-green-600 transition">Generate Matches</button>
          </div>
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
            <tr v-for="teamLeague in teamsLeaguesInSelectedLeague" :key="teamLeague.id">
              <td class="py-4 px-6 border-b">{{ getTeamName(teamLeague.team_id) }}</td>
              <td v-if="!selectedLeague" class="py-4 px-6 border-b">{{ getLeagueName(teamLeague.league_id) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted, computed} from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2/dist/sweetalert2.js';

const title = ref('List of teams in leagues');
const leagues = ref([]);
const selectedLeague = ref('');
const generatedMatches = ref([]);
const teams = ref([]); // Define teams
const teamsLeagues = ref([]); // Define teamsLeagues

onMounted(() => {
  leaguesView();
  matchesView();
  teamsLeagueView();
  teamsView();
});

const teamsLeaguesInSelectedLeague = computed(() => {
  if (selectedLeague.value) {
    return teamsLeagues.value.filter(teamLeague => teamLeague.league_id === selectedLeague.value);
  } else {
    return teamsLeagues.value;
  }
});

const teamsLeagueView = async () => {
  try {
    const response = await axios.get('/teamLeagues');
    teamsLeagues.value = response.data;
  } catch (error) {
    console.error(error);
  }
};
const leaguesView = async () => {
  try {
    const response = await axios.get('/leagues');
    leagues.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

const teamsView = async () => {
  try {
    const response = await axios.get('/teams'); 
    teams.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

const matchesView = async () => {
  try {
    const response = await axios.get('/matches');
    const matches = response.data.map(match => ({
      ida: {
        home_team_name: getTeamName(match.homeTeam_id),
        away_team_name: getTeamName(match.awayTeam_id)
      },
      vuelta: {
        home_team_name: getTeamName(match.awayTeam_id),
        away_team_name: getTeamName(match.homeTeam_id)
      }
    }));
    generatedMatches.value = matches;
  } catch (error) {
    console.error(error);
  }
};

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

const getLeagueName = leagueId => {
  const league = leagues.value.find(league => league.id === leagueId);
  return league ? league.name : '';
};

const showSuccessSwal = () => {
  Toast.fire({
    icon: 'success',
    title: 'Matches created successfully'
  })
};
const showErrorSwal = () => {
  Swal.fire({
    icon: 'info',
    title: 'Matches Already Generated',
    text: 'Matches have already been generated for this league.',
    confirmButtonText: 'OK'
  });
};

const getTeamName = teamId => {
  const team = teams.value.find(team => team.id === teamId);
  return team ? team.name : '';
};

const generateMatches = async () => {
  if (selectedLeague.value) {
    try {
      await axios.post(`/matches/generate/${selectedLeague.value}`);
      await matchesView();
      showSuccessSwal();
    } catch (error) {
      console.error(error);
      showErrorSwal();
    }
  }
};

</script>