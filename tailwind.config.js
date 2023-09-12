/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.twig"],
  theme: {
    colors: {
      'primary': '#084457',
      'secondary': '#5A7B87',
      'tertiary': '#D2E9E8',
      'quarternary' : '#0673EF',
      'black': '#000',
      'white': '#fff',
      'grey-lightest': '#f9fafb',
      'grey-light': '#EEF1F3',
      'grey': '#d1d5db',
      'red': '#ff5050',
    },
    screens: {
      'xs': '400px',
      // => @media (min-width: 400px) { ... }

      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1305px',
      // => @media (min-width: 1280px) { ... }

      'xxl': '1500px',
      // => @media (min-width: 1280px) { ... }
    },
    container: {
      screens: {
        'xs': '400px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1305px',
      }
  },
  fontSize: {
    xs: ['12px', '19px'],
    sm: ['14px', '21px'],
    base: ['18px', '27px'],
    md: ['21px', '26px'],
    lg: ['24px', '26px'],
    xl: ['32px', '35px'],
    '2xl': ['64px', '70px'],
  },
    extend: {},
  },
  plugins: [],
}

