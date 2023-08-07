import { defineStore } from 'pinia';
import ApiService from '@/services/ApiService.js';
import { reactive, ref } from "vue";

export const useEstimateStore = defineStore("estimate", () => {

    const estimates = reactive([]);
    const loadingEstimates = ref(false);

    const estimate = reactive({});
    const loadingEstimate = ref(false);

    async function fetchEstimates() {
        try {
            const data = await ApiService.fetchAll('estimates');
            Object.assign(estimates, await data);
            loadingEstimates.value = true;
        } catch (error) {
            console.error(error);
        }
    }

    async function fetchEstimate(id) {
        try {
            const data = await ApiService.fetchOne('estimates', id);
            Object.assign(estimate, await data);
            loadingEstimate.value = true;
        } catch (error) {
            console.error(error);
            Object.assign(estimate, null);
            loadingEstimate.value = true;
        }
    }

    return {
        estimates,
        loadingEstimates,
        estimate,
        loadingEstimate,
        fetchEstimates,
        fetchEstimate,
      };

});