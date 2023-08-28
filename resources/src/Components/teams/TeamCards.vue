<template>
    <div class="team-card bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
      <div class="relative h-40 w-full flex items-center justify-center bg-gradient-to-br">
        <img :src="team.img" alt="Team's Shield" class="h-3/4">
      </div>
      <div class="p-4">
        <h3 class="text-xl font-semibold text-gray-800 ">{{ team.name }}</h3>
        <p class="text-gray-500 text-sl">{{ team.country }}</p>
      </div>
      <div class="flex items-center justify-end p-4 border-t border-gray-300">
        <button @click="deleteTeam(team.id)" class="btn-danger">
          Delete
        </button>
        <a :href="'/teams/' + team.id + '/edit'" class="btn-primary ml-2">
          Edit
        </a>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      team: Object,
      deleteTeam: Function
    }
  };
  </script>
  
<style scoped>
.btn-primary {
  @apply bg-blue-500 text-white px-4 py-2 rounded-lg transition-colors duration-300 hover:bg-blue-600;
}

.btn-danger {
  @apply bg-red-500 text-white px-4 py-2 rounded-lg transition-colors duration-300 hover:bg-red-600;
}
.text-gray-500 {
    color: #777;
  }
</style>