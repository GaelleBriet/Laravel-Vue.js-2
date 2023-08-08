<script setup>
import { ref } from "vue";

const item = ref("");

const props = defineProps({
  slug: {
    type: String,
    default: ""
  }
});

const emit = defineEmits(["input-update"]);

const emitInput = () => {
  emit("input-update", item, props.slug);
};
</script>

<template>
  <div class="input-group">
    <label class="main-label" for="project-name">Nom du projet</label>
    <input id="project-name" v-model="item" type="text" name="name" placeholder="Nom" @input="emitInput" />
  </div>
</template>

<style scoped></style>
