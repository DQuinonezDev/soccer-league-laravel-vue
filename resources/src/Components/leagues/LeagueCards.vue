<template>
    <div class="team-card">
        <div class="team-card__image">
            <img :src="league.img" alt="Team's Shield" class="team-card__image-content">
        </div>
        <div class="team-card__content">
            <h3 class="team-card__name">{{ league.name }}</h3>
        </div>
        <div class="team-card__actions">
            <a :href="'/leagues/' + league.id + '/edit'" class="team-card__edit-btn"><i class="bi bi-pencil"></i> Edit</a>
            <button @click="deleteLeague(league.id)" class="team-card__delete-btn"><i class="bi bi-trash3-fill"></i>
                Delete</button>
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
.team-card__image {
    position: relative;
    overflow: hidden;
    height: 190px;
    border-radius: 10px 10px 0 0;
}

.team-card__image-content {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.team-card__content {
    padding: 15px;
}

.team-card__name {
    font-size: 20px;
    margin: 0;
    margin-top: 10px;
    color: #333;
    transition: color 0.2s;
}

.team-card__name:hover {
    color: #007bff;
}

.team-card__actions {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    border-top: 1px solid #ddd;
}

.team-card__edit-btn,
.team-card__delete-btn {
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.2s, color 0.2s;
    flex-grow: 1;
    text-align: center;
    margin: 0 5px;
}

.team-card__edit-btn {
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
}

.team-card__edit-btn:hover {
    background-color: #0056b3;
}

.team-card__delete-btn {
    background-color: #dc3545;
    color: #fff;
}

.team-card__delete-btn:hover {
    background-color: #a71d2a;
}

@media screen and (max-width: 768px) {
    .team-cards {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 10px;
    }
}

/* Adjust font sizes and spacing for smaller screens */
@media screen and (max-width: 480px) {


    .team-card__name {
        font-size: 14px;
        margin-top: 5px;
    }

    .team-card__country {
        font-size: 12px;
    }
}
</style>
  