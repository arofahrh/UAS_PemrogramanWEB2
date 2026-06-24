<template>
  <div class="app-wrapper">
    <div class="app-container">
      
      <!-- SIDEBAR -->
      <aside class="sidebar">
        <div class="sidebar-top">
          <!-- Logo Readowl / LokaBuku Style -->
          <div class="brand">
            <span class="logo-icon">👓</span>
            <span class="logo-text">LokaBuku</span>
          </div>

          <!-- Navigation -->
          <nav class="menu">
            <a href="#" class="menu-item" :class="{ active: activeMenu === 'Home' }" @click.prevent="activeMenu = 'Home'">
              <span class="icon">🏠</span> Home
            </a>
            <a href="#" class="menu-item" :class="{ active: activeMenu === 'My library' }" @click.prevent="activeMenu = 'My library'">
              <span class="icon">📚</span> My library
            </a>
            <a href="#" class="menu-item" :class="{ active: activeMenu === 'Shop' }" @click.prevent="activeMenu = 'Shop'">
              <span class="icon">🛍️</span> Shop
            </a>
            <a href="#" class="menu-item" :class="{ active: activeMenu === 'News' }" @click.prevent="activeMenu = 'News'">
              <span class="icon">💬</span> News
            </a>
          </nav>
        </div>

        <div class="sidebar-bottom">
          <!-- Continue Reading Widget -->
          <div class="continue-reading">
            <p class="widget-title">Continue reading</p>
            <div class="book-cover-widget">
              <img :src="currentlyReading[0]?.cover || 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=300&fit=crop'" alt="Current Book" />
            </div>
            <div class="progress-bar"><div class="progress"></div></div>
          </div>

          <!-- User Profile & Logout -->
          <div class="user-profile" @click="handleLogout" title="Klik untuk keluar">
            <div class="avatar">A</div>
            <span class="username">Arafah</span>
            <span class="logout-icon">🚪</span>
          </div>
        </div>
      </aside>

      <!-- MAIN CONTENT -->
      <main class="main-content">
        
        <!-- ================= MENU 1: HOME ================= -->
        <div v-if="activeMenu === 'Home'" class="menu-section animate-fade">
          <div class="welcome-banner">
            <h1>Halo, Arafah! 👋</h1>
            <p>Hari yang cerah untuk membaca sesuatu yang baru hari ini.</p>
          </div>
          
          <div class="home-grid">
            <div class="stat-card">
              <h3>Buku Dibaca</h3>
              <p class="stat-number">{{ currentlyReading.length }}</p>
            </div>
            <div class="stat-card">
              <h3>Target Selesai</h3>
              <p class="stat-number">{{ finished.length }} / 12</p>
            </div>
          </div>

          <h2 class="sub-title">Rekomendasi Spesial Untukmu</h2>
          <div class="recommend-row">
            <div class="rec-card" v-for="n in 3" :key="n">
              <img :src="n === 1 ? 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=300&fit=crop' : 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=200&h=300&fit=crop'" />
              <div class="rec-info">
                <h4>Inspirasi Pagi Hari Vol. {{ n }}</h4>
                <p>Oleh Penulis Pilihan</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ================= MENU 2: MY LIBRARY ================= -->
        <div v-else-if="activeMenu === 'My library'" class="menu-section animate-fade">
          <!-- Top Bar: Search & Toggle -->
          <header class="top-bar">
            <div class="toggle-switch">
              <button class="toggle-btn" :class="{ active: activeTab === 'Shelves' }" @click="activeTab = 'Shelves'">Shelves</button>
              <button class="toggle-btn" :class="{ active: activeTab === 'All Books' }" @click="activeTab = 'All Books'">All Books</button>
            </div>
            <div class="search-bar">
              <span class="search-icon">🔍</span>
              <input type="text" v-model="searchQuery" placeholder="Search in My library..." />
            </div>
          </header>

          <!-- Tampilan Rak Berdasarkan Tab Aktif -->
          <div v-if="activeTab === 'Shelves'" class="shelves-container">
            <!-- Rak 1: Currently Reading -->
            <section class="shelf-section">
              <h2 class="section-title">Currently reading</h2>
              <div class="books-row">
                <div v-for="buku in filteredCurrentlyReading" :key="buku.id" class="book" :title="buku.judul">
                  <img :src="buku.cover" :alt="buku.judul" />
                </div>
                <p v-if="filteredCurrentlyReading.length === 0" class="empty-text">Tidak ada buku.</p>
              </div>
              <div class="shelf-board"></div>
            </section>

            <!-- Rak 2: Next Up -->
            <section class="shelf-section">
              <div class="section-header">
                <h2 class="section-title">Next up</h2>
                <a href="#" class="view-all">Full shelf →</a>
              </div>
              <div class="books-row">
                <div v-for="buku in filteredNextUp" :key="buku.id" class="book" :title="buku.judul">
                  <img :src="buku.cover" :alt="buku.judul" />
                </div>
                <p v-if="filteredNextUp.length === 0" class="empty-text">Tidak ada buku.</p>
              </div>
              <div class="shelf-board"></div>
            </section>

            <!-- Rak 3: Finished -->
            <section class="shelf-section">
              <div class="section-header">
                <h2 class="section-title">Finished</h2>
                <a href="#" class="view-all">Full shelf →</a>
              </div>
              <div class="books-row">
                <div v-for="buku in filteredFinished" :key="buku.id" class="book" :title="buku.judul">
                  <img :src="buku.cover" :alt="buku.judul" />
                </div>
                <p v-if="filteredFinished.length === 0" class="empty-text">Tidak ada buku.</p>
              </div>
              <div class="shelf-board"></div>
            </section>
          </div>

          <!-- Tampilan Grid Kalau Pilih 'All Books' -->
          <div v-else class="all-books-grid">
            <div v-for="buku in allBooksFiltered" :key="buku.id" class="all-book-item" :title="buku.judul">
              <img :src="buku.cover" />
              <h4>{{ buku.judul }}</h4>
            </div>
          </div>
        </div>

        <!-- ================= MENU 3: SHOP ================= -->
        <div v-else-if="activeMenu === 'Shop'" class="menu-section animate-fade">
          <div class="shop-header">
            <h2>LokaBuku Store 🛍️</h2>
            <p>Jelajahi dan beli buku digital terbaik pilihan editor.</p>
          </div>
          
          <div class="shop-grid">
            <div class="shop-card" v-for="n in 4" :key="n">
              <div class="badge">Terlaris</div>
              <img :src="'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=200&h=300&fit=crop'" />
              <h3>Koleksi Buku Baru #{{ n }}</h3>
              <p class="price">Rp 49.000</p>
              <button class="buy-btn">Beli Sekarang</button>
            </div>
          </div>
        </div>

        <!-- ================= MENU 4: NEWS ================= -->
        <div v-else-if="activeMenu === 'News'" class="menu-section animate-fade">
          <h2>Berita & Artikel Literasi 💬</h2>
          <div class="news-list">
            <div class="news-item" v-for="n in 3" :key="n">
              <div class="news-date">23 Juni 2026</div>
              <h3>Tips Membaca Konsisten 15 Menit Setiap Hari Tanpa Bosan</h3>
              <p>Membaca merupakan investasi terbaik untuk pikiran kita. Simak tips mengatur waktu di tengah kesibukan praktikum IT...</p>
              <a href="#" class="read-more">Baca selengkapnya →</a>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const activeMenu = ref('My library') 
