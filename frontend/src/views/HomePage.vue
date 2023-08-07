<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import TitleComponent from "@/components/TitleComponent.vue";
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import CheckboxInput from "../components/Input/CheckboxInput.vue";
import CustomTaskInput from "../components/Input/CustomTaskInput.vue";
import ApiService from "@/services/ApiService.js";

const router = useRouter();
const projectName = ref("");
const estimateFields = ref([]);
const selectedCheckboxes = ref([]);
const selectValues = ref({});
const customTaskValues = ref([]);

const fetchEstimateFields = async () => {
  try {
    const data = await ApiService.fetchAll("fields");
    estimateFields.value = data;
  } catch (error) {
    console.error(error);
  }
};
fetchEstimateFields();

const handleInputUpdate = name => {
  projectName.value = name.target.value;
};

const handleSelectedValue = (value, fieldSlug) => {
  selectValues.value[fieldSlug] = value;
};

const handleCheckboxChange = selectedValues => {
  selectedCheckboxes.value = selectedValues;
};

const handleCustomValues = values => {
  customTaskValues.value = values;
};

const handleSubmit = () => {
  console.log("project name :", projectName.value);

  console.log("Select Values:", selectValues.value);

  const selectedCheckboxesArray = [...selectedCheckboxes.value];
  console.log("Checkboxes sélectionnées  :", selectedCheckboxesArray);

  console.log("Custom Task Values:", customTaskValues.value);

  router.push("/details");
};
</script>

<template>
  <TitleComponent title="Calculato'r" />
  <form class="estimator-form" @submit.prevent="handleSubmit">
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
        <CustomTaskInput @selected-values="handleCustomValues" />
      </template>

      <template v-if="field.slug === 'type-de-design'">
        <SelectInput :id="field.id" design-type @selected="handleSelectedValue" />
      </template>
    </template>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
