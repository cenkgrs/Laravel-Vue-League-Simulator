<script setup>

import { ref } from "vue";
import { DataTable } from "primevue";
import { Column } from "primevue";
import { Button } from 'primevue';

const props = defineProps(['fixture', 'teams', 'weeklyMatchCount']);

console.log(props);

</script>

<template>
    <div class="grid">
        <div class="col-4">
            <h2>Point Table</h2>

            <DataTable :value="props.teams" stripedRows responsiveLayout="scroll">
                <Column field="name" header="Team"></Column>
                <Column field="points" header="P"></Column>
                <Column field="scored" header="S"></Column>
                <Column field="conceded" header="C"></Column>
            </DataTable>

        </div>
        <div class="col-4">

            <h2>Fixture</h2>

            <DataTable :value="props.fixture" stripedRows responsiveLayout="scroll">
                <Column header="Home Team">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.homeTeam.name }}</span>
                    </template>
                </Column>
                <Column header="Away Team">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.awayTeam.name }}</span>
                    </template>
                </Column>
                <Column header="Score">
                    <template #body="slotProps">
                        <span v-if="slotProps.data.played">{{ slotProps.data.homeScore + " - "  + slotProps.data.awayScore }}</span>
                        <span v-else>{{ " - "  }}</span>
                    </template>
                </Column>
            </DataTable>

        </div>

        <div class="col-4">

            <h2>Prediction of Championship</h2>

            <DataTable :value="props.fixtures" stripedRows responsiveLayout="scroll">
                <Column field="homeTeam" header="Home Team"></Column>
                <Column field="awayTeam" header="Away Team"></Column>
                <Column>
                    <template #body="slotProps">
                        <span v-if="slotProps.data.played">{{ slotProps.data.homeScore + " - "  + slotProps.data.awayScore }}</span>
                        <span v-if="slotProps.data.played">{{ " - "  }}</span>
                    </template>
                </Column>
            </DataTable>

        </div>
        
    </div>
   
</template>