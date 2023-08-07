<script setup>
const checkboxes = [
  { name: "Homepage", id: "homepage" },
  { name: "Page de contact", id: "page-de-contact" },
  { name: "Blog", id: "blog" },
  { name: "Boutique", id: "boutique" },
  { name: "Page éditorial", id: "editorial" },
  { name: "Évènements", id: "evnements" },
  { name: "Offres d'emplois", id: "module-meteo" }
];
</script>

<template>
  <div class="input-group">
    <span class="main-label">Développement génériques</span>
    <template v-for="checkbox in checkboxes" :key="checkbox.id">
      <div class="checkbox-group">
        <input
          :id="checkbox.id"
          type="checkbox"
          :name="checkbox.name"
          :value="checkbox.name"
          @change="handleCheckboxChange($event, checkbox.name)"
        />
        <label :for="checkbox.id"> {{ checkbox.name }} </label>
      </div>
    </template>
  </div>
</template>

<style scoped></style>