import { createRouter, createWebHistory } from "vue-router";
import HomePage from "@/views/HomePage.vue";
import EstimateList from "@/views/EstimateList.vue";
import EstimateDetails from "@/views/EstimateDetails.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomePage
    },
    {
      path: "/list",
      name: "list",
      component: EstimateList
    },
    {
      path: "/details/:id",
      name: "details",
      component: EstimateDetails
    }
  ]
});

export default router;
