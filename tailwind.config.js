/** @type {import('tailwindcss').Config} */
module.exports ={
  content: [
    // untuk compile data atau perkecil ukuran data laravel
    "./resources/**/*.blade.php",
    "./resources/**/*.js",  
    

  ],
  theme: {
    extend: {},
  },
  plugins: [
    // kode untuk mengaktifkan plugin
    require('@tailwindcss/forms'),
  ],
}

