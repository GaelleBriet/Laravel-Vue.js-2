<script setup>
const props = defineProps({
  projectType: Boolean,
  designType: Boolean
});
</script>
<template>
  <div class="input-group">
    <span class="main-label">{{ projectType ? "Type de projet" : "Type de design" }}</span>

    <select :name="projectType ? 'project-type' : 'design-type'">
      <option value="">Choisir un {{ projectType ? "type de projet" : "type de design" }}</option>
      <option value="simple">{{ projectType ? "Laravel" : "Design simple" }}</option>
      <option value="complex">{{ projectType ? "Laravel et Vue.js" : "Design complexe" }}</option>
      <option v-if="designType" value="animations">Design complexe avec animations</option>
    </select>
  </div>
</template>

<style scoped></style>
