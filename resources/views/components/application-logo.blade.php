<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logo-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#7c3aed" />
            <stop offset="100%" stop-color="#4c1d95" />
        </linearGradient>
    </defs>
    <!-- Wallet Outer -->
    <rect x="10" y="25" width="80" height="54" rx="12" fill="url(#logo-gradient)" />
    <!-- Wallet inner accent -->
    <path d="M 10 37 L 90 37 L 90 73 C 90 76.3 87.3 79 84 79 L 16 79 C 12.7 79 10 76.3 10 73 Z" fill="#4c1d95" opacity="0.2" />
    <!-- Wallet Flap -->
    <path d="M 50 25 L 90 42 L 90 62 L 50 45 Z" fill="#2e1065" opacity="0.4" />
    <!-- Wallet Clasp -->
    <rect x="72" y="40" width="18" height="18" rx="5" fill="#ffffff" />
    <circle cx="81" cy="49" r="4" fill="#7c3aed" />
    <!-- Rising Coin -->
    <circle cx="35" cy="22" r="12" fill="#fbbf24" />
    <circle cx="35" cy="22" r="9" fill="#f59e0b" />
    <!-- Dollar sign or detail inside coin -->
    <path d="M 35 17 L 35 27 M 32 20 C 35 18, 38 21, 35 22 C 32 23, 35 26, 38 24" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" fill="none" />
</svg>
