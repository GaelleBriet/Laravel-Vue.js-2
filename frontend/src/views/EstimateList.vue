<script setup>
  import TitleComponent from "@/components/TitleComponent.vue";
  import { computed, onMounted } from 'vue';
  import { useEstimateStore } from "@/stores/estimateStore.js";

  const store = useEstimateStore();

  const estimates = computed(() => (Object.keys(store.estimates).length ? store.estimates : null));

  onMounted(async () => {
    await store.fetchEstimates();
  });

</script>

<template>
  <TitleComponent title="Dernières estimations" />
  <ul class="estimate-list">
    <li v-for="estimate in estimates">
      <routerLink to="/details" class="estimate-card"> <!-- {{estimate.id}} -->
        <span class="project-name">{{estimate.name}}</span>
        <span class="project-time">{{estimate.total_time}}h</span>
      </routerLink>
    </li>
  </ul>
</template>

<style scoped></style>
