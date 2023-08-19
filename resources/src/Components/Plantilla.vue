<template >
    <div>
        <h1>Laravel 10 y Vue</h1>
        <hr>
        <h3>{{ title }}</h3>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>País</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="team in teams" :key="team.id">
                    <td>{{ team.name }}</td>
                    <td>{{ team.country }}</td>
                    <td>
                        <a :href="'/teams/' + team.id + '/edit'">Editar</a>
                        <button @click="deleteEquipo(team.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="/teams/create">
            <button>Crear equipo</button>
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>imagen</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="league in league" :key="league.id">
                <td>{{ league.name }}</td>
                <td>{{ league.img }}</td>
                <td>
                    <!-- <a :href="'/equipos/' + equipo.id + '/edit'">Editar</a>
                    <button @click="deleteEquipo(equipo.id)">Eliminar</button> -->
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th>Team</th>
                <th>League</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="teamL in teamsLeagues" :key="teamL.id">
                <td>{{ teamNamesMapping[teamL.team_id] }}</td>
                <td>{{ leagueNamesMapping[teamL.league_id] }}</td>
            </tr>
        </tbody>
    </table>
</template>
  
<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import TeamsView from './Components/TeamsView.vue';

const title = ref('Lista de Equipos');
const teams = ref([]);
const league = ref([]);
const teamsLeagues = ref([]);

onMounted(() => {
    teamsView();
    LeagueView();
    teamsLeagueView();
});

const teamsView = async () => {
    try {
        const response = await axios.get('/teams');
        console.log(response);
        console.log(response.data);
        teams.value = response.data;
    } catch (error) {
        console.error(error);
    }
};


const teamsLeagueView = async () => {
    try {
        const response = await axios.get('/teamLeagues');
        console.log(response);
        console.log(response.data);
        teamsLeagues.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

const LeagueView = async () => {
    try {
        const response = await axios.get('/leagues');
        league.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

const deleteEquipo = async (id) => {
    try {
        await axios.delete(`/teams/${id}`);
        teamsView();
    } catch (error) {
        console.error(error);
    }
};


const teamNamesMapping = computed(() => {
    const mapping = {};
    teams.value.forEach(team => {
        mapping[team.id] = team.name;
    });
    return mapping;
});

const leagueNamesMapping = computed(() => {
    const mapping = {};
    league.value.forEach(league => {
        mapping[league.id] = league.name;
    });
    return mapping;
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
