const TeamView = () => import('../src/Components/teams/TeamsView.vue');
const LeagueView = () => import('../src/Components/leagues/LeagueView.vue');
const Relation = () => import('../src/Components/TeamsLeagues/TeamsLeagueView.vue');
const Matches = () => import('../src/Components/Matches/Matches.vue');
const CreateTeams = () => import('../src/Components/teams/CreateTeams.vue');
const EditTeams = () => import('../src/Components/teams/EditTeams.vue');
const Clasification= () => import('../src/Components/Clasification/ClasificactionView.vue');


import { createRouter, createWebHistory } from 'vue-router';

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
        path: '/matchess',
        component: Matches
    },
    {
        name: 'createTeams',
        path: '/createTeams',
        component: CreateTeams
    },
    {
        name: 'editTeams',
        path: '/teams/:id/edit',
        component: EditTeams,
        props: true
    },
    {
        name: 'clasicationTable',
        path: '/clasificarionTable',
        component: Clasification
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes
  });