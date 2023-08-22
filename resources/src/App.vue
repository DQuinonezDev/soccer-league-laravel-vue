<template>
    <NavBar />
    <!-- <TeamsView />
    <LeaguesView />
    <TeamsLeagueView /> -->
</template>

<script setup>
import TeamsView from './Components/teams/TeamsView.vue';
import LeaguesView from './Components/leagues/LeagueView.vue';
import '../css/app.css'
import TeamsLeagueView from './Components/TeamsLeagues/TeamsLeagueView.vue';
import NavBar from './Components/navbar/NavBar.vue';


</script>

<style scoped>
div {
    text-align: center;
}
</style>
