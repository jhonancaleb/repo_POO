/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}","./src/View/**/*{html,js}"],
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['"Montserrat"', "sans-serif"],
        lexend: ['"Lexend Deca"', "sans-serif"],
      },
      colors: {
        c_main: "#023047",
        c_darkBlue: "#014887",
        c_blue: "#0A39E4",
        c_gold: "#ffc107",
        c_red: "#ff0000",
        c_gray: "#5f697d",
      },
      backgroundImage: {
        'bg-login': "url('https://sinfo.senati.edu.pe/_wfm/files/cdn/sinfo/auth/senati-login-background.jpg')",
      }
    },
  },
  plugins: [],
}
