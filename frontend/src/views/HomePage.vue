<script setup>
import { ref } from "vue";
import TitleComponent from "@/components/TitleComponent.vue";
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import CheckboxInput from "../components/Input/CheckboxInput.vue";
import CustomTaskInput from "../components/Input/CustomTaskInput.vue";
import ApiService from "@/services/ApiService.js";

const projectName = ref("");
const estimateFields = ref([]);

const inputName = name => {
  projectName.value = name.target.value;
  console.log(projectName.value);
};

const fetchEstimateFields = async () => {
  try {
    const data = await ApiService.fetchAll("fields");
    console.log(data);
    estimateFields.value = data;
  } catch (error) {
    console.error(error);
  }
};
fetchEstimateFields();
</script>

<template>
  <TitleComponent title="Calculato'r" />
  <form class="estimator-form" action="#">
    <div class="errors">Le nom du projet est obligatoire.</div>

    <template v-for="field in estimateFields" :key="field.id">
      <template v-if="field.slug === 'nom-du-projet'">
        <TextInput @input="inputName" />
      </template>

      <template v-if="field.slug === 'technologies'">
        <SelectInput :id="field.id" project-type />
      </template>

      <template v-if="field.slug === 'developpements-generiques'">
        <CheckboxInput />
      </template>

      <template v-if="field.slug === 'developpements-supplementaires'">
        <CustomTaskInput />
      </template>

      <template v-if="field.slug === 'type-de-design'">
        <SelectInput :id="field.id" design-type />
      </template>
    </template>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
