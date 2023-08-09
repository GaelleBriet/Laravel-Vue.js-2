<script setup>
import TitleComponent from "@/components/TitleComponent.vue";
import EstimateCardList from "@/components/EstimateCard/EstimateCardList.vue";
import { onMounted } from "vue";
import { useEstimateStore } from "@/stores/EstimateStore.js";

const store = useEstimateStore();

onMounted(async () => {
  await store.fetchEstimates();
});
</script>

<template>
  <TitleComponent title="Dernières estimations" />
  <ul class="estimate-list">
    <EstimateCardList :estimates="store.estimates" :loading="store.loadingEstimates" />
  </ul>
</template>

<style scoped></style>
