import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "on-tertiary-fixed-variant": "#693c00",
                "on-tertiary-container": "#ffe8d6",
                "on-tertiary": "#ffffff",
                "inverse-on-surface": "#eef1f3",
                "error": "#ba1a1a",
                "surface-bright": "#f7fafc",
                "on-primary": "#ffffff",
                "surface-variant": "#e0e3e5",
                "secondary-container": "#dae2fd",
                "inverse-primary": "#81d1f0",
                "primary-fixed": "#b9eaff",
                "on-primary-container": "#d3f1ff",
                "tertiary-fixed-dim": "#ffb86f",
                "error-container": "#ffdad6",
                "on-background": "#181c1e",
                "tertiary-fixed": "#ffdcbd",
                "tertiary": "#794602",
                "on-surface": "#181c1e",
                "on-primary-fixed": "#001f29",
                "outline-variant": "#bec8cd",
                "surface-container-highest": "#e0e3e5",
                "surface": "#f7fafc",
                "secondary": "#565e74",
                "primary": "#005a71",
                "background": "#f7fafc",
                "primary-container": "#0e7490",
                "on-surface-variant": "#3f484c",
                "on-primary-fixed-variant": "#004d62",
                "surface-container-low": "#f1f4f6",
                "on-tertiary-fixed": "#2c1600",
                "on-error-container": "#93000a",
                "primary-fixed-dim": "#81d1f0",
                "on-secondary-fixed-variant": "#3f465c",
                "surface-container-high": "#e6e8eb",
                "on-secondary-fixed": "#131b2e",
                "surface-container-lowest": "#ffffff",
                "outline": "#6f787d",
                "on-secondary-container": "#5c647a",
                "secondary-fixed": "#dae2fd",
                "on-secondary": "#ffffff",
                "inverse-surface": "#2d3133",
                "on-error": "#ffffff",
                "secondary-fixed-dim": "#bec6e0",
                "surface-tint": "#006781",
                "tertiary-container": "#965e1c",
                "surface-dim": "#d7dadd",
                "surface-container": "#ebeef0"
            },
            borderRadius: {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "2xl": "1rem",
                "3xl": "1.5rem",
                "full": "9999px"
            },
            spacing: {
                "container-margin": "16px",
                "xl": "32px",
                "lg": "24px",
                "base": "16px",
                "gutter": "12px",
                "sm": "8px",
                "md": "16px",
                "xs": "4px"
            }
        },
    },

    plugins: [forms],
};

