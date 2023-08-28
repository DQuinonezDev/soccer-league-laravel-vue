<template>
  <div>
    <main class="container">
      <div class="card">
        <div class="card-header bg-primary text-white py-3">
          <h1 class="mb-0">Edit Teams</h1>
        </div>
        <div class="card-body">
          <div v-if="errors.length">
            <!-- ... código para mostrar errores ... -->
          </div>
          <form @submit.prevent="submitForm">
            <!-- ... campos de formulario ... -->
            <div class="d-flex justify-content-end">
              <a href="/" class="btn btn-outline-danger me-2">Cancel</a>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
          <pre>{{ editedTeam }}</pre> <!-- Agrega esta línea -->
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const route = useRoute();
const teamId = route.params.id;
console.log('Extracted team ID:', teamId);

const editedTeam = ref({
    name: '',
    country: '',
    img: ''
});
const errors = ref([]);

onMounted(fetchTeamData);

async function fetchTeamData() {
    try {
        console.log('Fetching team data for ID:', teamId);
        const response = await axios.get(`/teams/${teamId}`);
        console.log('API Response:', response.data);
        editedTeam.name = response.data.name;
        editedTeam.country = response.data.country;
        editedTeam.img = response.data.img;
        console.log('Edited Team Data:', editedTeam.value);
    } catch (error) {
        console.error('Error fetching team data', error);
    }
}
const submitForm = async () => {
    errors.value = [];

    try {
        const response = await fetch(`/teams/${teamId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(editedTeam.value)
        });

        const data = await response.json();

        if (response.ok) {
            console.log('Team updated successfully', data);
            router.push('/'); // Navigate back to the home view
        } else {
            // Handle errors
            if (data.errors) {
                errors.value = Object.values(data.errors).flat();
            }
        }
    } catch (error) {
        console.error('Error submitting form', error);
    }
};
</script>
  
<style scoped>
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    border-radius: 15px 15px 0 0;
}

.alert {
    border-radius: 15px;
}

.btn-outline-danger {
    border-radius: 10px;
}
</style>
  