# Manam Chocolate — Indian Craft Chocolate™ Platform

An enterprise-grade, 1:1 pixel-accurate and functional parity recreation of the official **Manam Chocolate** flagship platform ([manamchocolate.com](https://manamchocolate.com/)), engineered as a custom WordPress and WooCommerce solution.

---

## 1. Project Overview

This project faithfully reproduces the complete visual identity, typography, motion physics, and e-commerce workflows of the live Manam Chocolate Shopify flagship store on an open, extensible WordPress architecture. 

It encompasses custom theme development, bespoke WooCommerce template overrides, custom facet filtering engines, right-anchored predictive search drawers, multi-instance Flickity-style image carousels, ambient video backgrounds, and multi-viewport responsive parity (from 1920px desktop down to 390px mobile).

---

## 2. Technologies Used

- **CMS & Commerce:** WordPress 6.x · WooCommerce 9.x
- **Theme Architecture:** Bespoke custom theme (`manamchocolate`) written with modern PHP 8.2 standards
- **Styling:** Modular component CSS (BEM architecture, scoped styling, CSS Custom Properties / variables)
- **Scripting:** Pure Vanilla ES6+ JavaScript (zero jQuery dependency for core interactions)
- **Typography:**
  - *Infini Family:* `infini gras` (Bold Display), `infini romain` (Regular Body), `infini italique` (Italic)
  - *Heroine Pro:* `HeroinePro-Regular`, `HeroinePro-Medium`, `HeroinePro-Bold`
  - *Meridian Family:* `FS Meridian`, `FS Meridian Medium`, `FS Meridian Bold`
  - *System Fallbacks:* `Instrument Sans`, `Georgia`
- **Development & Local Environment:** LocalWP (Nginx · PHP 8.2 · MySQL 8.0)
- **Automated Verification:** Playwright End-to-End Testing & Visual Regression Suite

---

## 3. Key Platform Features

### A. Navigation & Header
- **Vertical Baseline Alignment:** Strict vertical baseline alignment across logo, main navigation menus, and utility icons.
- **Desktop Megamenu Dropdowns:** Clean hover transitions, keyboard focus accessibility, and structured multi-column navigation links.
- **Blinkit Quick-Delivery Popup:** Authentic modal notification informing visitors of rapid grocery delivery availability across supported cities.
- **Right-Anchored Predictive Search Drawer:** Smooth slide-out search drawer with live WooCommerce product search results, thumbnail previews, price formatting, and keyboard trap support.

### B. E-Commerce & Collections Catalog
- **Dynamic 6-Group Facet Filtering:** Custom sidebar filter on collection archives supporting:
  1. *Origins* (Blend, Kerala, Vietnam, West Godavari) with dynamically calculated live product counts
  2. *Cacao Percentage* (Dark, Milk, White ranges)
  3. *Award Winning* (Academy of Chocolate / International Chocolate Awards)
  4. *Preference Based* (Inclusion, Single Farm, Single Origin)
  5. *Vegan* (Plant-based selections)
  6. *Price Range* (Interactive boundary filtering)
- **Interactive Arrow Accordions:** Smooth SVG accordion toggles without unwanted brown hover artifacts.
- **Secondary Image Hover Swap:** Smooth cross-fade transition revealing alternate product photography on desktop cursor hover.

### C. Individual Product Pages
- **Visual Hierarchy:** Official title, green vegetarian badge, net weight, unit price calculation (`₹/g`), MRP tax notices, lifestyle dietary pills, and verified customer review counts.
- **Tasting Notes Matrix:** Structured display of flavor notes, terroir origin, and cacao roast percentages.
- **Interactive Delivery Pincode Checker:** 6-digit regex validation providing instant shipping feasibility feedback.
- **5 Tabbed Editorial Accordions:** Description, Product Info, Ingredients, Storage Information, and Allergen Information with desktop tabs and mobile vertical accordions.
- **Digital Gifting:** Gift Card denomination switcher dynamically adjusting pricing and recipient data.
- **"More From" Recommendations:** Curated 4-card related products carousel per collection.

### D. Editorial & Brand Storytelling
- **About Us / Our Story (`/about-us/`):** 12 authentic reference sections including:
  - Full-bleed hero banner (`8-fermentary-_2.png`) with scrim overlay
  - "WE ARE MANAM" with authentic craft seal (`Frame_84.svg`) and mobile texture fallback
  - Section dividers in dark `#282828` and light `#ffffff`
  - 3 Auto-playing Flickity-style Carousels (harvesting, chocolate making, and product variety) with touch swipe detection
  - 2 Ambient HTML5 video sections with looping background video playback
  - 7-Pillars Karkhana experiential bar with Google Maps and Contact routing
- **Media / In the News (`/press/`):** 13 verified publication features (TIME Magazine, Condé Nast Traveller, The Hindu, Forbes, Harper's Bazaar, etc.) in authentic alternating editorial feed layout with official publication logos and verified source links.

---

## 4. Repository Folder Structure

```
manamchocolate/
├── app/
│   └── public/
│       └── wp-content/
│           ├── themes/
│           │   └── manamchocolate/          # Custom Bespoke WordPress Theme
│           │       ├── assets/
│           │       │   ├── css/
│           │       │   │   └── main.css     # Unified scoped platform stylesheet
│           │       │   ├── js/
│           │       │   │   └── main.js      # Unified modular interaction script
│           │       │   ├── fonts/           # Infini OTF typography assets
│           │       │   ├── images/          # Theme SVGs, seals, and UI graphics
│           │       │   └── videos/          # Local video loops
│           │       ├── woocommerce/         # Custom WooCommerce template overrides
│           │       │   ├── archive-product.php
│           │       │   ├── content-product.php
│           │       │   └── content-single-product.php
│           │       ├── functions.php        # Theme bootstrap, postmeta, AJAX endpoints
│           │       ├── header.php           # Global header, megamenu, search drawer
│           │       ├── footer.php           # 5-store contact footer, newsletter, legal
│           │       ├── front-page.php       # Homepage editorial showcase
│           │       ├── page-about-us.php    # 12-section Our Story template
│           │       ├── page-press.php       # 13-feature In the News template
│           │       ├── page-experience.php  # Experience Hub template
│           │       ├── page-workshops.php   # Workshop listing template
│           │       └── style.css            # Theme registration metadata
│           └── uploads/                     # Essential Page Media (Whitelisted)
│               ├── manam-about-media/       # About Us & Press high-res media + videos
│               ├── manam-experience/        # Experience hub & workshop photography
│               └── manam-stage5/            # Campaign banners & corporate gifting assets
├── docs/                                    # Parity Audits, Reports & Verification
│   ├── images/                              # Side-by-side visual parity proof screenshots
│   ├── complete-website-reference-parity-completion-report.md
│   ├── stage5.12-product-page-parity-completion-report.md
│   └── stage5.13-about-media-completion-report.md
├── .gitignore                               # Production WordPress exclusion rules
└── README.md                                # Project documentation
```

---

## 5. LocalWP Setup & Requirements

### System Requirements
- **Web Server:** Nginx (recommended) or Apache
- **PHP Version:** 8.2 or higher
- **Database:** MySQL 8.0+ or MariaDB 10.5+
- **WordPress:** 6.4+
- **WooCommerce:** 9.0+

### Recommended Setup in LocalWP
1. Launch **Local** ([localwp.com](https://localwp.com/)).
2. Create a new site named `manamchocolate`.
3. Set the local domain to `manamchocolate.local`.
4. Configure environment:
   - PHP: `8.2.x`
   - Web Server: `Nginx`
   - Database: `MySQL 8.0.x`
5. Place this repository into the site root:
   - The custom theme goes to: `wp-content/themes/manamchocolate/`
   - The essential uploads go to: `wp-content/uploads/`

---

## 6. Theme Installation & Configuration

1. **Activate Theme:**
   - In WP Admin, navigate to **Appearance &rarr; Themes**.
   - Activate the **Manam Chocolate** theme.

2. **Required Plugins:**
   - **WooCommerce:** Install and activate via **Plugins &rarr; Add New**.
   - No additional page builders or commercial filter plugins are required; all facets, modals, and carousels are built natively.

3. **Permalinks:**
   - Navigate to **Settings &rarr; Permalinks**.
   - Select **Post name** (`/%postname%/`) and save changes.

4. **Product Attributes for Filters:**
   - Ensure WooCommerce attributes `pa_origins` and `pa_cacao-percentage` are mapped on product catalog items for dynamic facet counting.

---

## 7. Media & Uploads Management

To keep the Git repository lightweight, fast to clone, and strictly within GitHub's recommended repository size limits (< 1 GB):
- **Included in Repository:**
  - Complete custom theme assets (`assets/` containing fonts, logos, SVGs, UI icons, and scripts).
  - Essential brand editorial media:
    - `manam-about-media/` (About Us photography, pattern textures, and 2 ambient looping MP4 videos).
    - `manam-experience/` (Workshops and Karkhana tour photography).
    - `manam-stage5/` (Homepage campaign hero graphics and store locator assets).
- **Excluded Bulk Catalog Media:**
  - The ~1.8 GB directory of 3,200+ raw e-commerce product photos (`manam-product-details/` and `products/`) is excluded from git tracking to prevent repository bloat.
  - A catalog asset manifest is available in [`docs/original-image-asset-manifest.md`](docs/original-image-asset-manifest.md).

---

## 8. Verification & Parity Proof

Automated tests and visual parity comparisons were executed using Playwright against the live reference site across 5 standard viewport resolutions:
- **1920 × 1080** (Full HD Desktop)
- **1649 × 877** (Standard Desktop)
- **1366 × 768** (Laptop)
- **768 × 1024** (Tablet Portrait)
- **390 × 844** (Mobile Device)

Side-by-side verification collages and audit matrices can be inspected in the [`docs/`](docs/) directory.

---

## 9. Security Notice

This repository contains **zero credentials, API tokens, user passwords, or database secrets**:
- `wp-config.php` is excluded via `.gitignore`.
- Raw MySQL dumps containing user tables are excluded.
- LocalWP runtime configuration and error logs are excluded.
- Standard sample configuration should be adapted using `wp-config-sample.php`.

---

## 10. License & Credits

- **Design & Reference:** All original design language, trademarks, and photography rights belong to [Manam Chocolate](https://manamchocolate.com/).
- **Implementation:** Developed for academic and analytical demonstration purposes in WordPress & WooCommerce architecture.

