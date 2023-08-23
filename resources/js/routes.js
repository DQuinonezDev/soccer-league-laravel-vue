const TeamView = () => import('../src/Components/teams/TeamsView.vue');
const LeagueView = () => import('../src/Components/leagues/LeagueView.vue');
const Relation = () => import('../src/Components/TeamsLeagues/TeamsLeagueView.vue');
const Matches = () => import('../src/Components/Matches/Matches.vue');

export const routes = [
    
    {
        name: 'teamView',
        path: '/',
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
    {
        name: 'matches',
        path: '/matches',
        component: Matches
    },
];

