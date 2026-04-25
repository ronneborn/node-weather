import type { Config } from "tailwindcss";

const config: Config = {
  darkMode: "class",
  content: ["./app/**/*.{ts,tsx}", "./components/**/*.{ts,tsx}", "./lib/**/*.{ts,tsx}"],
  theme: {
    extend: {
      colors: {
        brand: {
          50: "#e8edff",
          500: "#3b5bfd",
          700: "#2740c8"
        }
      }
    }
  },
  plugins: []
};

export default config;
