<template>
  <div class="bg-gray-100 min-h-screen p-6">
    <div class="mb-4">
      <div class="mb-4">
        <button @click="generateAllResults" :disabled="areAllResultsGenerated || generatingAllResults"
          class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring">
          Generate all results
        </button>
      </div>

      <div class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(match) in sortedMatches" :key="match.id"
            class="bg-white rounded-lg shadow-md p-3 transition-transform duration-300 transform hover:-translate-y-1">


            <div class="mb-4">
              <div class="bg-blue-600 text-white text-center py-1 rounded-md">
                League: {{ getLeagueName(match.league_id) }}
              </div>
              <button @click="openModal(match)" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md">
                Open Modal
              </button>
              <div class="text-[#156ff4] font-semibold">{{ formatTime(match.match_time) }}</div>
            </div>
            <div class="flex justify-between items-center mb-4">
              <div class="flex items-center space-x-4">
                <img :src="getTeamImage(match.homeTeam_id)" alt="Home Team" class="w-12 h-12 object-contain rounded-full">
                <span class="text-lg font-semibold">{{ getTeamName(match.homeTeam_id) }}</span>
              </div>
              <div class="text-gray-500 text-lg">{{ match.home_team_score }} - {{ match.away_team_score }}</div>
              <div class="flex items-center space-x-4">
                <img :src="getTeamImage(match.awayTeam_id)" alt="Away Team" class="w-12 h-12 object-contain rounded-full">
                <span class="text-lg font-semibold">{{ getTeamName(match.awayTeam_id) }}</span>
              </div>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-gray-500 text-sm">{{ getDayOfWeek(match.match_date) }}</span>
              <span class="text-gray-500 text-sm">{{ formatDate(match.match_date, 'MMM dd') }}</span>
            </div>
          </div>
        </div>
      </div>
      <div v-if="selectedMatch" class="fixed inset-0 flex justify-center items-center bg-gray-800 bg-opacity-60">
        <div class="bg-white p-8 rounded-lg shadow-md max-w-screen-2xl">
          <div class="flex items-center justify-between">
            <div class="w-1/5">
              <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                <img :src="getTeamImage(selectedMatch.homeTeam_id)" alt="Home Team" class="w-16 h-16 object-contain">
              </div>
              <p class="text-center mt-2 text-lg font-semibold">{{ getTeamName(selectedMatch.homeTeam_id) }}</p>
            </div>
            <div class="w-3/5 text-center">
              <p class="text-7xl font-semibold">{{ selectedMatch.home_team_score }} - {{ selectedMatch.away_team_score }}
              </p>
              <p class="text-gray-500 mt-2 text-xl">{{ formatDate(selectedMatch.match_date, 'dd MMM yyyy') }}</p>
              <p class="text-gray-500 text-xl">{{ formatTime(selectedMatch.match_time) }}</p>
            </div>
            <div class="w-1/5">
              <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center mx-auto">
                <img :src="getTeamImage(selectedMatch.awayTeam_id)" alt="Away Team" class="w-16 h-16 object-contain">
              </div>
              <p class="text-center mt-2 text-lg font-semibold">{{ getTeamName(selectedMatch.awayTeam_id) }}</p>
            </div>
          </div>
          <div class="text-center text-gray-600 my-4">{{ getLeagueName(selectedMatch.league_id) }}</div>
          <div class="text-center mt-8">
            <button @click="generateRandomResult(selectedMatch.id)" :disabled="isResultGenerated"
              class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring">
              Generate Result
            </button>
            <button @click="selectedMatch = null"
              class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring ml-4">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';

onMounted(() => {
  matchesView();
});

const getLeagueName = leagueId => {
  const league = leagues.value.find(league => league.id === leagueId);
  return league ? league.name : '';
};
const isResultGenerated = computed(() => {
  return selectedMatch.value && selectedMatch.value.resultGenerated;
});


const selectedMatch = ref(null);
const openModal = (match) => {
  selectedMatch.value = match;
};
const matches = ref([]);
const teams = ref([]);
const leagues = ref([]);

const getMatchesForLeagueSortedByDate = (leagueId) => {
  return getMatchesForLeague(leagueId).sort((a, b) => new Date(a.match_date + ' ' + a.match_time) - new Date(b.match_date + ' ' + b.match_time));
};

async function matchesView() {
  try {
    const response = await axios.get('/matches');
    matches.value = response.data.map(match => ({ ...match, resultGenerated: match.home_team_score !== null && match.away_team_score !== null }));
    fetchTeams();
    fetchLeagues();
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
    console.log(leagues.value);
  } catch (error) {
    console.error(error);
  }
}

const getTeamName = teamId => {
  const team = teams.value.find(team => team.id === teamId);
  return team ? team.name : '';
};
const getTeamImage = (teamId) => {
  const team = teams.value.find((team) => team.id === teamId);
  return team ? team.img : '';
};

const formatDate = (date) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric', timeZone: 'UTC' };
  return new Date(date).toLocaleDateString(undefined, options);
};

const convertTo12HourFormat = (time) => {
  const [hours, minutes] = time.split(':');
  const parsedHours = parseInt(hours, 10);
  const period = parsedHours >= 12 ? 'PM' : 'AM';
  const twelveHourFormat = parsedHours % 12 || 12;
  return `${twelveHourFormat}:${minutes} ${period}`;
};

const formatTime = (time) => {
  return convertTo12HourFormat(time);
};

const getDayOfWeek = (date) => {
  const daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
  const dayIndex = new Date(date).getDay();
  return daysOfWeek[dayIndex];
};
const getMatchesForLeague = leagueId => {
  return matches.value.filter(match => match.league_id === leagueId);
};

const generateRandomResult = async (matchId) => {
  try {
    const response = await axios.put(`/matches/${matchId}/generate-result`);
    selectedMatch.value = response.data.match;

    // Actualizar la propiedad resultGenerated en el array matches
    const matchIndex = matches.value.findIndex(match => match.id === matchId);
    if (matchIndex !== -1) {
      matches.value[matchIndex].resultGenerated = true;
    }

    matchesView();
  } catch (error) {
    console.error(error);
  }
};

const sortedMatches = computed(() => {
  // Flatten all matches from all leagues
  const allMatches = leagues.value.flatMap(league => getMatchesForLeagueSortedByDate(league.id));

  // Sort the flattened matches by date
  return allMatches.sort((a, b) => new Date(a.match_date + ' ' + a.match_time) - new Date(b.match_date + ' ' + b.match_time));
});
const areAllResultsGenerated = computed(() => {
  return matches.value.every(match => match.resultGenerated);
});

const generatingAllResults = ref(false);

const generateAllResults = async () => {
  try {
    generatingAllResults.value = true;

    const promises = matches.value
      .filter(match => !match.resultGenerated)
      .map(async match => {
        await generateRandomResult(match.id);
      });

    await Promise.all(promises);

    // Recargar la página después de generar todos los resultados
  } catch (error) {
    console.error(error);
  } finally {
    generatingAllResults.value = false;
  }
};
</script>

<style>
.letra1 {
  font-family: Gabarito;
}
</style>