/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', // Enable class-based dark mode
  theme: {
    extend: {
      colors: {
        'custom-lightergreen': 'var(--color-custom-lightergreen)',
        'custom-lightgreen': 'var(--color-custom-lightgreen)',
        'custom-green': 'var(--color-custom-green)',
        'custom-darkgreen': 'var(--color-custom-darkgreen)',
        'custom-red': 'var(--color-custom-red)',
        'custom-gold': 'var(--color-custom-gold)',
      },
    },
  },
  variants: {
    extend: {
      backgroundColor: ['dark', 'dark-hover', 'dark-group-hover'],
      borderColor: ['dark', 'dark-focus', 'dark-focus-within'],
      textColor: ['dark', 'dark-hover', 'dark-active'],
    },
  },
  plugins: [],
}