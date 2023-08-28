<template>
    <main>

        <nav class="border-gray-200  bg-gray-50 dark:bg-[#156ff4] dark:border-gray-700">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-8">
                <a href="#" class="flex items-center">
                    <img src="https://static.thenounproject.com/png/14032-200.png" alt="Football Logo" width="30"
                        height="30" class="d-inline-block align-top">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Soccer Control</span>
                </a>
                <button data-collapse-toggle="navbar-solid-bg" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-blue-500 dark:focus:ring-blue-600"
                    aria-controls="navbar-solid-bg" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                    <ul
                        class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent dark:bg-blue-500 md:dark:bg-transparent dark:border-gray-700">
                        <li>
                            <router-link :to="{ name: 'teamView' }" class="block py-2 pl-3
                     pr-4
                      text-white  rounded md:bg-transparent
                        md:p-0  md:dark:bg-transparent md:hover:text-[#ffd363] dark:hover:bg-blue-800"
                                >Teams</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'leagueView' }" class="block py-2 pl-3 pr-4 text-gray-900 rounded
                     hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#ffd363] md:p-0
                      dark:text-white  dark:hover:bg-blue-800
                       dark:hover:text-white md:dark:hover:bg-transparent">Leagues</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'teamLeagueView' }" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0
                            md:hover:text-[#ffd363]  md:p-0 dark:text-white dark:hover:bg-blue-800
                      dark:hover:text-white md:dark:hover:bg-transparent">Relation</router-link>
                        </li>
                        <li>
                            <a href="/matches" class="block py-2 pl-3 pr-4 text-gray-900 rounded
                              hover:bg-gray-100 md:hover:bg-transparent md:border-0  md:p-0 dark:text-white md:hover:text-[#ffd363] dark:hover:bg-blue-800
                                dark:hover:text-white md:dark:hover:bg-transparent">Matches</a>
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
