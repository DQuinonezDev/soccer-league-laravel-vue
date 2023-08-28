<template>
    <div class="flex justify-center items-start min-h-screen bg-gray-100 pt-8">
        <main class="w-full max-w-screen-xl  bg-white rounded-lg shadow-md">
            <div class="bg-[#156ff4] text-white py-4 px-6 rounded-t-lg">
                <h1 class="text-4xl font-semibold text-center">Create a soccer team</h1>
            </div>
            <div class="p-8">
                <form @submit.prevent="submitForm" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name of the team</label>
                        <input v-model="team.name" type="text" name="name" id="name"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded "
                            placeholder="Insert the name of the team">
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                        <input v-model="team.country" type="text" name="country" id="country"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded "
                            placeholder="Insert the country of the team">
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium text-gray-700">URL of the team</label>
                        <input v-model="team.img" type="text" name="img" id="img"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded   "
                            placeholder="Insert the URL of the logo of the team">
                    </div>

                    <div class="flex justify-end">
                        <a href="/"
                            class="px-4 py-2 text-red-500 border border-red-500 rounded mr-2 hover:bg-red-500 hover:text-white">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-[#156ff4] text-white rounded hover:bg-blue-400">Guardar
                            Equipo</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</template>
  
  
<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const btnSave = ' ';
const btnCancel = ' ';
const nameThirdField = ' ';
const nameThirdPlace = ' ';
const nameSecondField = ' ';
const nameSecondPlace = ' ';
const nameFirstField = ' ';
const nameFirstPlace = ' ';
const title = '';

const team = ref({
    name: '',
    country: '',
    img: ''
});
const errors = ref([]);

const submitForm = async () => {
    errors.value = [];

    try {
        const response = await fetch('/teams', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(team.value)
        });

        const data = await response.json();

        if (response.ok) {
            console.log('Team created successfully', data);
            team.value = {
                name: '',
                country: '',
                img: ''
            };

            router.push('/');
        } else {
            if (data.errors) {
                errors.value = Object.values(data.errors).flat();
            }
        }
    } catch (error) {
        console.error('Error submitting form', error);
    }
};
</script>