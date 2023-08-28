<template>
  <div class="bg-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Matches</h1>
    <div class="overflow-x-auto">
      <table class="min-w-full border rounded-lg overflow-hidden">
        <thead class="bg-blue-500 text-white">
          <tr>
            <th class="py-4 px-6 text-lg font-semibold text-left">League</th>
            <th class="py-4 px-6 text-lg font-semibold text-center">First Match</th>
            <th class="py-4 px-6 text-lg font-semibold text-center">Second Match</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(match, index) in storedMatches" :key="index" class="bg-white">
            <td class="py-6 px-6 border-b">
              <div class="text-lg font-semibold text-gray-800">{{ match.league_name }}</div>
            </td>
            <td class="py-6 px-6 border-b">
              <div class="flex items-center justify-center space-x-4">
                <div class="text-xl font-semibold text-blue-600">{{ match.ida.home_team_name }}</div>
                <div class="text-base text-gray-600">vs</div>
                <div class="text-xl font-semibold text-blue-600">{{ match.ida.away_team_name }}</div>
              </div>
            </td>
            <td class="py-6 px-6 border-b">
              <div class="flex items-center justify-center space-x-4">
                <div class="text-xl font-semibold text-blue-600">{{ match.vuelta.home_team_name }}</div>
                <div class="text-base text-gray-600">vs</div>
                <div class="text-xl font-semibold text-blue-600">{{ match.vuelta.away_team_name }}</div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>




<script setup>
import { computed } from 'vue';

const storedMatches = computed(() => {
  const allMatches = [];

  for (let i = 0; i < localStorage.length; i++) {
    const key = localStorage.key(i);
    if (key.includes('generatedMatches')) {
      const savedMatches = localStorage.getItem(key);
      const matches = savedMatches ? JSON.parse(savedMatches) : [];
      const leagueId = key.replace('generatedMatches', ''); // Extract league ID from the key
      const leagueName = getLeagueName(leagueId);
      const matchesWithLeagueName = matches.map(match => ({
        ...match,
        league_name: leagueName // Add league name to each match
      }));
      allMatches.push(...matchesWithLeagueName);
    }
  }

  return allMatches;
});

const leagues = [
  { id: 1, name: 'Liga A' },
  { id: 2, name: 'Liga B' },
  { id: 3, name: 'Liga C' },
  // ... (agregar más ligas si es necesario)
];

const getLeagueName = leagueId => {
  const league = leagues.find(league => league.id === parseInt(leagueId));
  return league ? league.name : '';
};
</script>

