<template>
    <div class="bg-white rounded-lg shadow-md overflow-hidden ">
      <div class="aspect-w-16 aspect-h-9 justify-center flex">
        <img :src="league.img" alt="Team's Shield" class="object-cover">
      </div>
      <div class="p-4">
        <h3 class="text-xl font-semibold text-center text-gray-800">{{ league.name }}</h3>
      </div>
      <div class="flex items-center justify-center p-3 bg-gray-100 rounded-b-lg">
        <a :href="'/leagues/' + league.id + '/edit'" class="btn btn-primary btn-lg">
          Edit
        </a>
        <button @click="deleteLeague(league.id)" class="btn btn-danger btn-lg ml-2">
          Delete
        </button>
      </div>
    </div>
  </template>
  
<script>
export default {
    props: {
        league: Object,
        deleteLeague: Function
    }
};
</script>

<style scoped>
.btn {
  padding: 0.75rem 1.5rem;
  border-radius: 0.25rem;
  font-size: 0.875rem;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s, transform 0.2s, box-shadow 0.2s;
  display: inline-flex;
  align-items: center;
  border: 1px solid transparent;
}

.btn-lg {
  padding: 1rem 2rem;
  font-size: 1rem;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  text-decoration: none;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.btn-danger {
  background-color: #dc3545;
  color: #fff;
  border-color: #dc3545;
}

.btn-danger:hover {
  background-color: #a71d2a;
}

/* Adjust hover effect for buttons */
.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

</style>