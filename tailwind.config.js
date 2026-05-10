/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                },
                surface: {
                    light: '#ffffff',
                    soft:  '#f8fafc',
                    muted: '#f1f5f9',
                    dark:  '#0f172a',
                    'dark-soft':  '#111827',
                    'dark-muted': '#1f2937',
                },
            },
            fontFamily: {
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            transitionProperty: {
                'sidebar': 'width, transform, margin, padding',
            },
        },
    },
    plugins: [],
};
