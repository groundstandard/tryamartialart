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
                primary: {
                    DEFAULT: '#120D42',
                    50: '#E8E7F0',
                    100: '#D1CFE1',
                    200: '#A39FC3',
                    300: '#756FA5',
                    400: '#473F87',
                    500: '#120D42',
                    600: '#0F0B38',
                    700: '#0C092E',
                    800: '#090724',
                    900: '#06051A',
                },
                secondary: {
                    DEFAULT: '#165AE7',
                    50: '#E8F0FD',
                    100: '#D1E1FB',
                    200: '#A3C3F7',
                    300: '#75A5F3',
                    400: '#4787EF',
                    500: '#165AE7',
                    600: '#1248B9',
                    700: '#0E368B',
                    800: '#0A245D',
                    900: '#06122F',
                },
                tertiary: {
                    DEFAULT: '#FAB301',
                    50: '#FEF5E0',
                    100: '#FDEBC1',
                    200: '#FBD783',
                    300: '#F9C345',
                    400: '#FCBB09',
                    500: '#FAB301',
                    600: '#C88F01',
                    700: '#966B01',
                    800: '#644700',
                    900: '#322400',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
