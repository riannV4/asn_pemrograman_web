# Transaction Page Design Implementation Plan

## Overview
Update the transaction management system to match the design_ui specifications while maintaining all existing CRUD functionality. This includes implementing a custom design system, sidebar navigation, enhanced filtering, and search capabilities.

## Design Decisions

1. **Page Structure:** Keep all 3 pages (index.blade.php, create.blade.php, edit.blade.php)
2. **Navigation:** Add sidebar navigation from design_ui
3. **Design System:** Apply full design_ui color scheme with custom Tailwind configuration
4. **Filters:** Add design_ui style filter button + month selector, keep existing filters in modal
5. **Features:** Add header search bar, Plus Jakarta Sans font, keep hover edit/delete buttons

## Implementation Tasks

### 1. Tailwind Configuration Update

**File:** `tailwind.config.js`

**Actions:**
- Add custom color palette from design_ui:
  - Primary colors: `#005a71`, `#0e7490`, `#81d1f0`, etc.
  - Secondary colors: `#565e74`, `#dae2fd`, etc.
  - Tertiary colors: `#794602`, `#965e1c`, `#ffb86f`, etc.
  - Surface variants: `surface`, `surface-container`, `surface-variant`, etc.
  - Error colors: `#ba1a1a`, `#ffdad6`
  - Outline colors: `#6f787d`, `#bec8cd`
- Add custom font family: Plus Jakarta Sans
- Add custom font sizes: `display-currency`, `headline-lg`, `headline-md`, `body-lg`, `body-md`, `label-bold`
- Add custom spacing: `container-margin`, `xl`, `lg`, `base`, `gutter`, `sm`, `md`, `xs`
- Add custom border radius: keep defaults, ensure `rounded-[24px]` works

**Reference:** Lines 22-62 in `design_ui/transaction_dekstop/code.html`

### 2. Font Integration

**File:** `resources/views/layouts/app.blade.php` (or main layout file)

**Actions:**
- Add Google Fonts link for Plus Jakarta Sans in `<head>`:
  ```html
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet"/>
  ```
- Update body class to use the font: `font-family: 'Plus Jakarta Sans', sans-serif;`
- Ensure Material Symbols Outlined icons are included (already present in current implementation)

### 3. App Layout with Sidebar Navigation

**File:** `resources/views/layouts/app.blade.php`

**Actions:**
- Restructure layout to include:
  - Sidebar navigation (desktop only, hidden on mobile)
  - Top header bar with search, notifications, help icons
  - Main content area (flex-1)
- Sidebar should include:
  - Logo/brand section: "Kostly Tracker" with "Anak Kost Management"
  - Navigation links: Dashboard, Transactions (active), Reports, Settings
  - User profile section at bottom with avatar, name, email
- Top header should include:
  - Search bar (left side, hidden on mobile)
  - Notification and help icons (right side)
  - App title on mobile
- Apply design_ui colors: `bg-surface-container-lowest`, `border-outline-variant`, etc.
- Make sidebar sticky with `sticky left-0 top-0`
- Add responsive behavior: `hidden md:flex` for sidebar

**Reference:** Lines 66-123 in `design_ui/transaction_dekstop/code.html`

### 4. Transaction Index Page Update

**File:** `resources/views/transactions/index.blade.php`

**Structure:** Keep 2-column grid layout (left: quick-add form, right: transaction list)

#### 4.1 Left Column - Quick Add Form Updates

**Actions:**
- Update card styling:
  - Border radius: `rounded-[24px]` (instead of `rounded-3xl`)
  - Background: `bg-surface-container-lowest`
  - Border: `border-surface-variant`
  - Shadow: `shadow-[0_4px_12px_rgba(15,23,42,0.05)]`
  - Padding: `p-xl` (32px)
- Update type tabs styling:
  - Background container: `bg-surface-container-low`
  - Active expense tab: `bg-surface-container-lowest shadow-sm text-error`
  - Active income tab: `bg-surface-container-lowest shadow-sm text-primary`
  - Inactive: `text-on-surface-variant`
