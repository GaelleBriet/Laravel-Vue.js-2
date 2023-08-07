<script setup>
import { ref, defineEmits } from "vue";

const emit = defineEmits("SelectedValues");
const specificTemplates = ref([]);

const emitValuesToParent = () => {
  emit("SelectedValues", specificTemplates.value);
};

const addSpecificTemplate = () => {
  specificTemplates.value.push({ name: "", time: "" });
};

const removeSpecificTemplate = index => {
  specificTemplates.value.splice(index, 1);
};
</script>

<template>
  <div class="input-group">
    <span class="main-label">Développements spécifiques</span>

    <div class="specific-template-list">
      <div v-for="(specificTemplate, index) in specificTemplates" :key="index" class="specific-template">
        <label class="specific-template-name">
          <span class="specific-template-input-prefix">Nom</span>
          <input v-model="specificTemplate.name" type="text" @input="emitValuesToParent" />
        </label>

        <label class="specific-template-time">
          <input v-model="specificTemplate.time" type="number" @input="emitValuesToParent" />
          <span class="specific-template-input-unit">h</span>
        </label>

        <button class="button button-icon" @click="removeSpecificTemplate(index)">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>

    <button class="button button-icon" type="button" @click="addSpecificTemplate">
      <i class="fa fa-plus"></i>
    </button>
  </div>
</template>

<style scoped></style>

<!-- <div class="input-group">
  <span class="main-label">Développements spécifiques</span>

  <div id="specificTemplateList" class="specific-template-list"></div>

  <button id="addSpecificTemplate" class="button button-icon" type="button" @click="addSpecificTemplateFields">
    <i class="fa fa-plus"></i>
  </button>
</div> -->
