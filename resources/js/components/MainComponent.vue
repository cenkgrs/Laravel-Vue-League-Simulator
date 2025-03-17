<script setup>
import { ref } from 'vue'

import LeagueFixture from './LeagueFixture.vue'
import LeagueStarter from './LeagueStarter.vue'
import axios from "axios";
import {Button} from "primevue";

const started = ref(false);

const teams = ref([]);
const fixture = ref([]);
const odds = ref([]);
const weeklyMatchCount = ref(0);

const start = async () => {

    await getFixture();

    started.value = true;
}

const getFixture = () => {

    axios.get('get-fixture').then(
        response => {
            teams.value = response.data.teams;
            fixture.value = response.data.matches;
            odds.value = response.data.odds;
            weeklyMatchCount.value = response.data.weeklyMatchCount;
        }
    );
}

const simulateWeek = () => {

    axios.get('simulate-week').then(
        response => {
            teams.value = response.data.teams;
            fixture.value = response.data.matches;
            odds.value = response.data.odds;
            weeklyMatchCount.value = response.data.weeklyMatchCount;
        }
    );
}

const resetLeague = () => {

    axios.get('reset-league').then(
        response => {
            teams.value = response.data.teams;
            fixture.value = response.data.matches;
            odds.value = response.data.odds;
            weeklyMatchCount.value = response.data.weeklyMatchCount;
        }
    );
}

</script>

<template>
    <div class="m-8">

        <LeagueStarter v-if="!started" @started="start" />

        <template v-else>
            <LeagueFixture :fixture="fixture" :teams="teams" :odds="odds" :weeklyMatchCount="weeklyMatchCount"/>

            <div  class="grid mt-8 flex gap-3 justify-content-center">
                <Button severity="info" label="Simulate League" @click="simulateLeague()"/>
                <Button label="Simulate Week" @click="simulateWeek()"/>
                <Button severity="danger" label="Reset League" @click="resetLeague()"/>
            </div>
        </template>


    </div>
</template>
