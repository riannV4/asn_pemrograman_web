---
name: Kostly
colors:
  surface: '#f7fafc'
  surface-dim: '#d7dadd'
  surface-bright: '#f7fafc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f1f4f6'
  surface-container: '#ebeef0'
  surface-container-high: '#e6e8eb'
  surface-container-highest: '#e0e3e5'
  on-surface: '#181c1e'
  on-surface-variant: '#3f484c'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eef1f3'
  outline: '#6f787d'
  outline-variant: '#bec8cd'
  surface-tint: '#006781'
  primary: '#005a71'
  on-primary: '#ffffff'
  primary-container: '#0e7490'
  on-primary-container: '#d3f1ff'
  inverse-primary: '#81d1f0'
  secondary: '#565e74'
  on-secondary: '#ffffff'
  secondary-container: '#dae2fd'
  on-secondary-container: '#5c647a'
  tertiary: '#794602'
  on-tertiary: '#ffffff'
  tertiary-container: '#965e1c'
  on-tertiary-container: '#ffe8d6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#b9eaff'
  primary-fixed-dim: '#81d1f0'
  on-primary-fixed: '#001f29'
  on-primary-fixed-variant: '#004d62'
  secondary-fixed: '#dae2fd'
  secondary-fixed-dim: '#bec6e0'
  on-secondary-fixed: '#131b2e'
  on-secondary-fixed-variant: '#3f465c'
  tertiary-fixed: '#ffdcbd'
  tertiary-fixed-dim: '#ffb86f'
  on-tertiary-fixed: '#2c1600'
  on-tertiary-fixed-variant: '#693c00'
  background: '#f7fafc'
  on-background: '#181c1e'
  surface-variant: '#e0e3e5'
typography:
  display-currency:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-bold:
    fontFamily: Plus Jakarta Sans
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.05em
  display-currency-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 16px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  container-margin: 16px
  gutter: 12px
---

## Brand & Style

This design system is engineered for the "anak kost" demographic—young adults navigating financial independence in urban Indonesia. The aesthetic blends **Corporate Modern** reliability with a **Minimalist** warmth to ensure the app feels like a helpful financial companion rather than a rigid banking utility.

The visual narrative focuses on clarity, removing cognitive load during expense tracking. We utilize generous whitespace, soft rounded geometry, and high-contrast typography to evoke a sense of control and optimism. The interface remains functional and "utility-first," yet feels premium and trustworthy through refined spacing and subtle depth.

## Colors

The palette is anchored by a vibrant **Teal** as the primary action color, providing a more energetic and modern feel than traditional banking blues. 

- **Primary Teal (#0E7490):** Used for primary actions, active states, and brand highlights.
- **Surface & Background:** We use an off-white **Slate-50 (#F8FAFC)** for the main background to reduce glare, with pure **White (#FFFFFF)** reserved for cards to create a clear "stacking" effect.
- **Semantic Accents:** Coral Red is strictly reserved for "Money Out" and alerts. Emerald Green is used for "Money In" and success states.
- **Neutral Grays:** We use a curated scale of Slate grays for secondary text and borders to maintain a soft, professional contrast.

## Typography

**Plus Jakarta Sans** is the sole typeface for this design system, chosen for its friendly yet modern geometric construction. 

- **Currency Display:** Financial totals must use the `display-currency` token with **700 (Bold)** weight and tight letter-spacing to emphasize importance.
- **Hierarchy:** Use font-weight rather than color to establish hierarchy where possible. 
- **Readability:** Maintain a minimum size of 14px for body content to ensure accessibility for users glancing at their phones while on the go.

## Layout & Spacing

This design system uses a **Fluid Grid** model optimized for mobile devices. The rhythm is based on an **8px linear scale**, with **16px** serving as the standard "Comfortable" padding for containers and screen edges.

- **Margins:** All screens maintain a 16px safe-area margin on the left and right.
- **Card Spacing:** Internal card padding is set to 16px (md) to ensure content doesn't feel cramped. 
- **Vertical Rhythm:** Use 24px (lg) spacing between distinct content sections (e.g., between "Total Balance" and "Recent Transactions") to provide breathing room.

## Elevation & Depth

We utilize **Tonal Layering** combined with soft **Ambient Shadows** to create a clear physical hierarchy.

- **Level 0 (Background):** Slate-50 (#F8FAFC) flat surface.
- **Level 1 (Cards):** Pure White (#FFFFFF) surfaces with a very soft, diffused shadow (Y: 4px, Blur: 12px, Color: 0F172A at 5% opacity). This makes the cards feel "placed" on the background.
- **Level 2 (Interactive/Modals):** Pure White surfaces with a more pronounced shadow (Y: 8px, Blur: 24px, Color: 0F172A at 10% opacity) to indicate they are floating above the main UI.
- **Outlines:** Use a 1px border of Slate-200 (#E2E8F0) on input fields and secondary buttons instead of shadows to keep the UI clean.

## Shapes

The shape language is **Rounded**, reflecting a friendly and accessible brand personality. 

- **Cards & Containers:** Use 16px (rounded-lg) for main content cards to create a soft, modern look.
- **Buttons:** Primary buttons use 12px (rounded-md) to maintain a structural, reliable feel.
- **Category Icons:** Always use perfect circles (rounded-full) for category backgrounds to differentiate them from interactive buttons or cards.

## Components

### Buttons
- **Primary:** Large (min-height 56px), Primary Teal background, White text, Bold weight.
- **Secondary:** Transparent background, Slate-200 border, Primary Teal text.

### Category Icons
- Icons are displayed inside a circular background with a 10% opacity tint of the icon's semantic color (e.g., Food icons have a soft Teal or Orange tint).
- Use clean, 2px stroke-width outlines for the icons themselves.

### Cards
- Use for transaction items, budget summaries, and "kost" payment reminders.
- Background: White (#FFFFFF).
- Corner Radius: 16px.
- Padding: 16px.

### Input Fields & Toggles
- **Inputs:** 1px Slate-200 border, 12px corner radius. On focus, border transitions to Primary Teal with a 2px stroke.
- **Toggles:** Use a pill-shaped track. When active, the track is Primary Teal; when inactive, it is Slate-300.

### List Items
- Transaction lists should use a horizontal layout: Icon (left), Label/Category (center-stack), and Currency Amount (right). 
- Amounts for expenses should include a minus "-" prefix in Coral Red.