const activeTab = ref('Shelves')    
const searchQuery = ref('')

// Data Buku Hasil Sinkronisasi dengan Database MySQL (uas_web2_elibrary)
const currentlyReading = ref([
  { id: 3, judul: 'Atomic Habits', cover: 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=300&fit=crop', status: 'reading' },
  { id: 4, judul: 'The Subtle Art of Not Giving a F*ck', cover: 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=200&h=300&fit=crop', status: 'reading' },
  { id: 5, judul: 'Clean Code: A Handbook of Agile Software Craftsmanship', cover: 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=200&h=300&fit=crop', status: 'reading' }
])

const nextUp = ref([
  { id: 6, judul: 'Vue.js: Up and Running', cover: 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=200&h=300&fit=crop', status: 'next' },
  { id: 7, judul: 'Harry Potter and the Sorcerer\'s Stone', cover: 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=200&h=300&fit=crop', status: 'next' },
  { id: 8, judul: 'The Lord of the Rings: The Fellowship of the Ring', cover: 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=200&h=300&fit=crop', status: 'next' },
  { id: 9, judul: 'It', cover: 'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=200&h=300&fit=crop', status: 'next' }
])

const finished = ref([
  { id: 10, judul: 'Dracula', cover: 'https://images.unsplash.com/photo-1541963463532-d68292c34b19?w=200&h=300&fit=crop', status: 'finished' },
  { id: 11, judul: 'Seni Berperang', cover: 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=200&h=300&fit=crop', status: 'finished' },
  { id: 14, judul: 'Home Sweat Loan', cover: 'https://images.unsplash.com/photo-1476275466078-4007374efbbe?w=200&h=300&fit=crop', status: 'finished' }
])

// Menggabungkan seluruh buku untuk tampilan tab 'All Books'
const allBooks = computed(() => {
  return [...currentlyReading.value, ...nextUp.value, ...finished.value]
})

// Fungsi Filter Pencarian Berbasis Karakter Judul Buku
const filteredCurrentlyReading = computed(() => {
  return currentlyReading.value.filter(b => b.judul.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

const filteredNextUp = computed(() => {
  return nextUp.value.filter(b => b.judul.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

const filteredFinished = computed(() => {
  return finished.value.filter(b => b.judul.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

const allBooksFiltered = computed(() => {
  return allBooks.value.filter(b => b.judul.toLowerCase().includes(searchQuery.value.toLowerCase()))
})

// Fungsi Logout menuju Halaman Autentikasi Utama
const handleLogout = () => {
  localStorage.removeItem('token')
  router.push('/')
}

onMounted(() => {
  console.log("Aplikasi LokaBuku Berhasil Dimuat Sempurna!")
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

.app-wrapper {
  background-color: #E2E8F0; 
  min-height: 100vh;
  width: 100vw;
  display: flex;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
}

.app-container {
  display: flex;
  background-color: #FCFAF6;
  width: 95vw;
  max-width: 1280px;
  height: 90vh;
  border-radius: 30px;
  box-shadow: 20px 20px 60px rgba(0,0,0,0.05), -20px -20px 60px rgba(255,255,255,0.8);
  overflow: hidden;
  box-sizing: border-box;
}

/* SIDEBAR */
.sidebar {
  width: 280px;
  min-width: 280px;
  border-right: 2px dashed #EEDFCE;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 2.5rem 2rem;
  background-color: #FCFAF6;
  box-sizing: border-box;
}

.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #925F37;
  font-weight: 600;
  font-size: 1.3rem;
  margin-bottom: 3rem;
}

.menu {
  display: flex;
  flex-direction: column;
  gap: 0.8rem;
}

.menu-item {
  text-decoration: none;
  color: #8D7B68;
  font-size: 0.95rem;
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 0.8rem 1rem;
  border-radius: 12px;
  transition: all 0.3s;
}

.menu-item.active {
  background-color: #EEDFCE;
  color: #5C4033;
  font-weight: 500;
  box-shadow: inset 2px 2px 5px rgba(146, 95, 55, 0.1), inset -2px -2px 5px rgba(255, 255, 255, 0.7);
}

/* Continue Reading Widget */
.continue-reading {
  background-color: #F0EAE1;
  padding: 1.2rem;
  border-radius: 16px;
  margin-bottom: 1.5rem;
  box-shadow: inset 4px 4px 8px rgba(200, 190, 180, 0.5), inset -4px -4px 8px rgba(255, 255, 255, 0.9);
  text-align: center;
}

.widget-title {
  font-size: 0.8rem;
  color: #5C4033;
  margin-bottom: 0.8rem;
  font-weight: 500;
  margin-top: 0;
}

.book-cover-widget img {
  width: 65px;
  height: 90px;
  object-fit: cover;
  border-radius: 4px;
  box-shadow: 2px 4px 10px rgba(0,0,0,0.15);
}

.progress-bar {
  width: 100%;
  height: 6px;
  background-color: #E2D5C4;
  border-radius: 3px;
  margin-top: 0.8rem;
  overflow: hidden;
}

.progress {
  width: 65%;
  height: 100%;
  background-color: #925F37;
}

/* User Profile */
.user-profile {
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  padding-top: 0.5rem;
}

.avatar {
  width: 38px;
  height: 38px;
  background-color: #925F37;
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
}

.username {
  color: #5C4033;
  font-weight: 500;
  font-size: 0.9rem;
  flex-grow: 1;
}

.logout-icon {
  font-size: 1.1rem;
}

/* MAIN CONTENT */
.main-content {
  flex-grow: 1;
  padding: 2.5rem 3rem;
  overflow-y: auto;
  background-color: #F8F5F0;
  box-sizing: border-box;
}

.animate-fade {
  animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}

/* KONTEN HOME */
.welcome-banner {
  background-color: #EEDFCE;
  padding: 2rem;
  border-radius: 20px;
  color: #5C4033;
  margin-bottom: 2rem;
}
.welcome-banner h1 { margin: 0 0 0.5rem 0; font-size: 1.8rem; }
.welcome-banner p { margin: 0; font-size: 0.95rem; opacity: 0.9; }

.home-grid {
  display: flex;
  gap: 1.5rem;
  margin-bottom: 2rem;
}
.stat-card {
  flex: 1;
  background: #FCFAF6;
  padding: 1.5rem;
  border-radius: 16px;
  box-shadow: 4px 4px 10px rgba(0,0,0,0.03);
}
.stat-card h3 { margin: 0; font-size: 0.9rem; color: #8D7B68; }
.stat-card .stat-number { font-size: 2rem; font-weight: 600; color: #925F37; margin: 0.5rem 0 0 0; }

.sub-title { font-size: 1.2rem; color: #5C4033; margin-bottom: 1rem; }
.recommend-row { display: flex; gap: 1.5rem; }
.rec-card {
  display: flex;
  background: #FCFAF6;
  padding: 1rem;
  border-radius: 12px;
  gap: 1rem;
  flex: 1;
}
.rec-card img { width: 50px; height: 70px; object-fit: cover; border-radius: 4px; }
.rec-info h4 { margin: 0; font-size: 0.9rem; color: #5C4033; }
.rec-info p { margin: 0.3rem 0 0 0; font-size: 0.8rem; color: #A3968A; }

/* KONTEN MY LIBRARY */
.top-bar {
  display: flex;
  gap: 2rem;
  margin-bottom: 2.5rem;
  align-items: center;
}

.toggle-switch {
  display: flex;
  background-color: #EFE9DF;
  border-radius: 20px;
  padding: 5px;
  box-shadow: inset 3px 3px 6px rgba(200, 190, 180, 0.4), inset -3px -3px 6px rgba(255, 255, 255, 0.8);
}

.toggle-btn {
  border: none;
  background: none;
  padding: 0.5rem 1.5rem;
  border-radius: 15px;
  font-family: inherit;
  font-size: 0.85rem;
  color: #8D7B68;
  cursor: pointer;
  transition: 0.3s;
}

.toggle-btn.active {
  background-color: #FCFAF6;
  color: #5C4033;
  box-shadow: 2px 2px 5px rgba(200, 190, 180, 0.3);
}

.search-bar {
  flex-grow: 1;
  display: flex;
  align-items: center;
  background-color: #FCFAF6;
  border-radius: 20px;
  padding: 0.5rem 1.5rem;
  box-shadow: inset 3px 3px 6px rgba(200, 190, 180, 0.4), inset -3px -3px 6px rgba(255, 255, 255, 0.8);
}

.search-bar input {
  border: none;
  background: none;
  outline: none;
  width: 100%;
  margin-left: 10px;
  font-family: inherit;
  color: #5C4033;
}

.shelves-container {
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
}

.shelf-section {
  position: relative;
  margin-bottom: 1rem;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  margin-bottom: 1rem;
}

.section-title {
  font-size: 1.1rem;
  color: #8D7B68;
  font-weight: 500;
  margin: 0 0 1rem 0;
}

.section-header .section-title { margin-bottom: 0; }
.view-all { font-size: 0.8rem; color: #8D7B68; text-decoration: none; }

.books-row {
  display: flex;
  gap: 2rem;
  padding: 0 1.5rem;
  align-items: flex-end;
  position: relative;
  z-index: 2;
  min-height: 135px;
}

.book { transition: transform 0.3s; }
.book:hover { transform: translateY(-10px); cursor: pointer; }
.book img {
  height: 130px;
  width: 90px;
  object-fit: cover;
  border-radius: 2px 6px 6px 2px;
  box-shadow: -3px 0 5px rgba(0,0,0,0.1), 5px 5px 15px rgba(0,0,0,0.15);
}

.shelf-board {
  height: 14px;
  background: linear-gradient(to bottom, #F4ECE1 0%, #E3D4C1 100%);
  border-radius: 4px;
  margin-top: -2px;
  position: relative;
  z-index: 1;
  box-shadow: 0 8px 10px -4px rgba(146, 95, 55, 0.15), inset 0 1px 1px rgba(255,255,255,0.6);
}

.all-books-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
  gap: 2rem;
}

/* Perbaikan bug tanda kurung kurawal yang salah di image_0ce898.png */
.all-book-item { 
  text-align: center; 
}

.all-book-item img { width: 100%; border-radius: 6px; box-shadow: 4px 4px 10px rgba(0,0,0,0.1); }
.all-book-item h4 { font-size: 0.85rem; margin: 0.5rem 0 0 0; color: #5C4033; font-weight: 500; }

/* KONTEN SHOP */
.shop-header { margin-bottom: 2rem; }
.shop-header h2 { margin: 0; color: #5C4033; }
.shop-header p { margin: 0.3rem 0 0 0; color: #8D7B68; font-size: 0.9rem; }
.shop-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
.shop-card { background: #FCFAF6; padding: 1.2rem; border-radius: 20px; text-align: center; position: relative; box-shadow: 4px 4px 10px rgba(0,0,0,0.03); }
.shop-card img { height: 140px; border-radius: 4px; margin-bottom: 1rem; box-shadow: 2px 4px 8px rgba(0,0,0,0.1); }
.shop-card h3 { font-size: 0.9rem; margin: 0; color: #5C4033; }
.shop-card .price { font-weight: 600; color: #925F37; font-size: 0.95rem; margin: 0.5rem 0 1rem 0; }
.buy-btn { background: #EEDFCE; border: none; padding: 0.5rem 1rem; border-radius: 10px; color: #5C4033; font-weight: 500; font-family: inherit; cursor: pointer; font-size: 0.8rem; }
.badge { position: absolute; top: 10px; left: 10px; background: #925F37; color: white; font-size: 0.7rem; padding: 0.2rem 0.5rem; border-radius: 6px; }

/* KONTEN NEWS */
.news-list { display: flex; flex-direction: column; gap: 1.5rem; margin-top: 1.5rem; }
.news-item { background: #FCFAF6; padding: 1.8rem; border-radius: 20px; box-shadow: 4px 4px 10px rgba(0,0,0,0.03); }
.news-date { font-size: 0.75rem; color: #A3968A; margin-bottom: 0.5rem; }
.news-item h3 { margin: 0 0 0.5rem 0; color: #5C4033; font-size: 1.1rem; }
.news-item p { margin: 0 0 1rem 0; color: #8D7B68; font-size: 0.9rem; line-height: 1.5; }
.read-more { font-size: 0.85rem; color: #925F37; text-decoration: none; font-weight: 500; }
</style>