<script setup>

import { ref } from "vue";
import { DataTable } from "primevue";
import { Column } from "primevue";
import { Button } from 'primevue';

const props = defineProps(['fixture', 'teams', 'odds', 'weeklyMatchCount']);


</script>

<template>
    <div class="grid">
        <div class="col-4">
            <h2>Point Table</h2>

            <DataTable :value="props.teams" sortField="points" :sortOrder="-1" stripedRows responsiveLayout="scroll">
                <Column field="name" header="Team"></Column>
                <Column field="points" header="P"></Column>
                <Column field="wins" header="W"></Column>
                <Column field="draws" header="D"></Column>
                <Column field="losses" header="L"></Column>
                <Column header="GD">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.scored - slotProps.data.conceded }}</span>
                    </template>
                </Column>
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

            <DataTable :value="props.odds" stripedRows responsiveLayout="scroll">
                <Column field="team" header="Team"></Column>
                <Column field="odd" header="Percentage"></Column>
            </DataTable>

        </div>

    </div>

</template>
