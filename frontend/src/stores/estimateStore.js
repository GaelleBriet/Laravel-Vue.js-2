import { defineStore } from 'pinia';
import ApiService from '@/services/ApiService.js';
import { reactive } from "vue";

export const useEstimateStore = defineStore("estimate", () => {

    const estimates = reactive([]);

    async function fetchEstimates() {
        try {
            const data = await ApiService.fetchAll('estimates');
            Object.assign(estimates, await data);
        } catch (error) {
            console.error(error);
        }
    }

    return {
        estimates,
        fetchEstimates,
      };

});