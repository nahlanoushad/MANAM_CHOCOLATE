# Manam Chocolate - WordPress Theme

A custom, bespoke WordPress theme designed and built for the **Manam Chocolate** e-commerce website ([manamchocolate.com](https://manamchocolate.com/)).

---

## Overview

* **Theme Name:** Manam Chocolate
* **Theme Slug:** `manamchocolate`
* **Version:** 1.0.0
* **Platform:** WordPress 6.0+ (Tested up to 7.1)
* **PHP Requirement:** PHP 7.4+ (Tested on PHP 8.2)
* **Text Domain:** `manamchocolate`

---

## Directory & File Structure

```text
manamchocolate/
├── style.css             # Theme metadata and WordPress core required styles
├── functions.php         # Theme features, menus, asset enqueuing, WooCommerce setup
├── header.php            # HTML5 header, navigation, custom logo, wp_head()
├── footer.php            # HTML5 footer, copyright, navigation, wp_footer()
├── front-page.php        # Dedicated front page template
├── index.php             # Primary fallback template with standard loop and pagination
├── page.php              # Standard page template
├── single.php            # Single blog post template with navigation and comments
├── archive.php           # Archive, category, and tag display template
├── search.php            # Search query results and empty results fallback
├── 404.php               # Not found error template with search form
├── assets/
│   ├── css/
│   │   └── main.css      # Core styles, responsive reset, containers, layouts
│   ├── js/
│   │   └── main.js       # Accessible navigation toggle and dropdown scripts
│   └── images/           # Theme image assets directory
└── README.md             # Theme documentation
```

---

## Registered Features & Support

* **Dynamic Document Title:** `title-tag` managed by WordPress core.
* **Featured Images:** `post-thumbnails` enabled for posts and pages.
* **Custom Logo:** Flexible height/width custom logo support.
* **HTML5 Semantic Markup:** `search-form`, `comment-form`, `comment-list`, `gallery`, `caption`, `style`, `script`.
* **Responsive Embeds:** `responsive-embeds` for videos and media embeds.
* **Navigation Menus:**
  * `primary` (Primary Menu)
  * `footer` (Footer Menu)
* **Asset Enqueuing:** Properly enqueued via `wp_enqueue_scripts` with cache-busting version constants.
* **WooCommerce Ready:** Declares `woocommerce` theme support alongside gallery features (`wc-product-gallery-zoom`, `wc-product-gallery-lightbox`, `wc-product-gallery-slider`) and provides container wrappers.

---

## How to Activate the Theme

### Option 1: WordPress Admin Dashboard
1. Log into your WordPress admin dashboard (e.g., `http://manamchocolate.local/wp-admin`).
2. Navigate to **Appearance** &rarr; **Themes**.
3. Locate **Manam Chocolate**.
4. Click **Activate**.

### Option 2: WP-CLI
Run the following command in terminal:
```bash
wp theme activate manamchocolate
```

