<script setup>
import ApiService from "@/services/ApiService.js";
import { ref, onMounted } from "vue";

const props = defineProps({
  projectType: Boolean,
  designType: Boolean,
  id: {
    type: Number,
    default: 0 // valeur par défaut (eslint)
  }
});

const options = ref([]);
onMounted(async () => {
  try {
    const fieldResponse = await ApiService.fetchFieldValues(props.id);

    options.value = fieldResponse.values.map(value => ({
      label: value.label,
      value: value.value
    }));
  } catch (error) {
    console.error(error);
  }
});
</script>
<template>
  <div class="input-group">
    <span class="main-label">{{ projectType ? "Type de projet" : "Type de design" }}</span>

    <select :name="projectType ? 'project-type' : 'design-type'">
      <option value="">Choisir un {{ projectType ? "type de projet" : "type de design" }}</option>
      <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
    </select>
  </div>
</template>

<style scoped></style>

<!-- <div class="input-group">
  <span class="main-label">{{ projectType ? "Type de projet" : "Type de design" }}</span>

  <select :name="projectType ? 'project-type' : 'design-type'">
    <option value="">Choisir un {{ projectType ? "type de projet" : "type de design" }}</option>
    <option value="simple">{{ projectType ? "Laravel" : "Design simple" }}</option>
    <option value="complex">{{ projectType ? "Laravel et Vue.js" : "Design complexe" }}</option>
    <option v-if="designType" value="animations">Design complexe avec animations</option>
  </select>
</div> -->

<!-- <div v-if="projectType" class="input-group">
  <span class="main-label">Type de projet</span>

  <select name="project-type">
    <option value="">Choisir un type de projet</option>
    <option value="simple">Laravel</option>
    <option value="complex">Laravel et Vue.js</option>
  </select>
</div>
<div class="input-group">
  <span class="main-label">Type de design</span>

  <select v-if="designType" name="design-type">
    <option value="">Choisir un type de design</option>
    <option value="simple">Design simple</option>
    <option value="complex">Design complexe</option>
    <option value="animations">Design complexe avec animations</option>
  </select>
</div> -->
