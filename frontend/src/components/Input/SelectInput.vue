<script setup>
import { ref, onMounted } from "vue";
import { useEstimateField } from "@/stores/EstimateFieldsStore.js";

const props = defineProps({
  projectType: Boolean,
  designType: Boolean,
  id: {
    type: Number,
    default: 0 // valeur par défaut (eslint)
  },
  slug: {
    type: String,
    default: ""
  }
});

const emitSelectedValue = () => {
  if (selectedValue.value) {
    // Émettre l'événement personnalisé avec la valeur sélectionnée
    emit("selected", selectedValue.value, props.slug);
  }
};

const estimateFieldStore = useEstimateField();
const emit = defineEmits(["selected"]);

const selectedValue = ref("");
const options = ref([]);

onMounted(async () => {
  try {
    const fieldValues = await estimateFieldStore.fectchFieldValues(props.id);
    options.value = fieldValues.values.map(value => ({
      label: value.label,
      value: value.value
    }));
  } catch (error) {
    console.error(error);
  }
});
</script>
<template>
  <div class="input-group">
    <span class="main-label">{{ projectType ? "Type de projet" : "Type de design" }}</span>

    <select
      v-model="selectedValue"
      :name="projectType ? 'project-type' : 'design-type'"
      @change="emitSelectedValue(fieldSlug)"
    >
      <option value="">Choisir un {{ projectType ? "type de projet" : "type de design" }}</option>
      <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
    </select>
  </div>
</template>

<style scoped></style>

<!-- <div class="input-group">
  <span class="main-label">{{ projectType ? "Type de projet" : "Type de design" }}</span>

  <select :name="projectType ? 'project-type' : 'design-type'">
    <option value="">Choisir un {{ projectType ? "type de projet" : "type de design" }}</option>
    <option value="simple">{{ projectType ? "Laravel" : "Design simple" }}</option>
    <option value="complex">{{ projectType ? "Laravel et Vue.js" : "Design complexe" }}</option>
    <option v-if="designType" value="animations">Design complexe avec animations</option>
  </select>
</div> -->

<!-- <div v-if="projectType" class="input-group">
  <span class="main-label">Type de projet</span>

  <select name="project-type">
    <option value="">Choisir un type de projet</option>
    <option value="simple">Laravel</option>
    <option value="complex">Laravel et Vue.js</option>
  </select>
</div>
<div class="input-group">
  <span class="main-label">Type de design</span>

  <select v-if="designType" name="design-type">
    <option value="">Choisir un type de design</option>
    <option value="simple">Design simple</option>
    <option value="complex">Design complexe</option>
    <option value="animations">Design complexe avec animations</option>
  </select>
</div> -->
