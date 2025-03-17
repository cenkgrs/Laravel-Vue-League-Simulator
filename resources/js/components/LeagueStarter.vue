<script setup>


import Card from 'primevue/card';
import { ref } from "vue";

import InputText from 'primevue/inputtext';
import { Button } from "primevue";
import { Message } from 'primevue';
import axios from "axios";

const teamList = ref([]);
const teamName = ref('');

const message = ref('');

const emit = defineEmits(["started"]);

const addTeam = () => {
    teamList.value.push(teamName.value);
    teamName.value = '';
}

const prepareLeague = () => {
    
    if (teamList.value.length < 4) {
        message.value = 'Please enter at leats 4 teams';

        setTimeout(function () {
            message.value = '';
        }, 3000)

        return false;
    }

    if (teamList.value.length % 2 !== 0) {
        message.value = 'Please enter an even number of teams';

        setTimeout(function () {
            message.value = '';
        }, 3000)

        return false;
    }

    // Send request
    axios.post('/prepare-league', { "teams": teamList.value }).then(
        response => (
            emit('started', true))
    );
}
</script>


<template>
    <Card>
        <template #title class="text-center">
            <div class="text-center">Championship League</div>
        </template>
        <template #content>

            <Message v-if="message" severity="success" :life="3000">{{ message }}</Message>


            <div class="grid mt-5">


                <div class="col-6">
                    <div class="flex flex-col gap-4 w-full">
                        <div class="flex flex-col gap-1">
                            <InputText name="username" type="text" placeholder="Team Name" v-model="teamName" />
                        </div>
                        <Button severity="success" label="Add Team" @click="addTeam()" />
                    </div>
                </div>
                <div class="col-6">
                    <p class="mb-5">Teams</p>

                    <div v-for="team in teamList">
                        <p>{{ team }}</p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <Button severity="info" label="Create League" @click="prepareLeague()" />
            </div>


        </template>
    </Card>
</template>
