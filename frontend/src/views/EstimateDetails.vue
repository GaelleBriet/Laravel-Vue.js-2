<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "EstimateDetails"
});
</script>

<template>
  <h1 class="main-title">Résultat de l'estimation</h1>
  <p class="project-name">Estimations de temps pour le projet : O'clock</p>
  <table class="table-result">
    <thead>
      <tr>
        <th>Développements</th>
        <th>Temps</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Mise en place du projet</td>
        <td>4h</td>
      </tr>
      <tr>
        <td>Homepage</td>
        <td>7h</td>
      </tr>
      <tr>
        <td>Blog</td>
        <td>3h</td>
      </tr>
      <tr>
        <td>Offres d'emplois</td>
        <td>12h</td>
      </tr>
      <tr>
        <td>Événements</td>
        <td>14h</td>
      </tr>
      <tr>
        <td>Module météo</td>
        <td>4h</td>
      </tr>
      <tr class="project-infos">
        <td>Spécificités</td>
        <td>Temps supplémentaire</td>
      </tr>
      <tr>
        <td>Design : Complexe</td>
        <td>4h</td>
      </tr>
      <tr>
        <td>Type de projet : Laravel</td>
        <td>0h</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td>Total</td>
        <td>40h</td>
      </tr>
    </tfoot>
  </table>
</template>

<style scoped></style>
