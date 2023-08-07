import { defineStore } from 'pinia';
import ApiService from '@/services/ApiService.js';
import { reactive } from "vue";

export const useEstimateField = defineStore("estimateField", () => {

    const estimateFields = reactive([]);

    async function fetchEstimateFields() {
        try {
            const data = await ApiService.fetchAll('fields');
            Object.assign(estimateFields, await data);
        } catch (error) {
            console.error(error);
        }
    }

    return {
        estimateFields,
        fetchEstimateFields,
      };

});