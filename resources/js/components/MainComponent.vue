<script setup>
import { ref } from 'vue'

import LeagueFixture from './LeagueFixture.vue'
import LeagueStarter from './LeagueStarter.vue'

const started = ref(false);

</script>

<template>
    <div class="m-8">

        <LeagueStarter v-if="!started" />

        <LeagueFixture v-else />
    </div>
</template>
