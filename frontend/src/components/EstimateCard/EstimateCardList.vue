<script setup>
import { getMinutesToHours } from "@/services/MinutesToHours.js";

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
      <routerLink :to="'/details/' + estimate.id" class="estimate-card">
        <span class="project-name">{{ estimate.name }}</span>
        <span class="project-time">{{ getMinutesToHours(estimate.total_time) }}</span>
      </routerLink>
    </li>
  </template>
</template>

<style scoped></style>
