<script setup>
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import { ref } from "vue";
import CheckboxInput from "./Input/CheckboxInput.vue";

const projectName = ref("");

const inputName = name => {
  projectName.value = name.target.value;
  console.log(projectName.value);
};
</script>

<template>
  <form class="estimator-form" action="#">
    <div class="errors">Le nom du projet est obligatoire.</div>

    <TextInput @input="inputName" />

    <SelectInput project-type />

    <CheckboxInput />

    <div class="input-group">
      <span class="main-label">Développements spécifiques</span>

      <div id="specificTemplateList" class="specific-template-list"></div>

      <button id="addSpecificTemplate" class="button button-icon" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <SelectInput design-type />

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style lang="scss" scoped></style>
