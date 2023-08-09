<script setup>
  import EstimateCard from "@/components/EstimateCard/EstimateCard.vue";

  defineProps({
    estimates: {
      type: Array,
      required: true
    },
    loading: {
      type: Boolean,
      required: true
    }
  });
</script>

<template>
  <template v-if="loading === false">
    <p class="errors center">Chargement des données</p>
  </template>
  <template v-else-if="loading === true && estimates.length == 0">
    <p class="errors center">Pas de données</p>
  </template>
  <template v-else>
    <li v-for="(estimate, index) in estimates" :key="index">
      <EstimateCard :estimate="estimate" />
    </li>
  </template>
</template>

<style scoped></style>
