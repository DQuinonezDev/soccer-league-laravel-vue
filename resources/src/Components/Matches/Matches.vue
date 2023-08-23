<template>
    <div class="matches-container">
      <h1 class="title">Matches</h1>
      <table class="matches-table">
        <thead>
          <tr>
            <th class="match-header">First Match</th>
            <th class="match-header">Second Match</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(match, index) in storedMatches" :key="index" class="match-row">
            <td class="match-cell">
              <div class="team-name">{{ match.ida.home_team_name }}</div>
              <div class="vs">vs</div>
              <div class="team-name">{{ match.ida.away_team_name }}</div>
            </td>
            <td class="match-cell">
              <div class="team-name">{{ match.vuelta.home_team_name }}</div>
              <div class="vs">vs</div>
              <div class="team-name">{{ match.vuelta.away_team_name }}</div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  
  const storedMatches = computed(() => {
    const savedMatches = localStorage.getItem('generatedMatches');
    return savedMatches ? JSON.parse(savedMatches) : [];
  });
  </script>
  
  <style scoped>
  .matches-container {
    text-align: center;
    padding: 20px;
    font-family: Gabarito;
  }
  
  .title {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 30px;
  }
  
  .matches-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 10px;
  }
  
  .match-header {
    font-size: 18px;
    font-weight: bold;
  }
  
  .match-row {
    background-color: #f8f8f8;
    border-radius: 10px;
  }
  
  .match-cell {
    padding: 20px;
    border: 1px solid #ddd;
    text-align: center;
  }
  
  .team-name {
    font-size: 18px;
    font-weight: bold;
  }
  
  .vs {
    font-size: 16px;
    margin: 10px 0;
  }
  </style>
  