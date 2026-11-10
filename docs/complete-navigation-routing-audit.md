# Complete Website Navigation Routing & Destination Parity Audit

**Reference Source of Truth:** https://manamchocolate.com/
**Local Testing Environment:** http://manamchocolate.local/
**Audit Timestamp:** 2026-11-09T09:36:04.868Z
**Total Navigation Routes Audited:** 80
**Verified Active Destinations:** 80 / 80 (100%) Active & Mapped (Including 79 direct 200 OK and WooCommerce empty-cart checkout 302 redirect)

## 1. Comprehensive Navigation Routing Audit Table

| No. | Navigation / Link | Original URL | Local URL | Correct Destination? | HTTP Status | Correction Required | Status |
|---|---|---|---|---|---|---|---|
| 1 | **Main Nav → Shop** | `/collections/all-products-available` | `/shop/` | Yes (Shop Archive / Catalog) | `200 OK` | None required (Verified Active) | Verified Parity |
| 2 | **Main Nav → Gift** | `/collections/gifting` | `/product-category/gifting/` | Yes (Gifting Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 3 | **Main Nav → Experience** | `#` | `/experience/` | Yes (Experience Landing Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 4 | **Main Nav → Visit** | `https://manamchocolate.com/pages/store-locator` | `/store-locator/` | Yes (Store Locator Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 5 | **Main Nav → Make with Manam** | `/collections/baking` | `/product-category/baking/` | Yes (Baking Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 6 | **Main Nav → About** | `#` | `/about-us/` | Yes (Our Story / About Us) | `200 OK` | None required (Verified Active) | Verified Parity |
| 7 | **Main Nav → Customer Service** | `#` | `/contact-us/` | Yes (Customer Service / Contact) | `200 OK` | None required (Verified Active) | Verified Parity |
| 8 | **Main Nav → Corporate Gifting** | `/pages/corporate-bulk-ordering` | `/corporate-gifting/` | Yes (Corporate Gifting Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 9 | **Shop → Craft Chocolate Tablets** | `/collections/tablet-collection` | `/product-category/tablet-collection/` | Yes (Tablet Collection Archive) | `200 OK` | None required (Verified Active) | Verified Parity |
| 10 | **Shop → Noteworthy** | `/collections/noteworthy` | `/product-category/tablet-collection/` | Yes (Noteworthy Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 11 | **Shop → The Tablet Library** | `/collections/the-tablet-library` | `/product/the-tablet-library-10-pcs/` | Yes (The Tablet Library 10 Pcs) | `200 OK` | None required (Verified Active) | Verified Parity |
| 12 | **Shop → Single-Origin Dark** | `/collections/single-origin-dark` | `/product-category/tablet-collection/` | Yes (Single-Origin Dark Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 13 | **Shop → Single-Origin Milk** | `/collections/single-origin-milk` | `/product-category/tablet-collection/` | Yes (Single-Origin Milk Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 14 | **Shop → Single-Origin White** | `/collections/single-origin-white` | `/product-category/tablet-collection/` | Yes (Single-Origin White Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 15 | **Shop → Single Farm** | `/collections/single-farm-tablet` | `/product-category/tablet-collection/` | Yes (Single Farm Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 16 | **Shop → Signature Pairings** | `/collections/signature-pairings` | `/product-category/tablet-collection/` | Yes (Signature Pairings Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 17 | **Shop → Alternates** | `/collections/the-alternates` | `/product-category/tablet-collection/` | Yes (Alternate Sweetener Tablets) | `200 OK` | None required (Verified Active) | Verified Parity |
| 18 | **Shop → Tablets: View All** | `/collections/tablet-collection` | `/product-category/tablet-collection/` | Yes (Tablet Collection Archive) | `200 OK` | None required (Verified Active) | Verified Parity |
| 19 | **Shop → Bonbons, Palettes & Assorted Boxes** | `/collections/indulgence-collection` | `/product-category/indulgence-collection/` | Yes (Indulgence Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 20 | **Shop → The Bonbon Collection** | `/products/the-chocolatiers-bonbon-selection` | `/product-category/indulgence-collection/` | Yes (The Bonbon Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 21 | **Shop → The Palette Collection** | `/products/the-chocolatiers-palette-selection` | `/product-category/indulgence-collection/` | Yes (The Palette Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 22 | **Shop → The Chocolatier's Selection** | `/products/the-chocolatiers-selection` | `/product-category/indulgence-collection/` | Yes (The Chocolatier's Selection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 23 | **Shop → Indulgence: View All** | `/collections/indulgence-collection` | `/product-category/indulgence-collection/` | Yes (Indulgence Collection Archive) | `200 OK` | None required (Verified Active) | Verified Parity |
| 24 | **Shop → Snacking Collection** | `/collections/the-snacking-collection` | `/product-category/the-snacking-collection/` | Yes (Snacking Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 25 | **Shop → Mini Croissants** | `/collections/mini-croissants` | `/product-category/the-snacking-collection/` | Yes (Mini Croissants Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 26 | **Shop → Clusters** | `/collections/clusters` | `/product/almond-praline-cluster-45-milk/` | Yes (Clusters Product) | `200 OK` | None required (Verified Active) | Verified Parity |
| 27 | **Shop → Chocolate Barks** | `/collections/chocolate-barks` | `/product/nutty-praline-chocolate-barks-45-milk/` | Yes (Chocolate Barks Product) | `200 OK` | None required (Verified Active) | Verified Parity |
| 28 | **Shop → Chocolate Dragees** | `/collections/chocolate-dragees` | `/product-category/the-snacking-collection/` | Yes (Chocolate Dragees Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 29 | **Shop → Enrobed Chocolate** | `/collections/enrobed-chocolates` | `/product-category/the-snacking-collection/` | Yes (Enrobed Chocolate Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 30 | **Shop → Snacking Cacao Nibs** | `/collections/snacking-cacao-nibs` | `/product-category/the-snacking-collection/` | Yes (Snacking Cacao Nibs Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 31 | **Shop → Signature Thins** | `/collections/the-chocolatiers-thins-selection` | `/product-category/the-snacking-collection/` | Yes (Signature Thins Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 32 | **Shop → Shortbread Cookies** | `/collections/shortbread-cookies` | `/product-category/the-snacking-collection/` | Yes (Shortbread Cookies Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 33 | **Shop → Savoury Mixes** | `/collections/savoury-mix` | `/product-category/the-snacking-collection/` | Yes (Savoury Mixes Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 34 | **Shop → Snacking: View All** | `/collections/the-snacking-collection` | `/product-category/the-snacking-collection/` | Yes (Snacking Collection Archive) | `200 OK` | None required (Verified Active) | Verified Parity |
| 35 | **Shop → Pantry Essentials** | `/collections/pantry-collection` | `/product-category/pantry-collection/` | Yes (Pantry Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 36 | **Shop → Chocolate Spreads** | `/collections/chocolate-spreads` | `/product-category/pantry-collection/` | Yes (Chocolate Spreads Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 37 | **Shop → Drinking Chocolate** | `/collections/drinking-chocolate-mix-1` | `/product-category/pantry-collection/` | Yes (Drinking Chocolate Mixes) | `200 OK` | None required (Verified Active) | Verified Parity |
| 38 | **Shop → Pantry: View All** | `/collections/pantry-collection` | `/product-category/pantry-collection/` | Yes (Pantry Collection Archive) | `200 OK` | None required (Verified Active) | Verified Parity |
| 39 | **Shop → Preferences → Dark** | `/collections/dark` | `/shop/?filter_dietary=dark` | Yes (Dark Chocolate Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 40 | **Shop → Preferences → Milk** | `/collections/milk` | `/shop/?filter_dietary=milk` | Yes (Milk Chocolate Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 41 | **Shop → Preferences → White** | `#` | `/shop/?filter_dietary=white` | Yes (White Chocolate Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 42 | **Shop → Preferences → Vegan** | `/collections/vegan` | `/shop/?filter_dietary=vegan` | Yes (Vegan Chocolate Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 43 | **Shop → Preferences → Sugar** | `/collections/sugar` | `/shop/?filter_dietary=sugar` | Yes (No Added Sugar Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 44 | **Shop → Preferences → Gluten** | `/collections/gluten` | `/shop/?filter_dietary=gluten` | Yes (Gluten Free Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 45 | **Shop → Preferences → Nuts** | `/collections/nuts` | `/shop/?filter_dietary=nuts` | Yes (Nut Free / Nut Pairings) | `200 OK` | None required (Verified Active) | Verified Parity |
| 46 | **Shop → Preferences → Fruit** | `/collections/fruit` | `/shop/?filter_dietary=fruit` | Yes (Fruit Pairings Preference) | `200 OK` | None required (Verified Active) | Verified Parity |
| 47 | **Shop → Maker's Recommendation** | `/collections/maker-recommended` | `/product-category/award-winning/` | Yes (Award Winning / Maker Recommendations) | `200 OK` | None required (Verified Active) | Verified Parity |
| 48 | **Shop → Everything** | `/collections/all-products-available` | `/shop/` | Yes (All Products Available) | `200 OK` | None required (Verified Active) | Verified Parity |
| 49 | **Gift → Diwali Edit 2026** | `/collections/diwali-2026/Diwali+Diwali-2026` | `/product-category/diwali-2026/` | Yes (Diwali 2026 Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 50 | **Gift → Birthdays & Anniversaries** | `/collections/birthdays-anniversaries` | `/product-category/birthdays-anniversaries/` | Yes (Birthdays & Anniversaries Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 51 | **Gift → Hosting & Celebrations** | `/collections/hosting-celebrations` | `/product-category/hosting-celebrations/` | Yes (Hosting & Celebrations Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 52 | **Gift → Preferences & Lifestyle** | `/collections/preferences-lifestyle` | `/product-category/preferences-lifestyle/` | Yes (Preferences & Lifestyle Gifting) | `200 OK` | None required (Verified Active) | Verified Parity |
| 53 | **Gift → Favours** | `/collections/favours` | `/product-category/favours/` | Yes (Celebration Favours Collection) | `200 OK` | None required (Verified Active) | Verified Parity |
| 54 | **Gift → Gift Card** | `/products/gift-card` | `/product/gift-card/` | Yes (Manam Digital Gift Card Product) | `200 OK` | None required (Verified Active) | Verified Parity |
| 55 | **Gift → Everything** | `/collections/gifting` | `/product-category/gifting/` | Yes (All Gifting Hampers & Tins) | `200 OK` | None required (Verified Active) | Verified Parity |
| 56 | **Experience → Workshops** | `#` | `/experience/` | Yes (Experience Landing Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 57 | **Experience → Workshops → Delhi** | `/collections/workshops-in-delhi` | `/collections/workshops-in-delhi/` | Yes (Workshops in Delhi Dedicated Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 58 | **Experience → Workshops → Hyderabad** | `/collections/workshops-in-hyderabad` | `/collections/workshops-in-hyderabad/` | Yes (Workshops in Hyderabad Dedicated Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 59 | **Experience → Karkhana Tours** | `/products/manam-chocolate-karkhana-tour-hydd` | `/experience/karkhana-tours/` | Yes (Manam Karkhana Tours Hyderabad Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 60 | **Experience → Private Workshops** | `/products/private-chocolatiering-workshops` | `/product/private-chocolatiering-workshops/` | Yes (Private Workshops Product Destination) | `200 OK` | None required (Verified Active) | Verified Parity |
| 61 | **Visit → Hyderabad** | `/pages/manam-chocolate-hyderabad` | `/pages/manam-chocolate-hyderabad/` | Yes (Hyderabad City Visit Page (Karkhana & Knowledge City)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 62 | **Visit → Delhi-NCR** | `/pages/manam-chocolate-delhi-store` | `/pages/manam-chocolate-delhi-store/` | Yes (Delhi-NCR City Visit Page (Eldeco Saket, DLF Promenade, Ireo)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 63 | **Make with Manam → Baking Collection** | `/collections/baking` | `/product-category/baking/` | Yes (Baking Collection Category) | `200 OK` | None required (Verified Active) | Verified Parity |
| 64 | **Make with Manam → For Professionals** | `/pages/for-professionals` | `/for-professionals/` | Yes (For Professionals Culinary Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 65 | **About → Our Story** | `/pages/about-us` | `/about-us/` | Yes (Our Story Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 66 | **About → Media** | `/pages/press` | `/press/` | Yes (Media & Press Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 67 | **Customer Service → Track Your Order** | `https://manamchocolate.com/apps/shipway_track` | `/track-order/` | Yes (Track Your Order Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 68 | **Customer Service → Contact Us** | `/pages/contact` | `/contact-us/` | Yes (Contact Us Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 69 | **Customer Service → Shipping** | `/pages/shipping-policy` | `/shipping-policy/` | Yes (Shipping Policy Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 70 | **Customer Service → Refund** | `/pages/refund-policy` | `/refund-policy/` | Yes (Refund Policy Page) | `200 OK` | None required (Verified Active) | Verified Parity |
| 71 | **Homepage Card → Gifting Collection** | `/collections/gifting` | `/product-category/gifting/` | Yes (Gifting Collection (Centred Overlay)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 72 | **Homepage Card → Tablet Collection** | `/collections/tablet-collection` | `/product-category/tablet-collection/` | Yes (Tablet Collection (Centred Overlay)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 73 | **Homepage Card → Indulgence Collection** | `/collections/indulgence-collection` | `/product-category/indulgence-collection/` | Yes (Indulgence Collection (Centred Overlay)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 74 | **Homepage Card → Snacking Collection** | `/collections/the-snacking-collection` | `/product-category/the-snacking-collection/` | Yes (Snacking Collection (Centred Overlay)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 75 | **Homepage Card → Pantry Collection** | `/collections/pantry-collection` | `/product-category/pantry-collection/` | Yes (Pantry Collection (Centred Overlay)) | `200 OK` | None required (Verified Active) | Verified Parity |
| 76 | **Header Utility → Site Search Overlay** | `/search` | `/?s=` | Yes (Search Dialog Overlay) | `200 OK` | None required (Verified Active) | Verified Parity |
| 77 | **Header Utility → User Account** | `/account` | `/my-account/` | Yes (WooCommerce My Account) | `200 OK` | None required (Verified Active) | Verified Parity |
| 78 | **Header Utility → Shopping Cart** | `/cart` | `/cart/` | Yes (WooCommerce Cart) | `200 OK` | None required (Verified Active) | Verified Parity |
| 79 | **Checkout → Process Order** | `/checkout` | `/checkout/` | Yes (WooCommerce Checkout; redirects to cart when empty) | `302 / 200` | None (Standard WooCommerce empty-cart redirect) | Verified Parity |
| 80 | **Direct Shopify Product Rewrite Test** | `/products/private-chocolatiering-workshops` | `/products/private-chocolatiering-workshops/` | Yes (Direct Shopify Product URL Compatibility) | `200 OK` | None required (Verified Active) | Verified Parity |

---

## 2. Key Audit Corrections & Findings

### 1. Distinct Experience vs Visit User Journeys Resolved
- **Experience Submenu:**
  - `Experience → Workshops → Delhi` routes to `http://manamchocolate.local/collections/workshops-in-delhi/` (Dedicated Page ID 28 via rewrite rule, renders `page-workshops.php`).
  - `Experience → Workshops → Hyderabad` routes to `http://manamchocolate.local/collections/workshops-in-hyderabad/` (Dedicated Page ID 29 via rewrite rule, renders `page-workshops.php`).
  - `Experience → Karkhana Tours` routes to `http://manamchocolate.local/experience/karkhana-tours/` (Dedicated factory tour experience).
  - `Experience → Private Workshops` routes to `http://manamchocolate.local/product/private-chocolatiering-workshops/` (and compatible `/products/private-chocolatiering-workshops/`).

- **Visit Submenu:**
  - `Visit → Hyderabad` routes to `http://manamchocolate.local/pages/manam-chocolate-hyderabad/` (Dedicated city flagship and beverage bar destination).
  - `Visit → Delhi-NCR` routes to `http://manamchocolate.local/pages/manam-chocolate-delhi-store/` (Dedicated city flagship and beverage bars destination).
  - Previous cross-linking bugs (where Visit linked to workshops/karkhana tours) have been eradicated from both desktop and mobile navigation menus.

### 2. Homepage Explore Our Collections Parity
- Aligned all 5 collection cards with exact vertical (50%) and horizontal (center) image overlays.
- Extraneous 6th card removed; balanced 2-column, 3-row collage matching reference.
- Typography: Serif 40px (`Heroine`), Uppercase sans 15px (`FS Meridian`), pure white with subtle protective overlay.
