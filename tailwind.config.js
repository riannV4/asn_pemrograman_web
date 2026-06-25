import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import animate from "tailwindcss-animate";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Inter Tight",
                    "Figtree",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                // Design System Colors - Medium Slate Blue
                primary: "#7b68ee",
                "primary-dark": "#6456cd",
                "primary-light": "#9a8ef5",
                "primary-container": "#e8e5ff",
                "on-primary": "#ffffff",
                "on-primary-container": "#1a0066",
                secondary: "#7b68ee",
                "secondary-container": "#e8e5ff",
                "on-secondary": "#ffffff",
                "on-secondary-container": "#1a0066",
                tertiary: "#9a8ef5",
                "tertiary-container": "#f0edff",
                "on-tertiary": "#ffffff",
                error: "#ef4444",
                "on-error": "#ffffff",
                "error-container": "#fee2e2",
                warning: "#f59e0b",
                "warning-container": "#fef3c7",
                success: "#10b981",
                "success-container": "#d1fae5",
                background: "#fafbff",
                "on-background": "#1a1a2e",
                surface: "#ffffff",
                "surface-variant": "#f5f6ff",
                "on-surface": "#1a1a2e",
                "on-surface-variant": "#6b6b7b",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#fafbff",
                "surface-container": "#f5f6ff",
                "surface-container-high": "#e8e5ff",
                "surface-container-highest": "#ddd9ff",
                outline: "#c5c1ff",
                "outline-variant": "#ddd9ff",
            },
            fontSize: {
                "display-currency": [
                    "32px",
                    {
                        lineHeight: "40px",
                        letterSpacing: "-0.02em",
                        fontWeight: "700",
                    },
                ],
                "headline-lg": [
                    "24px",
                    { lineHeight: "32px", fontWeight: "700" },
                ],
                "headline-md": [
                    "20px",
                    { lineHeight: "28px", fontWeight: "600" },
                ],
                "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                "label-bold": [
                    "12px",
                    {
                        lineHeight: "16px",
                        letterSpacing: "0.05em",
                        fontWeight: "700",
                    },
                ],
            },
            spacing: {
                xs: "4px",
                sm: "8px",
                md: "16px",
                lg: "24px",
                xl: "32px",
            },
            borderRadius: {
                card: "24px",
                button: "16px",
                fab: "28px",
            },
            boxShadow: {
                card: "0 4px 16px rgba(123, 104, 238, 0.09)",
                "card-hover": "0 8px 24px rgba(123, 104, 238, 0.14)",
                fab: "0 8px 24px rgba(123, 104, 238, 0.26)",
            },
            keyframes: {
                marquee: {
                    "0%": { transform: "translateX(0%)" },
                    "100%": { transform: "translateX(-50%)" },
                },
            },
            animation: {
                marquee: "marquee 20s linear infinite",
            },
        },
    },

    plugins: [forms, animate],
};
