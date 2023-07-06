<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "BaseLayout"
});
</script>

<template>
  <header class="main-header">
    <span class="site-name">Estimato'r</span>
    <nav class="main-nav">
      <ul>
        <li>
          <a href=".#"> Calculato'r </a>
        </li>
        <li>
          <a href="#"> Dernières estimations </a>
        </li>
      </ul>
    </nav>
  </header>
  <main class="main-content">
    <slot></slot>
  </main>
  <footer></footer>
</template>

<style scoped></style>
