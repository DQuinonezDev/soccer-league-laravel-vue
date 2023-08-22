
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import TeamsList from './TeamList.vue';

const teams = ref([]);

onMounted(teamView);

async function teamView() {
  try {
    const response = await axios.get('/teams');
    teams.value = response.data;
  } catch (error) {
    console.error(error);
  }
}

async function deleteTeam(id) {
  try {
    const result = await Swal.fire({
      title: 'Are you sure?',
      text: "The team will never come back!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    });

    if (result.isConfirmed) {
      await axios.delete(`/teams/${id}`);
      teamView();

      Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500,
        icon: 'success',
        title: 'successfully deleted'
      });
    }
  } catch (error) {
    console.error(error);
  }
}
</script>

<template>
  <div class="teams-view">
    <teams-list :teams="teams" @deleteTeam="deleteTeam" />
  </div>
</template>

<style scoped>
.teams-view {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  font-family: Gabarito;
  color: #333;
}
</style>