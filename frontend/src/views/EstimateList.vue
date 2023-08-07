<script setup>
import TitleComponent from "@/components/TitleComponent.vue";
import ApiService from "@/services/ApiService.js";

const fetchEstimate = async () => {
  try {
    const data = await ApiService.fetchAll("estimates");
    console.log(data);
    return data;
  } catch (error) {
    console.error(error);
  }
};

fetchEstimate();
</script>

<template>
  <TitleComponent title="Dernières estimations" />
  <ul class="estimate-list">
    <li>
      <routerLink to="/details" class="estimate-card">
        <span class="project-name">O'clock</span>
        <span class="project-time">35h</span>
      </routerLink>
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
