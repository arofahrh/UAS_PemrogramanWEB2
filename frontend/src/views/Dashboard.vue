<template>
  <div class="min-h-screen bg-loka-bg p-8">
    <div class="max-w-4xl mx-auto">
      <div class="flex justify-between items-center mb-10 border-b-2 border-loka-shelf pb-4">
        <h1 class="text-3xl font-bold text-loka-dark">Rak Bukuku 📚</h1>
        <button @click="handleLogout" class="text-sm font-semibold text-loka-accent hover:text-loka-brown transition">
          Keluar
        </button>
      </div>
      
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div v-for="i in 4" :key="i" class="bg-loka-cream h-64 rounded-md shadow-sm border border-loka-shelf flex items-center justify-center">
          <p class="text-loka-brown text-sm">Buku {{ i }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const handleLogout = () => {
  localStorage.removeItem('token')
  router.push('/')
}
</script>