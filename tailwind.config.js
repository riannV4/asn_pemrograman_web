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
                    "Plus Jakarta Sans",
                    "Figtree",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                // Purple Gradient Theme
                primary: "#7c3aed",
                "primary-dark": "#6d28d9",
                "primary-light": "#a78bfa",
                "primary-container": "#ede9fe",
                "on-primary": "#ffffff",
                "on-primary-container": "#5b21b6",
                secondary: "#8b5cf6",
                "secondary-container": "#f5f3ff",
                "on-secondary": "#ffffff",
                "on-secondary-container": "#6d28d9",
                tertiary: "#ec4899",
                "tertiary-container": "#fce7f3",
                "on-tertiary": "#ffffff",
                error: "#ef4444",
                "on-error": "#ffffff",
                "error-container": "#fee2e2",
                success: "#10b981",
                "success-container": "#d1fae5",
                background: "#faf5ff",
                "on-background": "#1e1b4b",
                surface: "#ffffff",
                "surface-variant": "#f3f4f6",
                "on-surface": "#1f2937",
                "on-surface-variant": "#6b7280",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#fafafa",
                "surface-container": "#f5f5f5",
                "surface-container-high": "#f0f0f0",
                "surface-container-highest": "#e5e5e5",
                outline: "#9ca3af",
                "outline-variant": "#d1d5db",
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
                card: "0 4px 16px rgba(124, 58, 237, 0.08)",
                "card-hover": "0 8px 24px rgba(124, 58, 237, 0.12)",
                fab: "0 8px 24px rgba(124, 58, 237, 0.24)",
            },
        },
    },

    plugins: [forms, animate],
};
