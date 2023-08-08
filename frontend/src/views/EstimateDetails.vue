<script setup>
import TitleComponent from "@/components/TitleComponent.vue";
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import { useEstimateStore } from "@/stores/EstimateStore.js";

const route = useRoute();
const store = useEstimateStore();

onMounted(async () => {
  const id = route.params.id;
  await store.fetchEstimate(id);
});
</script>

<template>
  <TitleComponent title="Résultat de l'estimation" />
  <template v-if="store.loadingEstimate === false">
    <p class="errors center">Chargement des données</p>
  </template>
  <template v-else-if="store.loadingEstimate === true && !store.estimate.id">
    <p class="errors center">Pas de données</p>
  </template>
  <template v-else>
    <p class="project-name">Estimations de temps pour le projet : {{ store.estimate.name }}</p>
    <table class="table-result">
      <thead>
        <tr>
          <th>Développements</th>
          <th>Temps</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="generalLine in store.estimateLineGeneral">
          <td>{{ generalLine.label }}</td>
          <td>{{ generalLine.time }}h</td>
        </tr>
        <tr class="project-infos">
          <td>Spécificités</td>
          <td>Temps supplémentaire</td>
        </tr>
        <tr v-for="SpecialLine in store.estimateLineSpecial">
          <td>{{ SpecialLine.label }}</td>
          <td>{{ SpecialLine.time }}h</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td>Total</td>
          <td>{{ store.estimate.total_time }}h</td>
        </tr>
      </tfoot>
    </table>
  </template>
</template>

<style scoped></style>
