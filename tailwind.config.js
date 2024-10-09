/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}", // Check HTML, JS, and PHP files in src directory
    './**/*.html',              // Check all HTML files in the project
    './dist/**/*.js',           // Check all JS files in the dist directory
  ],
  theme: {
    extend: {
      fontFamily: {
        'inter': ["'Inter'", 'sans-serif'], // Custom font family
      },
      backgroundImage: {
        'select-arrow': 'url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZD0iTTExLjk5OTcgMTMuMTcxNEwxNi45NDk1IDguMjIxNjhMMTguMzYzNyA5LjYzNTg5TDExLjk5OTcgMTUuOTk5OUw1LjYzNTc0IDkuNjM1ODlMNy4wNDk5NiA4LjIyMTY4TDExLjk5OTcgMTMuMTcxNFoiIGZpbGw9InJnYmEoMTU2LDE2MywxNzUsMSkiPjwvcGF0aD48L3N2Zz4=")', // Custom background image
      },
    },
  },
  plugins: [
    require('flowbite/plugin')({
      charts: true, // Enable Flowbite charts plugin
    }),
    // ... other plugins
  ],
}
