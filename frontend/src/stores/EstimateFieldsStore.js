import { defineStore } from "pinia";
import ApiService from "@/services/ApiService.js";
import { reactive } from "vue";

export const useEstimateField = defineStore("estimateField", () => {
  const estimateFields = reactive([]);

  async function fetchEstimateFields() {
    try {
      const data = await ApiService.fetchAll("fields");
      // Object.assign(estimateFields, await data);
      estimateFields.length = 0;
      estimateFields.push(...data);
    } catch (error) {
      console.error(error);
    }
  }

  async function fectchFieldValues(fieldId) {
    try {
      const data = await ApiService.fetchFieldValues(fieldId);
      return data;
    } catch (error) {
      console.error(error);
      throw new Error(`Failed to fetch values for field with ID: ${fieldId}`);
    }
  }

  return {
    estimateFields,
    fetchEstimateFields,
    fectchFieldValues
  };
});
