<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import TitleComponent from "@/components/TitleComponent.vue";
import TextInput from "../components/Input/TextInput.vue";
import SelectInput from "../components/Input/SelectInput.vue";
import CheckboxInput from "../components/Input/CheckboxInput.vue";
import CustomTaskInput from "../components/Input/CustomTaskInput.vue";
import { useEstimateField } from "@/stores/EstimateFieldsStore.js";

const router = useRouter();
const estimateFieldStore = useEstimateField();
const estimateFields = estimateFieldStore.estimateFields;

const projectName = ref("");
const selectedCheckboxes = ref([]);
const selectValues = ref({});
const customTaskValues = ref([]);

const handleInputUpdate = name => {
  projectName.value = name.target.value;
};

const handleSelectedValue = (value, fieldSlug) => {
  selectValues.value[fieldSlug] = value;
  console.log(selectValues.value[fieldSlug]);
};

const handleCheckboxChange = selectedValues => {
  selectedCheckboxes.value = selectedValues;
};

const handleCustomValues = values => {
  customTaskValues.value = values;
};

// const handleSubmit = () => {
//   console.log("project name :", projectName.value);

//   console.log("Select Values:", selectValues.value);

//   const selectedCheckboxesArray = [...selectedCheckboxes.value];
//   console.log("Checkboxes sélectionnées  :", selectedCheckboxesArray);

//   console.log("Custom Task Values:", customTaskValues.value);

//   router.push("/details");
// };

const handleSubmit = async () => {
  try {
    const estimateData = {
      name: projectName.value,
      // total_time: calculateTotalTime()
      total_time: 123
    };

    const createdEstimate = await estimateFieldStore.create("estimates", estimateData);

    console.log("Estimate created:", createdEstimate);
    // Réinitialisez les valeurs du formulaire ou effectuez d'autres actions nécessaires

    router.push("/details");
  } catch (error) {
    console.error("Error creating estimate:", error);
  }
};

onMounted(async () => {
  await estimateFieldStore.fetchEstimateFields();
});
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
        <SelectInput :id="field.id" :slug="field.slug" project-type @selected="handleSelectedValue" />
      </template>

      <template v-if="field.slug === 'developpements-generiques'">
        <CheckboxInput :id="field.id" @checkbox-change="handleCheckboxChange" />
      </template>

      <template v-if="field.slug === 'developpements-supplementaires'">
        <CustomTaskInput @selected-values="handleCustomValues" />
      </template>

      <template v-if="field.slug === 'type-de-design'">
        <SelectInput :id="field.id" :slug="field.slug" design-type @selected="handleSelectedValue" />
      </template>
    </template>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
