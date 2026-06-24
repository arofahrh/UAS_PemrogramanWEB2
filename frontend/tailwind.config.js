/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'loka-bg': '#FAF7F2',     // Cream terang buat background utama
        'loka-cream': '#F5F0E6',  // Cream agak gelap buat sidebar/card
        'loka-shelf': '#E7DCCB',  // Warna kayu rak buku
        'loka-brown': '#795C46',  // Coklat medium buat elemen/icon
        'loka-dark': '#3E2723',   // Dark brown buat teks utama
        'loka-accent': '#C88A58', // Warna coklat bata buat tombol
      },
      fontFamily: {
        sans: ['Nunito', 'sans-serif'], // Font bulat estetik
      }
    },
  },
  plugins: [],
}