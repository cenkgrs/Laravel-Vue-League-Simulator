<script setup>
import { ref } from 'vue'

import LeagueFixture from './LeagueFixture.vue'
import LeagueStarter from './LeagueStarter.vue'
import axios from "axios";

const started = ref(false);

const teams = ref([]);
const fixture = ref([]);
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
            weeklyMatchCount.value = response.data.weeklyMatchCount;

            console.log(fixture.value);
        }
    );
}

</script>

<template>
    <div class="m-8">

        <LeagueStarter v-if="!started" @started="start" />

        <LeagueFixture v-else :fixture="fixture" :teams="teams" :weeklyMatchCount="weeklyMatchCount"/>
    </div>
</template>
