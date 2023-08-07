import { defineStore } from 'pinia';
import ApiService from '@/services/ApiService.js';
import { reactive, ref } from "vue";

export const useEstimateStore = defineStore("estimate", () => {

    const loading = ref(false);

    const estimates = reactive([]);

    async function fetchEstimates() {
        try {
            const data = await ApiService.fetchAll('estimates');
            Object.assign(estimates, await data);
            loading.value = true;
        } catch (error) {
            console.error(error);
        }
    }

    return {
        estimates,
        loading,
        fetchEstimates,
      };

});