<script setup>
  import { getMinutesToHours } from "@/services/MinutesToHours.js";

  defineProps({
    estimate: {
      type: Object,
      required: true
    },
  });
</script>

<template>
  <routerLink :to="'/details/' + estimate.id" class="estimate-card">
    <span class="project-name">{{ estimate.name }}</span>
    <span class="project-time">{{ getMinutesToHours(estimate.total_time) }}</span>
  </routerLink>
</template>

<style scoped></style>
