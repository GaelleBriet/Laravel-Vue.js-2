<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "EstimateList"
});
</script>

<template>
  <h1 class="main-title">Dernières estimations</h1>
  <ul class="estimate-list">
    <li>
      <a href="#" class="estimate-card">
        <span class="project-name">O'clock</span>
        <span class="project-time">35h</span>
      </a>
    </li>
    <li>
      <a href="#" class="estimate-card">
        <span class="project-name">Music O'wards</span>
        <span class="project-time">35h</span>
      </a>
    </li>
    <li>
      <a href="#" class="estimate-card">
        <span class="project-name">Vue.js Converter</span>
        <span class="project-time">75h</span>
      </a>
    </li>
    <li>
      <a href="#" class="estimate-card">
        <span class="project-name">Pets n'Co</span>
        <span class="project-time">125h</span>
      </a>
    </li>
    <li>
      <a href="#" class="estimate-card">
        <span class="project-name">Be my Beer</span>
        <span class="project-time">18h</span>
      </a>
    </li>
  </ul>
</template>

<style scoped></style>
