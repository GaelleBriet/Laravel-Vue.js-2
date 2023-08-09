<script setup>
import { ref, onMounted, reactive } from "vue";
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
let projectName = ref(false);

const form = reactive({});

const handleUpdate = (value, slug) => {
  if (slug === "nom-du-projet") {
    projectName.value = true;
  }
  form[slug] = value;
  console.log(form);
};

const handleSubmit = async () => {
  try {
    const createdEstimate = await estimateFieldStore.create("estimates", form);

    Object.assign(form, {});
    router.push(`/details/${createdEstimate.id}`);
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
      <template v-if="field.type === 'text'">
        <TextInput :slug="field.slug" @input-update="handleUpdate" />
      </template>

      <template v-if="field.type === 'select'">
        <SelectInput :id="field.id" :slug="field.slug" :name="field.name" @selected="handleUpdate" />
      </template>

      <template v-if="field.type === 'checkbox'">
        <CheckboxInput :id="field.id" :slug="field.slug" @checkbox-change="handleUpdate" />
      </template>

      <template v-if="field.type === 'custom'">
        <CustomTaskInput :slug="field.slug" @selected-values="handleUpdate" />
      </template>
    </template>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style scoped></style>