- Update amount input:
  - Label: `font-label-bold text-label-bold text-on-surface-variant`
  - Currency symbol: `font-display-currency text-display-currency text-on-surface-variant`
  - Input: `font-display-currency text-display-currency text-on-surface`
  - Border: `border-outline-variant` → `focus-within:border-primary`
- Update Voice/Scan buttons:
  - Border: `border-outline-variant`
  - Hover: `hover:bg-surface-container-low`
  - Text: `text-primary font-label-bold text-label-bold`
- Update Quick Actions buttons:
  - Background: `bg-surface-container-low`
  - Border: `border-transparent hover:border-outline-variant`
  - Text: `font-body-md text-body-md text-on-surface`
- Update category/date selects:
  - Background: `bg-surface-container-lowest`
  - Border: `border-outline-variant`
  - Focus: `focus:border-primary focus:ring-1 focus:ring-primary`
  - Label: `font-label-bold text-label-bold text-on-surface-variant`
- Update notes input: same as category/date
- Update submit button:
  - Background: `bg-primary hover:bg-primary-container`
  - Text: `text-on-primary font-label-bold text-label-bold`
  - Padding: `py-4`
  - Shadow: `shadow-sm`

#### 4.2 Right Column - Transaction List Updates

**Actions:**
- Update card styling: same as left column
- Add header section with filter controls:
  - Title: `font-headline-md text-headline-md text-on-surface`
  - Add filter button (icon only): `border-outline-variant hover:bg-surface-container-low`
  - Add month selector dropdown: `border-outline-variant hover:bg-surface-container-low`
- Update date group headers:
  - Style: `font-label-bold text-label-bold text-on-surface-variant uppercase tracking-wider`
- Update transaction list items:
  - Container: `hover:bg-surface-container-low rounded-xl transition-colors`
  - Padding: `p-md` (16px)
  - Icon circle backgrounds:
    - Expense: `bg-tertiary-container/10 text-tertiary-container`
    - Income: `bg-secondary-container text-on-secondary-container`
  - Title: `font-body-md text-body-md font-semibold text-on-surface`
  - Category: `font-body-md text-body-md text-on-surface-variant text-sm`
  - Amount (expense): `font-body-md text-body-md font-bold text-error`
  - Amount (income): `font-body-md text-body-md font-bold text-primary`
- Keep hover edit/delete buttons with updated colors:
  - Edit: `text-primary hover:bg-primary/10`
  - Delete: `text-error hover:bg-error/10`

#### 4.3 Filter Modal Implementation

**Actions:**
- Create modal component that opens when filter button is clicked
- Modal should contain:
  - Search input (by notes or category name)
  - Category filter dropdown
  - Type filter (income/expense radio buttons)
  - Date range filters (start date, end date)
  - Apply and Reset buttons
- Style modal with design_ui colors
- Wire up to existing backend filter logic (already in TransactionController)

**Reference Backend:** Lines 14-53 in `app/Http/Controllers/TransactionController.php`

### 5. Transaction Create Page Update

**File:** `resources/views/transactions/create.blade.php`

**Actions:**
- Apply same styling updates as index page form (section 4.1)
- Update page header styling
- Update card container: `bg-surface-container-lowest rounded-[24px] shadow-[0_4px_12px_rgba(15,23,42,0.05)] border-surface-variant`
- Update submit button area:
  - Cancel link: `text-on-surface-variant hover:text-on-surface`
  - Submit button: same as index page submit button
- Ensure all color classes match the new design system
- Keep all existing functionality (voice, scan, quick actions)

### 6. Transaction Edit Page Update

**File:** `resources/views/transactions/edit.blade.php`

**Actions:**
- Apply same styling updates as create page
- Update submit button text to "Update Transaksi" with check icon
- Ensure pre-filled values display correctly with new styling
- Keep all existing functionality

### 7. Search Bar Implementation

**File:** `resources/views/layouts/app.blade.php` (in top header)

**Actions:**
- Add search input in top header (desktop only):
  ```html
  <div class="relative group">
    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
    <input class="w-full bg-surface-container-low border border-transparent focus:border-primary focus:ring-1 focus:ring-primary rounded-full py-2 pl-10 pr-4 font-body-md text-body-md transition-all" placeholder="Search transactions..." type="text"/>
  </div>
  ```
