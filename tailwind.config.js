/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './app/**/*.php',
    './config/**/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.{php,js}',
    './storage/framework/views/*.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        text: 'var(--text)',
        background: 'var(--background)',
        primary: 'var(--primary)',
        secondary: 'var(--secondary)',
        accent: 'var(--accent)',

        light: 'var(--background)',
        dark: '#020617',
      },
      fontFamily: {
        sans: ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
