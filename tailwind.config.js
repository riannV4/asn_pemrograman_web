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
                // Design System Colors
                primary: "#014e3d",
                "primary-dark": "#013a2d",
                "primary-light": "#026c55",
                "primary-container": "#e6f4f1",
                "on-primary": "#ffffff",
                "on-primary-container": "#013a2d",
                secondary: "#0f766e",
                "secondary-container": "#e6f2f2",
                "on-secondary": "#ffffff",
                "on-secondary-container": "#0f766e",
                tertiary: "#ec4899",
                "tertiary-container": "#fce7f3",
                "on-tertiary": "#ffffff",
                error: "#ef4444",
                "on-error": "#ffffff",
                "error-container": "#fee2e2",
                warning: "#f59e0b",
                "warning-container": "#fef3c7",
                success: "#10b981",
                "success-container": "#d1fae5",
                background: "#f8fafc",
                "on-background": "#0f172a",
                surface: "#ffffff",
                "surface-variant": "#f1f5f9",
                "on-surface": "#0f172a",
                "on-surface-variant": "#64748b",
                "surface-container-lowest": "#ffffff",
                "surface-container-low": "#f8fafc",
                "surface-container": "#f1f5f9",
                "surface-container-high": "#e2e8f0",
                "surface-container-highest": "#cbd5e1",
                outline: "#cbd5e1",
                "outline-variant": "#e2e8f0",
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
                card: "0 4px 16px rgba(1, 78, 61, 0.08)",
                "card-hover": "0 8px 24px rgba(1, 78, 61, 0.12)",
                fab: "0 8px 24px rgba(1, 78, 61, 0.24)",
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
