<template>
    <div class="league-fixture">
        <h2>League Fixtures</h2>

        <DataTable :value="fixtures" stripedRows responsiveLayout="scroll">
            <Column field="matchday" header="Matchday"></Column>
            <Column field="homeTeam" header="Home Team"></Column>
            <Column field="awayTeam" header="Away Team"></Column>
            <Column field="date" header="Date"></Column>
            <Column field="time" header="Time"></Column>
            <Column>
                <template #body="slotProps">
                    <Button label="Details" icon="pi pi-search" class="p-button-sm p-button-outlined"
                        @click="viewDetails(slotProps.data)" />
                </template>
            </Column>
        </DataTable>

        <Dialog v-model:visible="showDialog" header="Match Details" :modal="true" :closable="true">
            <div v-if="selectedFixture">
                <p><strong>Matchday:</strong> {{ selectedFixture.matchday }}</p>
                <p><strong>Home Team:</strong> {{ selectedFixture.homeTeam }}</p>
                <p><strong>Away Team:</strong> {{ selectedFixture.awayTeam }}</p>
                <p><strong>Date:</strong> {{ selectedFixture.date }}</p>
                <p><strong>Time:</strong> {{ selectedFixture.time }}</p>
            </div>
        </Dialog>
    </div>
</template>
  
<script setup>
import { ref } from "vue";
import { DataTable } from "primevue";
import { Column } from "primevue";
import { Dialog } from "primevue";
import { Button } from 'primevue';


const fixtures = ref([
    { matchday: 1, homeTeam: "Team A", awayTeam: "Team B", date: "2025-04-10", time: "18:00" },
    { matchday: 1, homeTeam: "Team C", awayTeam: "Team D", date: "2025-04-11", time: "20:00" },
    { matchday: 2, homeTeam: "Team A", awayTeam: "Team C", date: "2025-04-17", time: "19:00" },
]);

const showDialog = ref(false);
const selectedFixture = ref(null);

const viewDetails = (fixture) => {
    selectedFixture.value = fixture;
    showDialog.value = true;
};

</script>
  
<style scoped>
.league-fixture {
    padding: 20px;
}
</style>
  