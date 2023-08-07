<script setup>
import TextInput from "../components/Input/TextInput.vue";
import { ref } from "vue";

const projectName = ref("");

const inputName = name => {
  projectName.value = name.target.value;
  console.log(projectName.value);
};
</script>

<template>
  <form class="estimator-form" action="#">
    <div class="errors">Le nom du projet est obligatoire.</div>

    <TextInput @input="inputName" />

    <div class="input-group">
      <span class="main-label">Type de projet</span>

      <select name="project-type">
        <option value="">Choisir un type de projet</option>
        <option value="simple">Laravel</option>
        <option value="complex">Laravel et Vue.js</option>
      </select>
    </div>

    <div class="input-group">
      <span class="main-label">Développement génériques</span>
      <div class="checkbox-group">
        <input id="homepage" type="checkbox" name="generic-templates[]" value="homepage" />
        <label for="homepage"> Homepage </label>
      </div>
      <div class="checkbox-group">
        <input id="contact" type="checkbox" name="generic-templates[]" value="contact" />
        <label for="contact"> Contact </label>
      </div>
      <div class="checkbox-group">
        <input id="blog" type="checkbox" name="generic-templates[]" value="blog" />
        <label for="blog"> Blog </label>
      </div>
      <div class="checkbox-group">
        <input id="boutique" type="checkbox" name="generic-templates[]" value="boutique" />
        <label for="boutique"> Boutique </label>
      </div>
      <div class="checkbox-group">
        <input id="editorial" type="checkbox" name="generic-templates[]" value="editorial" />
        <label for="editorial"> Page éditorial </label>
      </div>
      <div class="checkbox-group">
        <input id="events" type="checkbox" name="generic-templates[]" value="events" />
        <label for="events"> Évènements </label>
      </div>
      <div class="checkbox-group">
        <input id="jobs" type="checkbox" name="generic-templates[]" value="jobs" />
        <label for="jobs"> Offres d'emplois </label>
      </div>
    </div>

    <div class="input-group">
      <span class="main-label">Développements spécifiques</span>

      <div id="specificTemplateList" class="specific-template-list"></div>

      <button id="addSpecificTemplate" class="button button-icon" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="input-group">
      <span class="main-label">Type de design</span>

      <select name="design-type">
        <option value="">Choisir un type de design</option>
        <option value="simple">Design simple</option>
        <option value="complex">Design complexe</option>
        <option value="animations">Design complexe avec animations</option>
      </select>
    </div>

    <button type="submit" class="button">Obtenir l'estimation</button>
  </form>
</template>

<style lang="scss" scoped></style>
