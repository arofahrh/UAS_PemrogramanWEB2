<template>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="brand-header">
        <span class="brand-icon">👓</span>
        <h1 class="brand-name">LokaBuku</h1>
        <p class="brand-tagline">Selamat datang kembali di ruang bacamu.</p>
      </div>

      <form @submit.prevent="handleLogin" class="login-form">
        <div class="input-field">
          <label>Username</label>
          <div class="input-shadow-box">
            <input v-model="username" type="text" placeholder="Masukkan username" required />
          </div>
        </div>

        <div class="input-field">
          <label>Password</label>
          <div class="input-shadow-box">
            <input v-model="password" type="password" placeholder="••••••••" required />
          </div>
        </div>

        <button type="submit" class="submit-btn">Masuk</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const router = useRouter()

const handleLogin = async () => {
  try {
    const response = await fetch('http://localhost:8080/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username: username.value, password: password.value })
    })
    const data = await response.json()
    if (response.ok) {
      localStorage.setItem('token', data.token)
      router.push('/dashboard')
    } else {
      alert(data.error || "Username atau password salah")
    }
  } catch (error) {
    alert("Gagal terhubung ke backend!")
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

.login-wrapper {
  background-color: #E2E8F0; /* Latar luar yang sama */
  min-height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
}

.login-card {
  background-color: #FCFAF6; /* Warna cream dasar LokaBuku */
  padding: 3.5rem 3rem;
  border-radius: 30px;
  width: 100%;
  max-width: 400px;
  box-shadow: 20px 20px 60px rgba(0,0,0,0.05), -20px -20px 60px rgba(255,255,255,0.8);
  text-align: center;
  box-sizing: border-box;
}

.brand-header {
  margin-bottom: 2.5rem;
}

.brand-icon {
  font-size: 2.5rem;
}

.brand-name {
  color: #925F37;
  font-weight: 600;
  font-size: 1.8rem;
  margin: 0.5rem 0 0.2rem 0;
}

.brand-tagline {
  color: #8D7B68;
  font-size: 0.85rem;
  margin: 0;
}

.login-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.input-field {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  text-align: left;
}

.input-field label {
  font-size: 0.85rem;
  color: #5C4033;
  font-weight: 500;
  padding-left: 0.5rem;
}

/* Efek Cekung ke Dalam Khas Neumorphism */
.input-shadow-box {
  background-color: #FCFAF6;
  border-radius: 16px;
  padding: 2px;
  box-shadow: inset 3px 3px 6px rgba(200, 190, 180, 0.4), inset -3px -3px 6px rgba(255, 255, 255, 0.8);
}

.input-shadow-box input {
  width: 100%;
  border: none;
  background: none;
  outline: none;
  padding: 0.8rem 1.2rem;
  font-family: inherit;
  color: #5C4033;
  box-sizing: border-box;
  font-size: 0.9rem;
}

.input-shadow-box input::placeholder {
  color: #C2B6A9;
}

/* Tombol Timbul Keluar */
.submit-btn {
  border: none;
  background-color: #EEDFCE;
  color: #5C4033;
  font-family: inherit;
  font-weight: 600;
  font-size: 0.95rem;
  padding: 0.9rem;
  border-radius: 16px;
  cursor: pointer;
  margin-top: 1rem;
  box-shadow: 4px 4px 10px rgba(200, 190, 180, 0.5), -4px -4px 10px rgba(255, 255, 255, 0.9);
  transition: all 0.2s ease;
}

.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 6px 6px 14px rgba(200, 190, 180, 0.6), -6px -6px 14px rgba(255, 255, 255, 0.95);
}

.submit-btn:active {
  transform: translateY(0);
  box-shadow: inset 2px 2px 5px rgba(200, 190, 180, 0.4), inset -2px -2px 5px rgba(255, 255, 255, 0.7);
}
</style>