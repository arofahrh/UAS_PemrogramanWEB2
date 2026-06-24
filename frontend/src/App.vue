<template>
  <RouterView />
</template>

<style>
/* Reset dasar untuk memastikan layout penuh semata kaki tanpa margin bawaan browser */
html, body, #app {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  background-color: #E2E8F0; /* Menyesuaikan warna luar agar sepadan */
}
</style>