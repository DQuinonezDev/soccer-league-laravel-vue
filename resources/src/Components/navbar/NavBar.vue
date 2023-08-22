<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="https://static.thenounproject.com/png/14032-200.png" alt="Football Logo" width="30"
                        height="30" class="d-inline-block align-top">
                    Soccer Control
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'teamView' }" class="nav-link">Teams</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'leagueView' }" class="nav-link">Leagues</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'teamLeagueView' }" class="nav-link">Relation</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Leagues
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Liga 1</a></li>
                                <li><a class="dropdown-item" href="#">Liga 2</a></li>
                                <li><a class="dropdown-item" href="#">Liga 3</a></li>
                                <!-- Agrega más ligas si es necesario -->
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Matches</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div>
            <router-view></router-view>
        </div>

    </main>
</template>

<script>

</script>

<style scoped>
.navbar {
    background-color: #212529;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    padding: 21px;
    font-family: Gabarito1;
}

.navbar-toggler-icon {
    background-color: #fff;
}

.navbar-nav .nav-item .nav-link {
    color: #fff;
    transition: color 0.3s ease-in-out;
    font-weight: 500;
}

.navbar-nav .nav-item .nav-link:hover {
    color: #ffd700;
}

.navbar-nav .nav-item .dropdown-menu {
    background-color: #212529;
    border: none;
    animation: fade-in 0.3s ease;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.navbar-nav .nav-item .dropdown-item {
    color: #fff;
    transition: background-color 0.3s ease-in-out;
    font-weight: 400;
}

.navbar-nav .nav-item .dropdown-item:hover {
    background-color: #343a40;
}

.btn-outline-light {
    border-color: #fff;
    color: #fff;
    transition: background-color 0.3s ease-in-out, border-color 0.3s ease-in-out, color 0.3s ease-in-out;
    font-weight: 500;
}

.btn-outline-light:hover {
    background-color: #fff;
    color: #212529;
}
</style>
