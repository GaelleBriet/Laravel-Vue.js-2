<script setup>
import { ref, computed } from "vue";
import TitleComponent from "@/components/TitleComponent.vue";
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import CheckboxInput from "../components/Input/CheckboxInput.vue";
import CustomTaskInput from "../components/Input/CustomTaskInput.vue";
import ApiService from "@/services/ApiService.js";

const projectName = ref("");
const estimateFields = ref([]);

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

const handleInputUpdate = name => {
  projectName.value = name.target.value;
  console.log(projectName.value);
};

const handleSelectedValue = value => {
  console.log("Valeur du select:", value);
};

const handleCheckboxChange = selectedValues => {
  console.log("Checkboxes sélectionnées :", selectedValues);
};

const handleValuesSelected = values => {
  console.log("Valeurs des custom inputs :", values);
};
</script>

<template>
  <TitleComponent title="Calculato'r" />
  <form class="estimator-form" action="#">
    <div v-if="!projectName" class="errors">Le nom du projet est obligatoire.</div>

    <template v-for="field in estimateFields" :key="field.id">
      <template v-if="field.slug === 'nom-du-projet'">
        <TextInput @input="handleInputUpdate" />
      </template>

      <template v-if="field.slug === 'technologies'">
        <SelectInput :id="field.id" project-type @selected="handleSelectedValue" />
      </template>

      <template v-if="field.slug === 'developpements-generiques'">
        <CheckboxInput :id="field.id" @checkbox-change="handleCheckboxChange" />
      </template>

      <template v-if="field.slug === 'developpements-supplementaires'">
        <CustomTaskInput @selected-values="handleValuesSelected" />
      </template>

      <template v-if="field.slug === 'type-de-design'">
        <SelectInput :id="field.id" design-type @selected="handleSelectedValue" />
      </template>
    </template>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
