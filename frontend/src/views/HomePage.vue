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
};

const handleCheckboxChange = selectedValues => {
  selectedCheckboxes.value = selectedValues;
};

const handleCustomValues = values => {
  customTaskValues.value = values;
  console.log(customTaskValues.value);
};

const handleSubmit = async () => {
  try {
    const estimateData = {
      name: projectName.value,
      // total_time: calculateTotalTime()
      total_time: 123
    };

    const estimateLines = [];
    for (const field of estimateFields) {
      let selectedValue = "";

      if (field.slug === "technologies" && selectValues.value[field.slug]) {
        selectedValue = selectValues.value[field.slug];
      } else if (field.slug === "developpements-generiques" && selectedCheckboxes.value.length > 0) {
        selectedValue = selectedCheckboxes.value.join(", ");
      } else if (field.slug === "developpements-supplementaires" && customTaskValues.value.length > 0) {
        selectedValue = customTaskValues.value.map(template => `${template.name} (${template.time}h)`).join(", ");
      } else if (field.slug === "type-de-design" && selectValues.value[field.slug]) {
        selectedValue = selectValues.value[field.slug];
      }

      if (selectedValue) {
        const type =
          field.slug === "developpements-supplementaires" || field.slug === "type-de-design" ? "specific" : "general";
        // const time = calculateTime(selectedValue);
        const lineData = {
          label: selectedValue,
          time: 0,
          type: type
        };
        estimateLines.push(lineData);
      }
    }
    // Ajouter les estimate_lines aux données d'estimation
    estimateData.estimate_lines = estimateLines;

    const createdEstimate = await estimateFieldStore.create("estimates", estimateData);

    console.log("Estimate created:", createdEstimate);

    router.push("/details/");
    // router.push(`/details/${createdEstimate.id}`);
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
