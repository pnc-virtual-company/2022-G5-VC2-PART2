/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {      
      colors: {
      warning: '#FF6B00',
      primary: '#0081CA',
      dark: '#192331',
    },
    display: ["group-hover"],
  },
  },
  plugins: [],
}