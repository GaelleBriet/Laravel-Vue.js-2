<script>
import { defineComponent } from "vue";

import BaseLayout from "@/components/BaseLayout.vue";
import EstimateForm from "@/views/EstimateForm.vue";

export default defineComponent({
  components: { EstimateForm, BaseLayout }
});
</script>

<template>
  <BaseLayout>
    <EstimateForm />
  </BaseLayout>
</template>

<style scoped></style>
