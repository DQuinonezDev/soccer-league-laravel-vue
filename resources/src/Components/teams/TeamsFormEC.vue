
<template>
    <div class="flex justify-center items-start min-h-screen bg-gray-100 pt-8">
        <main class="w-full max-w-screen-xl  bg-white rounded-lg shadow-md">
            <div class="bg-[#156ff4] text-white py-4 px-6 rounded-t-lg">
                <h1 class="text-4xl font-semibold text-center">{{title}}</h1>
            </div>
            <div class="p-8">
                <form @submit.prevent="submitForm" class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">{{ nameFirstField }}</label>
                        <input v-model="team.name" type="text" name="name" id="name"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded "
                            :placeholder="nameFirstPlace">
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700">{{nameSecondField}}</label>
                        <input v-model="team.country" type="text" name="country" id="country"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded "
                            :placeholder="nameSecondPlace">
                    </div>
                    <div>
                        <label for="img" class="block text-sm font-medium text-gray-700">{{nameThirdField}}</label>
                        <input v-model="team.img" type="text" name="img" id="img"
                            class="w-full px-4 py-2 mt-2 border border-gray-300 rounded   "
                            :placeholder="nameThirdPlace">
                    </div>

                    <div class="flex justify-end">
                        <a href="/"
                            class="px-4 py-2 text-red-500 border border-red-500 rounded mr-2 hover:bg-red-500 hover:text-white">{{btnCancel}}</a>
                        <button type="submit" class="px-4 py-2 bg-[#156ff4] text-white rounded hover:bg-blue-400">{{btnSave}}</button>
                    </div>
                </form>
            </div>
        </main>
</div></template>

<script setup>

const btnSave = ' ';
const btnCancel = ' ';
const nameThirdField = ' ';
const nameThirdPlace = ' ';
const nameSecondField = ' ';
const nameSecondPlace = ' ';
const nameFirstField = ' ';
const nameFirstPlace = ' ';
const title = '';

</script>