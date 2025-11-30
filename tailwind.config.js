import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        emerald: "#0F766E",     // primary dark green (elegant)
        ivory: "#FFF9F4",       // background cream / ivory
        gold: "#D4A373",        // accent warm gold
        warm: "#F7EEE2",        // soft warm background
        coral: "#C94C4C",       // CTA / accent coral
        charcoal: "#1F2D2D",    // text dark
        slateSoft: "#A6B5B3",   // muted text / divider
      },
      fontFamily: {
        poppins: ["Poppins", ...defaultTheme.fontFamily.sans],
      },
      boxShadow: {
        soft: "0 8px 30px rgba(15, 118, 110, 0.08)",
        innerBrush: "inset 0 10px 30px rgba(0,0,0,0.04)",
      },
    },
  },
  plugins: [],
};
