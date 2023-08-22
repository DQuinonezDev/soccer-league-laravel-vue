const TeamView = () => import('../src/Components/teams/TeamsView.vue');
const LeagueView = () => import('../src/Components/leagues/LeagueView.vue');
const Home = () => import('../src/Components/principal/Home.vue');
const Relation = () => import('../src/Components/TeamsLeagues/TeamsLeagueView.vue');

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'teamView',
        path: '/teamsList',
        component: TeamView
    },
    {
        name: 'leagueView',
        path: '/leaguesView',
        component: LeagueView
    },
    {
        name: 'teamLeagueView',
        path: '/leagueTeams',
        component: Relation
    },
];

