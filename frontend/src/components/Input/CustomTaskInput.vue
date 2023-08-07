<script setup>
// const addSpecificTemplateFields = () => {
//   const specificTemplateList = document.getElementById("specificTemplateList");

//   if (!specificTemplateList) {
//     return;
//   }
//   const specificTemplateWrapper = document.createElement("div");
//   specificTemplateWrapper.classList.add("specific-template");

//   const specificTemplateWrapperRemoveBtn = document.createElement("button");
//   specificTemplateWrapperRemoveBtn.className = "button button-icon";
//   specificTemplateWrapperRemoveBtn.innerHTML = '<i class="fa fa-minus"></i>';

//   specificTemplateWrapperRemoveBtn.addEventListener("click", () => {
//     specificTemplateWrapper.remove();
//   });

//   // Specific Template Name
//   const specificTemplateName = document.createElement("label");
//   specificTemplateName.className = "specific-template-name";

//   const specificTemplateInput = document.createElement("input");
//   specificTemplateInput.type = "text";
//   specificTemplateInput.name = "specific-template";

//   const specificTemplateInputNamePrefix = document.createElement("span");
//   specificTemplateInputNamePrefix.textContent = "Nom";
//   specificTemplateInputNamePrefix.className = "specific-template-input-prefix";

//   specificTemplateName.appendChild(specificTemplateInputNamePrefix);
//   specificTemplateName.appendChild(specificTemplateInput);

//   // Specific Template Time
//   const specificTemplateTime = document.createElement("label");
//   specificTemplateName.className = "specific-template-time";

//   const specificTemplateTimeInput = document.createElement("input");
//   specificTemplateTimeInput.type = "number";
//   specificTemplateTimeInput.name = "specific-template-time";

//   const specificTemplateInputUnit = document.createElement("span");
//   specificTemplateInputUnit.textContent = "h";
//   specificTemplateInputUnit.className = "specific-template-input-unit";

//   specificTemplateTime.append(specificTemplateTimeInput);
//   specificTemplateTime.append(specificTemplateInputUnit);

//   // Add everything to the wrapper
//   specificTemplateWrapper.appendChild(specificTemplateName);
//   specificTemplateWrapper.appendChild(specificTemplateTime);

//   specificTemplateWrapper.appendChild(specificTemplateWrapperRemoveBtn);

//   specificTemplateList.appendChild(specificTemplateWrapper);
// };

import { ref } from "vue";

const specificTemplates = ref([]);

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
          <input v-model="specificTemplate.name" type="text" />
        </label>

        <label class="specific-template-time">
          <input v-model="specificTemplate.time" type="number" />
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