- Wire up search to submit to transactions.index route with search parameter
- Use existing backend search logic (already implemented)

### 8. Backend Verification

**File:** `app/Http/Controllers/TransactionController.php`

**Actions:**
- Verify all CRUD operations work correctly (already implemented)
- Verify filter functionality (search, category, type, date range) - already implemented
- No backend changes needed, just verify:
  - Index method handles all filter parameters ✓
  - Store method validates and creates transactions ✓
  - Update method validates and updates transactions ✓
  - Destroy method deletes transactions ✓
  - Authorization checks are in place ✓

## File Writing Strategy (Chunked Write Protocol)

Given that some files may exceed 300 lines, follow this strategy:

1. **tailwind.config.js** - Single write (small file)
2. **app.blade.php layout** - May need chunking if >300 lines:
   - Write sidebar section first
   - Write header section
   - Write main content wrapper
3. **index.blade.php** - REQUIRES CHUNKING (currently 345 lines):
   - Edit left column form styling (targeted edits)
   - Edit right column list styling (targeted edits)
   - Add filter modal (separate section)
4. **create.blade.php** - Single edit (232 lines, use targeted edits)
5. **edit.blade.php** - Single edit (232 lines, use targeted edits)

## Testing Checklist

### Visual Testing
- [ ] Sidebar navigation displays correctly on desktop
- [ ] Sidebar hidden on mobile, app title shows
- [ ] All colors match design_ui color scheme
- [ ] Plus Jakarta Sans font loads and displays correctly
- [ ] Transaction cards have correct rounded corners and shadows
- [ ] Type tabs switch colors correctly
- [ ] Quick action buttons have correct hover states
- [ ] Transaction list items have correct hover states
- [ ] Edit/delete buttons appear on hover

### Functional Testing
- [ ] Create new transaction (manual entry)
- [ ] Create new transaction (voice input)
- [ ] Create new transaction (scan receipt)
- [ ] Edit existing transaction
- [ ] Delete existing transaction
- [ ] Filter by search term
- [ ] Filter by category
- [ ] Filter by type (income/expense)
- [ ] Filter by date range
- [ ] Filter modal opens and closes
- [ ] Month selector dropdown works
- [ ] Header search bar submits correctly
- [ ] Quick actions populate form fields
- [ ] Amount formatting works (thousand separators)

### Responsive Testing
- [ ] Layout works on mobile (sidebar hidden)
- [ ] Layout works on tablet
- [ ] Layout works on desktop
- [ ] 2-column grid stacks on mobile
- [ ] Forms remain usable on small screens

## Implementation Order

1. Update Tailwind configuration (foundation)
2. Add font links to layout
3. Update app layout with sidebar and header
4. Update transaction index page (in sections)
5. Update transaction create page
6. Update transaction edit page
7. Implement filter modal
8. Test all functionality
9. Verify responsive behavior

## Risk Mitigation

**Risk:** Large file edits timing out
**Mitigation:** Use chunked write protocol, make targeted surgical edits instead of full rewrites

**Risk:** Color scheme not matching design exactly
**Mitigation:** Copy color values exactly from design_ui code.html, test thoroughly

**Risk:** Breaking existing functionality
**Mitigation:** Only update styling, don't modify backend logic or form field names

**Risk:** Font not loading
**Mitigation:** Add preconnect links for Google Fonts, test with network throttling

**Risk:** Responsive layout breaking
**Mitigation:** Test at multiple breakpoints, use Tailwind responsive utilities consistently

## Success Criteria

- All transaction pages visually match design_ui specifications
- All CRUD operations work correctly
- All filter functionality works correctly
- Search functionality works correctly
- Sidebar navigation displays correctly
- Design is responsive across all screen sizes
- Plus Jakarta Sans font loads and displays
- No console errors or warnings
- Backend functionality unchanged and working

## Notes

- The backend controller is already fully functional and doesn't need changes
- The existing voice and scan features should be preserved
- The Material Symbols Outlined icons are already in use
- The transaction list grouping by date should be preserved
- Authorization checks (user ownership) are already implemented
- The quick add form on index page should remain functional
