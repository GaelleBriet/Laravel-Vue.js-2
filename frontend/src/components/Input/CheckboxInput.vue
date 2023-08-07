<script setup>
import ApiService from "@/services/ApiService.js";
import { ref, onMounted } from "vue";

// const checkboxes = [
//   { name: "Homepage", id: "homepage" },
//   { name: "Page de contact", id: "page-de-contact" },
//   { name: "Blog", id: "blog" },
//   { name: "Boutique", id: "boutique" },
//   { name: "Page éditorial", id: "editorial" },
//   { name: "Évènements", id: "evnements" },
//   { name: "Offres d'emplois", id: "module-meteo" }
// ];

const props = defineProps({
  id: {
    type: Number,
    default: 0 // valeur par défaut (eslint)
  }
});

const emit = defineEmits(["checkboxChange"]);

const checkboxes = ref([]);

onMounted(async () => {
  try {
    const checkboxesValues = await ApiService.fetchFieldValues(props.id);
    checkboxes.value = checkboxesValues.values.map(value => ({
      id: value.id,
      label: value.label,
      value: value.value,
      checked: false
    }));
  } catch (error) {
    console.error(error);
  }
});

const handleCheckboxChange = (event, checkboxValue) => {
  const checkbox = checkboxes.value.find(item => item.value === checkboxValue);
  if (checkbox) {
    checkbox.checked = event.target.checked;
    emit(
      "checkboxChange",
      checkboxes.value.filter(item => item.checked).map(item => item.value)
    );
  }
};
</script>

<template>
  <div class="input-group">
    <span class="main-label">Développement génériques</span>
    <template v-for="checkbox in checkboxes" :key="checkbox.id">
      <div class="checkbox-group">
        <input
          :id="checkbox.id"
          type="checkbox"
          :name="checkbox.value"
          :value="checkbox.value"
          @change="handleCheckboxChange($event, checkbox.value)"
        />
        <label :for="checkbox.id"> {{ checkbox.label }} </label>
      </div>
    </template>
  </div>
</template>

<style scoped></style>
