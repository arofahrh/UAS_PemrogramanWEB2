#  LokaBuku - Digital Library Management System

> **Tugas Akhir Semester (UAS) - Pemrograman Web 2**
> 
> **Nama Mahasiswa:** Arofah Raudlatul Hasanah  
> **NIM:** 312410231  
> **Kelas:** I241B 
> **Dosen Pengampu:** Pak Agung Nugroho, S.Kom., M.Kom.

---

##  Deskripsi Proyek & Tema Studi Kasus
**Tema Studi Kasus:** Aplikasi Sistem Informasi Manajemen Perpustakaan Digital (E-Library).
**LokaBuku** adalah aplikasi web *Single Page Application* (SPA) untuk mengelola perpustakaan digital secara *real-time*. Proyek ini memisahkan arsitektur menjadi dua bagian: RESTful API (Backend) dan antarmuka reaktif (Frontend). Aplikasi ini dilengkapi dengan sistem autentikasi JWT yang mengamankan manajemen data buku (CRUD) serta visualisasi antarmuka berbasis TailwindCSS.

---

## Pengorganisasian Repositori
Proyek ini dibagi menjadi dua folder utama sesuai instruksi:
* ` backend-api/` : Berisi sistem backend menggunakan framework **CodeIgniter 4** untuk menyediakan layanan RESTful API.
* ` frontend-spa/` : Berisi sistem frontend SPA dengan file `index.html`, aset TailwindCSS, dan komponen berbasis **VueJS**.

---

## 📸 Dokumentasi Visual

### 1. Skema Relasi Tabel Database
<img width="386" height="201" alt="Screenshot 2026-06-23 221609" src="https://github.com/user-attachments/assets/c9fcde8e-746e-4e96-9c1d-9b0267553d49" />


### 2. Uji Coba API Gagal (Proteksi Token JWT)
<img width="640" height="358" alt="Screenshot 2026-06-23 004225" src="https://github.com/user-attachments/assets/3ef752e5-bd99-4e6b-8419-c9c0335e8015" />


### 3. Antarmuka Aplikasi (Frontend UI)

**Halaman Login**
<div align="center">
  <img width="80%" alt="Halaman Login" src="https://github.com/user-attachments/assets/030b2bb3-07a0-48a6-b4f0-a2ad2687b939" />
</div>

<br>

**Halaman Dashboard & Manajemen Library (Tabel Data & Form Modal)**
Sistem ini menggunakan gaya desain visual yang elegan dengan palet warna yang memadukan elemen *cozy*, *modern*, dan *earth tones* untuk memberikan kenyamanan eksplorasi perpustakaan digital.

<table border="0">
  <tr>
    <td><img width="100%" alt="Dashboard Library 1" src="https://github.com/user-attachments/assets/9084409a-df3f-4741-a544-48633333fc29" /></td>
    <td><img width="100%" alt="Dashboard Library 2" src="https://github.com/user-attachments/assets/56b8980b-b489-4b7d-aa03-60b57991322d" /></td>
  </tr>
  <tr>
    <td><img width="100%" alt="Dashboard Library 3" src="https://github.com/user-attachments/assets/e78d8dce-0a29-40ff-b95d-1f066fa0c996" /></td>
    <td><img width="100%" alt="Dashboard Library 4" src="https://github.com/user-attachments/assets/1c9acc91-df25-4107-b531-bb3bc7fa99aa" /></td>
  </tr>
  <tr>
    <td><img width="100%" alt="Dashboard Library 5" src="https://github.com/user-attachments/assets/1c276e95-5429-41b1-96c4-9f0b4761f6dc" /></td>
    <td><img width="100%" alt="Dashboard Library 6" src="https://github.com/user-attachments/assets/524e4f2a-5a9e-40b2-a119-3219bf72f317" /></td>
  </tr>
</table>

---

## ⚙️ Petunjuk Instalasi & Menjalankan Proyek Lokal

### Prasyarat Lingkungan:
* PHP >= 8.0, Composer, dan Web Server + MySQL (XAMPP/Laragon)
* Node.js & NPM terinstal di komputer.

### Langkah 1: Menjalankan Backend (CodeIgniter 4)
1. Buka terminal, masuk ke direktori backend:
```bash
   cd backend-api
