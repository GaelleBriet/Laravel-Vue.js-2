<script setup>
import { ref } from "vue";

const item = ref("");
</script>

<template>
  <div class="input-group">
    <label class="main-label" for="project-name">Nom du projet</label>
    <input id="project-name" v-model="item" type="text" name="name" placeholder="Nom" :input="item" />
  </div>
</template>

<style scoped></style>
