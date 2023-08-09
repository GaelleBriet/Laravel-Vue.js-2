<script setup>
import { ref, onMounted } from "vue";
import { useEstimateField } from "@/stores/EstimateFieldsStore.js";

const props = defineProps({
  id: {
    type: Number,
    default: 0
  },
  slug: {
    type: String,
    default: ""
  },
  name: {
    type: String,
    default: ""
  }
});

const emitSelectedValue = () => {
  if (selectedValue.value) {
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
    <span v-if="name === 'Technologies'" class="main-label">Type de projet</span>
    <span v-else class="main-label">Type de Design</span>

    <select v-model="selectedValue" :name="props.name" @change="emitSelectedValue(fieldSlug)">
      <option v-if="name === 'Technologies'" value="">Choisir un type de projet</option>
      <option v-else value="">Choisir un type de design</option>

      <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
    </select>
  </div>
</template>

<style scoped></style>
