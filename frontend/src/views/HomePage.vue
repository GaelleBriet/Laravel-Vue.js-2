<script setup>
import TitleComponent from "@/components/TitleComponent.vue";
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import { ref } from "vue";
import CheckboxInput from "../components/Input/CheckboxInput.vue";
import CustomTaskInput from "../components/Input/CustomTaskInput.vue";

const projectName = ref("");

const inputName = name => {
  projectName.value = name.target.value;
  console.log(projectName.value);
};


</script>

<template>
  <TitleComponent title="Calculato'r" />
  <form class="estimator-form" action="#">
    <div class="errors">Le nom du projet est obligatoire.</div>

    <TextInput @input="inputName" />

    <SelectInput project-type />

    <CheckboxInput />

    <CustomTaskInput />

    <SelectInput design-type />

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
