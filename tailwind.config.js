/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      boxShadow: {
        'xd': '0 -1px 3px -1px rgba(0, 0, 0, 0.1), 0 2px 6px 2px rgba(0, 0, 0, 0.1)',
      },
    },
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
}

