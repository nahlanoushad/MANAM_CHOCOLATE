# Manam Chocolate — Original Image Asset Manifest & Mapping

**Project:** Manam Chocolate Website Recreation  
**Official Reference Website:** [https://manamchocolate.com/](https://manamchocolate.com/)  
**Local Development Website:** [http://manamchocolate.local/](http://manamchocolate.local/)  
**Active Custom Theme:** `manamchocolate`  
**Document Status:** Asset Discovery & Replacement Inventory (Pre-Download Audit)  
**Date of Audit:** November 2026  

---

## Executive Summary

This manifest catalogs all visual assets required to transition the **Manam Chocolate** WordPress theme from temporary SVG vector illustrations and dummy placeholders to authentic brand photography from the official reference store.

> [!IMPORTANT]
> **Strict Asset Policy:** This document represents an **asset-discovery audit only**. In accordance with Task 5 & Task 6 guidelines:
> - **Zero files have been downloaded or replaced** during this discovery phase.
> - **No templates or stylesheets have been modified**.
> - Asset downloads and file replacements will begin only after client/brand asset reuse permission is officially confirmed.
> - Hotlinking directly to the Shopify CDN in production theme templates is strictly prohibited.

---

## 1. Existing Placeholder Images Inventory

The following table details all temporary vector assets, placeholders, and dummy assets currently stored in [`wp-content/themes/manamchocolate/assets/images/`](file:///D:/Data%20Analytics%20course/manamchocolate/app/public/wp-content/themes/manamchocolate/assets/images/) and the templates that reference them:

| # | Current Local File | Asset Type | Current Format | Referencing Template(s) | Role / Purpose |
|---|-------------------|------------|----------------|-------------------------|----------------|
| 1 | `brand-cacao-story.svg` | Temporary Illustration | SVG | `front-page.php`, `archive-product.php` | Brand Introduction Desktop visual ("Born in Nature") |
| 2 | `brand-cacao-story-mobile.svg` | Temporary Illustration | SVG | `front-page.php` | Brand Introduction Mobile visual |
| 3 | `collection-gifting.svg` | Temporary Illustration | SVG | `front-page.php`, `page-collections.php`, `archive-product.php` | Gifting Collection card visual |
| 4 | `collection-tablets.svg` | Temporary Illustration | SVG | `front-page.php`, `page-collections.php`, `archive-product.php` | Tablet Collection card visual |
| 5 | `collection-indulgence.svg` | Temporary Illustration | SVG | `front-page.php`, `page-collections.php`, `archive-product.php` | Indulgence Collection card visual |
| 6 | `collection-snacking.svg` | Temporary Illustration | SVG | `front-page.php`, `page-collections.php`, `archive-product.php` | Snacking Collection card visual |
| 7 | `collection-pantry.svg` | Temporary Illustration | SVG | `front-page.php`, `page-collections.php`, `archive-product.php` | Pantry Collection card visual |
| 8 | `karkhana-exterior.svg` | Temporary Illustration | SVG | `section-karkhana.php`, `page-about-us.php`, `page-karkhana-tours.php` | Karkhana Slide 1 fallback |
| 9 | `karkhana-retail.svg` | Temporary Illustration | SVG | `section-karkhana.php` | Karkhana Slide 2 fallback |
| 10 | `karkhana-cafe.svg` | Temporary Illustration | SVG | `section-karkhana.php` | Karkhana Slide 3 fallback |
| 11 | `karkhana-chocolaterie.svg` | Temporary Illustration | SVG | `section-karkhana.php` | Karkhana Slide 4 fallback |
| 12 | `karkhana-roasting.svg` | Temporary Illustration | SVG | `section-karkhana.php` | Karkhana Slide 5 fallback |
| 13 | `craft-farming.jpg` *(Awaiting file)* | Empty / Fallback | Code Block | `section-craft.php` | Our Craft Stage 01 visual |
| 14 | `craft-fermentation.jpg` *(Awaiting file)* | Empty / Fallback | Code Block | `section-craft.php` | Our Craft Stage 02 visual |
| 15 | `craft-making.jpg` *(Awaiting file)* | Empty / Fallback | Code Block | `section-craft.php` | Our Craft Stage 03 visual |
| 16 | `craft-chocolaterie.jpg` *(Awaiting file)* | Empty / Fallback | Code Block | `section-craft.php` | Our Craft Stage 04 visual |
| 17 | `hero-desktop.jpg` *(Awaiting file)* | CSS Glow Fallback | Code Block | `front-page.php` | Homepage Promotional Hero (Desktop) |
| 18 | `hero-mobile.jpg` *(Awaiting file)* | CSS Glow Fallback | Code Block | `front-page.php` | Homepage Promotional Hero (Mobile) |
| 19 | `experience-workshop-delhi.svg` | Temporary Illustration | SVG | `page-workshops.php` | Delhi Workshop collection header |
| 20 | `experience-workshop-hyderabad.svg` | Temporary Illustration | SVG | `page-workshops.php` | Hyderabad Workshop collection header |
| 21 | `experience-private-workshop.svg` | Temporary Illustration | SVG | `content-single-product.php` | Private Workshop product fallback |
| 22 | `experience-karkhana-tours.svg` | Temporary Illustration | SVG | `page-karkhana-tours.php` | Karkhana Tours page header |
| 23 | `about-fermentary-hero.svg` | Temporary Illustration | SVG | `page-about-us.php` | About Us Hero banner |
| 24 | `about-big-chocolate.svg` | Temporary Illustration | SVG | `page-about-us.php` | About Us Big Chocolate section |
| 25 | `about-bean-to-bar.svg` | Temporary Illustration | SVG | `page-about-us.php` | About Us Bean-to-Bar section |
| 26 | `about-edition-2023.svg` | Temporary Illustration | SVG | `page-about-us.php` | About Us Indian Craft Edition 2023 |
| 27 | `about-farmer-prasad.svg` | Temporary Illustration | SVG | `page-about-us.php` | Farmer GVS Prasad portrait |
| 28 | `about-farmer-rao.svg` | Temporary Illustration | SVG | `page-about-us.php` | Farmer GP Rao portrait |
| 29 | `about-process-step.svg` | Temporary Illustration | SVG | `page-about-us.php` | Cacao Fermentery process steps |
| 30 | `press-article-placeholder.svg` | Temporary Illustration | SVG | `page-press.php`, `functions.php` | Editorial News article thumbnail fallback |
| 31 | `product-placeholder.svg` | Temporary Illustration | SVG | `section-discover.php`, `content-product.php`, `content-single-product.php` | WooCommerce product catalog placeholder |
| 32 | `cacao-origin-seal.svg` | Brand Graphic | SVG | `footer.php`, `page-about-us.php` | West Godavari Cacao Origin Emblem |
| 33 | `manam-and-distinct.svg` | Brand Graphic | SVG | `footer.php`, `page-about-us.php` | Manam + Distinct Origins lockup |

---

## 2. Comprehensive Image Mapping Table

The following master table maps each website section, placeholder asset, verified original Shopify CDN source URL, master dimensions, and designated target local filename:

| Website Section | Original Image Source URL (Master CDN) | Original Filename | Master Dimensions | Required Local Filename |
|---|---|---|---|---|
| **Header Wordmark Logo** | `https://manamchocolate.com/cdn/shop/files/Manam_Logo_Wordmark_280x.png?v=1692967604` | `Manam_Logo_Wordmark_280x.png` | 3626 &times; 1002 | `Manam_Logo_Wordmark_280x.png` |
| **Hero Banner (Desktop)** | `https://manamchocolate.com/cdn/shop/files/diwali_desktop_homepage_-_2160px_X_1080px.jpg?v=1792999591` | `diwali_desktop_homepage_-_2160px_X_1080px.jpg` | 2160 &times; 1080 | `hero-desktop.jpg` |
| **Hero Banner (Mobile)** | `https://manamchocolate.com/cdn/shop/files/diwali_mobile_homepage_-_1000px_X_1400px.jpg?v=1792999543` | `diwali_mobile_homepage_-_1000px_X_1400px.jpg` | 1000 &times; 1400 | `hero-mobile.jpg` |
| **Hero Alt Slide (Desktop)** | `https://manamchocolate.com/cdn/shop/files/2160-x-1080-px---manam_1.jpg?v=1793621681` | `2160-x-1080-px---manam_1.jpg` | 2160 &times; 1080 | `hero-desktop-slide2.jpg` |
| **Hero Alt Slide (Mobile)** | `https://manamchocolate.com/cdn/shop/files/1000-x-1400-px---manam_1.jpg?v=1793621714` | `1000-x-1400-px---manam_1.jpg` | 1000 &times; 1400 | `hero-mobile-slide2.jpg` |
| **Gifting Collection Card** | `https://manamchocolate.com/cdn/shop/files/Rectangle_6.webp?v=1761280577` | `Rectangle_6.webp` | 1000 &times; 603 | `collection-gifting.webp` |
| **Tablet Collection Card** | `https://manamchocolate.com/cdn/shop/files/Rectangle_4.png?v=1708765178` | `Rectangle_4.png` | 1240 &times; 746 | `collection-tablets.png` |
| **Indulgence Collection Card** | `https://manamchocolate.com/cdn/shop/files/Collection_Banner_Recovered_-09_1.jpg?v=1709055658` | `Collection_Banner_Recovered_-09_1.jpg` | 3334 &times; 2020 | `collection-indulgence.jpg` |
| **Snacking Collection Card** | `https://manamchocolate.com/cdn/shop/files/Rectangle_23.png?v=1708765349` | `Rectangle_23.png` | 1240 &times; 746 | `collection-snacking.png` |
| **Pantry Collection Card** | `https://manamchocolate.com/cdn/shop/files/Pantry_mainpage.jpg?v=1737361829` | `Pantry_mainpage.jpg` | 800 &times; 550 | `collection-pantry.jpg` |
| **Brand Intro (Desktop)** | `https://manamchocolate.com/cdn/shop/files/Illustration.jpg?v=1694585024` | `Illustration.jpg` | 1920 &times; 1440 | `brand-cacao-story.jpg` |
| **Brand Intro (Mobile)** | `https://manamchocolate.com/cdn/shop/files/Rectangle_115.jpg?v=1695122498` | `Rectangle_115.jpg` | 780 &times; 548 | `brand-cacao-story-mobile.jpg` |
| **Our Craft Stage 01 (Farming)** | `https://manamchocolate.com/cdn/shop/files/preview_images/bfdf92fc838f4d118ccc983287c85577.thumbnail.0000000000.jpg` | `bfdf92fc838f4d118ccc983287c85577.thumbnail.0000000000.jpg` | 720 &times; 720 (1:1) | `craft-farming.jpg` |
| **Our Craft Stage 02 (Fermentation)**| `https://manamchocolate.com/cdn/shop/files/preview_images/8d10e387fe2c415baff5f3e374cd73a0.thumbnail.0000000000.jpg` | `8d10e387fe2c415baff5f3e374cd73a0.thumbnail.0000000000.jpg` | 720 &times; 720 (1:1) | `craft-fermentation.jpg` |
| **Our Craft Stage 03 (Making)** | `https://manamchocolate.com/cdn/shop/files/preview_images/fc8a704cb25647aa90324b1a19e469b6.thumbnail.0000000000.jpg` | `fc8a704cb25647aa90324b1a19e469b6.thumbnail.0000000000.jpg` | 720 &times; 720 (1:1) | `craft-making.jpg` |
| **Our Craft Stage 04 (Chocolatiering)**| `https://manamchocolate.com/cdn/shop/files/preview_images/74fc10e3916c46bfaaff30673f33c458.thumbnail.0000000000.jpg` | `74fc10e3916c46bfaaff30673f33c458.thumbnail.0000000000.jpg` | 720 &times; 720 (1:1) | `craft-chocolaterie.jpg` |
| **Our Craft Stage BG Texture** | `https://manamchocolate.com/cdn/shop/files/Rectangle_1.png?v=1694430320` | `Rectangle_1.png` | 450 &times; 450 | `craft-timeline-pattern.png` |
| **Publication Logo: TIME** | `https://manamchocolate.com/cdn/shop/files/2024_-_TIME_World_s_Greatest_Places_-_RGB.png?v=1726068227` | `2024_-_TIME_World_s_Greatest_Places_-_RGB.png` | 1022 &times; 1146 | `press-logo-time.png` |
| **Publication Logo: Travel+Leisure**| `https://manamchocolate.com/cdn/shop/files/Artboard_2_copy_7_276e4334-3bd1-4708-83c8-a826603c7334.png?v=1708847240` | `Artboard_2_copy_7...png` | 451 &times; 141 | `press-logo-travel-leisure.png` |
| **Publication Logo: The Hindu** | `https://manamchocolate.com/cdn/shop/files/Artboard_2_copy_11.png?v=1708847240` | `Artboard_2_copy_11.png` | 451 &times; 141 | `press-logo-the-hindu.png` |
| **Publication Logo: The Week** | `https://manamchocolate.com/cdn/shop/files/Artboard_2_copy_2.png?v=1695275081` | `Artboard_2_copy_2.png` | 451 &times; 141 | `press-logo-the-week.png` |
| **Publication Logo: CNT** | `https://manamchocolate.com/cdn/shop/files/Artboard_2_copy_10_5ac1652e-597d-4751-b024-9745b95db2b2.png?v=1708847240` | `Artboard_2_copy_10...png` | 451 &times; 141 | `press-logo-cnt.png` |
| **Publication Logo: Forbes** | `https://manamchocolate.com/cdn/shop/files/Forbes-removebg-preview_8df809aa-09a2-4c0f-b11a-7b610a7c166f.png` | `Forbes-removebg-preview...png` | 187 &times; 50 | `press-logo-forbes.png` |
| **Karkhana Slide 1: Exterior** | `https://manamchocolate.com/cdn/shop/files/1.jpg?v=1709190144` | `1.jpg` | 3000 &times; 1500 (2:1) | `karkhana-exterior.jpg` |
| **Karkhana Slide 2: Retail** | `https://manamchocolate.com/cdn/shop/files/Artboard_2.jpg?v=1709190201` | `Artboard_2.jpg` | 3000 &times; 1500 (2:1) | `karkhana-retail.jpg` |
| **Karkhana Slide 3: Café** | `https://manamchocolate.com/cdn/shop/files/Artboard_3.jpg?v=1709190201` | `Artboard_3.jpg` | 3000 &times; 1500 (2:1) | `karkhana-cafe.jpg` |
| **Karkhana Slide 4: Chocolaterie**| `https://manamchocolate.com/cdn/shop/files/Artboard_4.jpg?v=1709190201` | `Artboard_4.jpg` | 3000 &times; 1500 (2:1) | `karkhana-chocolaterie.jpg` |
| **Karkhana Slide 5: Roasting** | `https://manamchocolate.com/cdn/shop/files/Artboard_5.jpg?v=1709190201` | `Artboard_5.jpg` | 3000 &times; 1500 (2:1) | `karkhana-roasting.jpg` |
| **Private Chocolatiering Creative**| `https://manamchocolate.com/cdn/shop/files/Manam_privateworkshopad_9July26_1.png?v=1784137711` | `Manam_privateworkshopad_9July26_1.png` | 2250 &times; 2251 (1:1) | `experience-private-workshop.png` |
| **About Us: Fermentary Hero** | `https://manamchocolate.com/cdn/shop/files/We_are_manam-_about.jpg?v=1696586575` | `We_are_manam-_about.jpg` | 2000 &times; 980 (~2:1) | `about-fermentary-hero.jpg` |
| **About Us: Big Chocolate** | `https://manamchocolate.com/cdn/shop/files/Rectangle_122.jpg?v=1696316201` | `Rectangle_122.jpg` | 1400 &times; 1400 (1:1) | `about-big-chocolate.jpg` |
| **About Us: Bean-to-Bar** | `https://manamchocolate.com/cdn/shop/files/Bean-to-Bar_Chocolate.jpg?v=1696947371` | `Bean-to-Bar_Chocolate.jpg` | 1400 &times; 1400 (1:1) | `about-bean-to-bar.jpg` |
| **About Us: Edition 2023** | `https://manamchocolate.com/cdn/shop/files/Indian_Craft_Chocolate_Edition_2023-_about_us.jpg?v=1696945274` | `Indian_Craft_Chocolate_Edition_2023-_about_us.jpg` | 1400 &times; 1400 (1:1) | `about-edition-2023.jpg` |
| **About Us: Farmer Prasad** | `https://manamchocolate.com/cdn/shop/files/preview_images/07ae31f9cafd46b68eb10ad4a2fea4cd.thumbnail.0000000000.jpg` | `07ae31f9cafd46b68eb10ad4a2fea4cd...jpg` | 720 &times; 720 (1:1) | `about-farmer-prasad.jpg` |
| **About Us: Farmer GP Rao** | `https://manamchocolate.com/cdn/shop/files/preview_images/b304bea1c64e42e285683210670da106.thumbnail.0000000000.jpg` | `b304bea1c64e42e285683210670da106...jpg` | 720 &times; 720 (1:1) | `about-farmer-rao.jpg` |
| **About Us: Fermentation Step 1** | `https://cdn.shopify.com/s/files/1/0720/8311/2212/files/301.jpg?v=1696947069` | `301.jpg` | 1000 &times; 1000 (1:1) | `about-process-step-1.jpg` |
| **About Us: Fermentation Step 2** | `https://cdn.shopify.com/s/files/1/0720/8311/2212/files/302.jpg?v=1696947069` | `302.jpg` | 1000 &times; 1000 (1:1) | `about-process-step-2.jpg` |
| **About Us: Fermentation Step 3** | `https://cdn.shopify.com/s/files/1/0720/8311/2212/files/303.jpg?v=1696947069` | `303.jpg` | 1000 &times; 1000 (1:1) | `about-process-step-3.jpg` |
| **About Us: Fermentation Step 4** | `https://cdn.shopify.com/s/files/1/0720/8311/2212/files/304.jpg?v=1696947069` | `304.jpg` | 1000 &times; 1000 (1:1) | `about-process-step-4.jpg` |
| **Press Article: TIME** | `https://manamchocolate.com/cdn/shop/files/TIME.jpg?v=1726067756` | `TIME.jpg` | 2000 &times; 1000 (2:1) | `press-article-time.jpg` |
| **Press Article: The Week** | `https://manamchocolate.com/cdn/shop/files/the_week.jpg?v=1726067822` | `the_week.jpg` | 1000 &times; 600 (~1.66:1) | `press-article-the-week.jpg` |
| **Press Article: India Today** | `https://manamchocolate.com/cdn/shop/files/untitled_design_-_2024-05-24t103648.035.webp?v=1716628588` | `untitled_design_-_2024-05-24t103648.035.webp` | 500 &times; 500 (1:1) | `press-article-india-today.webp` |
| **Press Article: Homegrown** | `https://manamchocolate.com/cdn/shop/files/655de26b6458330bd4cd975f_1700651627441.webp?v=1716629494` | `655de26b6458330bd4cd975f_1700651627441.webp` | 500 &times; 500 (1:1) | `press-article-homegrown.webp` |
| **Press Article: CNT** | `https://manamchocolate.com/cdn/shop/files/1.jpg?v=1709190144` | `1.jpg` | 2160 &times; 1080 (2:1) | `press-article-cnt.jpg` |
| **Footer Emblem (Desktop)** | `https://manamchocolate.com/cdn/shop/files/IMAGE.png?v=1722433913` | `IMAGE.png` | 333 &times; 381 | `cacao-origin-seal.png` |
| **Footer Emblem (Mobile)** | `https://cdn.shopify.com/s/files/1/0720/8311/2212/files/image_4.png?v=1708939353` | `image_4.png` | 280 &times; 320 | `cacao-origin-seal-mobile.png` |
| **Footer Brand Lockup** | `https://manamchocolate.com/cdn/shop/files/Manam_and_Distinct.svg?v=1694176985` | `Manam_and_Distinct.svg` | 209 &times; 43 | `manam-and-distinct.svg` |

---

## 3. WooCommerce Product Catalog Image Mapping (13 Products)

Each product on the official store features a 4:5 vertical portrait aspect ratio (`1080 × 1350` or `2250 × 2813`) with two primary states:
1. **Primary Card Image** (Default display in grids and single-product hero).
2. **Hover / Secondary Image** (Reveals confectionery details, unpacked tablet, or gift packaging upon hover).

| Product ID & Slug | Product Name | Primary Card Image (Cover) | Secondary / Hover Image |
|---|---|---|---|
| **#12 `the-chocolatiers-thins-selection`** | The Chocolatier's Thins Selection | `https://manamchocolate.com/cdn/shop/files/cover.jpg?v=1708932684` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/Hover.jpg?v=1709060662` (`1080×1350`) |
| **#13 `almond-praline-cluster-45-milk`** | Almond Praline Cluster - 45% Milk | `https://manamchocolate.com/cdn/shop/files/Almond_Clusters_2.png?v=1774614671` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/04_e0a3cbaa-1152-4d7a-a860-ab3b322635eb.jpg?v=1774614671` (`1080×1350`) |
| **#14 `indian-origin-tablet-no-5-80-dark`**| Indian Origin Tablet No. 5 - 80% Dark | `https://manamchocolate.com/cdn/shop/files/Indian_Origin_Tablet_No._5_-01.webp?v=1747115284` (`2250×2813`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_06745f24-ec90-468c-9e1a-fd5ab1901c74.jpg?v=1747115284` (`1080×1350`) |
| **#15 `indian-origin-tablet-no-8-100-dark`**| Indian Origin Tablet No. 8 - 100% Dark | `https://manamchocolate.com/cdn/shop/files/Indian_Origin_Tablet_No._8_-07.webp?v=1773836192` (`2250×2813`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_8ae65e88-06e6-41d4-b176-39f5f5014e31.jpg?v=1773836192` (`1080×1350`) |
| **#16 `the-chocolatiers-celebration-tin-1`**| The Chocolatier's Celebration Tin - 1 (Rectangle) | `https://manamchocolate.com/cdn/shop/files/01-Cover_d16c1b56-480d-4937-8183-0affb6722302.jpg?v=1709095094` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_9dac95e3-c354-4b54-98b5-3ccf5cae78eb.jpg?v=1709095094` (`1080×1350`) |
| **#17 `the-tablet-library-10-pcs`** | The Tablet Library - 10 Pcs | `https://manamchocolate.com/cdn/shop/files/10pc_-_40g_a.png?v=1726326627` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/10pc_-_40g_b.png?v=1726326626` (`1080×1350`) |
| **#18 `the-chocolatiers-celebration-tin-2`**| The Chocolatier's Celebration Tin - 2 (Round) | `https://manamchocolate.com/cdn/shop/files/01-Cover_1.jpg?v=1709095304` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_1.jpg?v=1709095304` (`1080×1350`) |
| **#19 `the-chocolatiers-celebration-tin-3`**| The Chocolatier's Celebration Tin - 3 (Square) | `https://manamchocolate.com/cdn/shop/files/01-Cover_2.jpg?v=1709095495` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_2.jpg?v=1709095495` (`1080×1350`) |
| **#20 `indian-origin-tablet-no-3-67-dark`**| Indian Origin Tablet No. 3 - 67% Dark | `https://manamchocolate.com/cdn/shop/files/Indian_Origin_Tablet_No._3-05.png?v=1747114845` (`2251×2814`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_cacdc19b-0dfd-44aa-a2f7-3f4b1b634df7.jpg?v=1747114845` (`1080×1350`) |
| **#21 `nutty-praline-chocolate-barks-45-milk`**| Nutty Praline Chocolate Barks - 45% Milk | `https://manamchocolate.com/cdn/shop/files/Nutty-praline-chocolate-barks_corrected.jpg?v=1774614238` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/02-Hover_b7b6426b-9fea-4c13-9858-98c90b1e60c1.jpg?v=1774614238` (`1080×1350`) |
| **#22 `sea-salt-cacao-nibs`** | Sea Salt Cacao Nibs | `https://manamchocolate.com/cdn/shop/files/Sea_Salt_Nibs_2.png?v=1774614686` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/Sea_Salt_Nibs_1.png?v=1774614686` (`1080×1350`) |
| **#23 `sweet-curry-leaf-shortbread-cookies-white-chocolate`**| Sweet Curry Leaf Shortbread Cookies - White Chocolate | `https://manamchocolate.com/cdn/shop/files/Sweet_Curry_1.png?v=1725872761` (`1080×1350`) | `https://manamchocolate.com/cdn/shop/files/Sweet_Curry_2.png?v=1725872761` (`1080×1350`) |
| **#32 `private-chocolatiering-workshops`**| Private Chocolatiering Workshops | `https://manamchocolate.com/cdn/shop/files/Manam_privateworkshopad_9July26_1.png?v=1784137711` (`2250×2251`) | *Single-image inquiry product (No hover)* |

---

## 4. Image Quality, Aspect Ratios & Technical Specifications

To preserve visual fidelity and avoid distorted layouts, all replacement images should adhere to their original aspect ratios:

1. **Promotional Hero Banners:**
   - **Desktop:** `2160 × 1080` (Aspect ratio `2:1` landscape). Optimal display for viewports &ge; 1024px.
   - **Mobile:** `1000 × 1400` (Aspect ratio `5:7` portrait). Optimal display for viewports &le; 767px.
2. **Collection Cards (Explore Our Collections):**
   - **Dimensions:** Approximately `1000 × 600` to `1240 × 746` (Aspect ratio ~ `1.66:1` landscape).
   - Formats: High-compression WebP or PNG for graphic elements.
3. **Brand Introduction ("Born in Nature"):**
   - **Desktop:** `1920 × 1440` (Aspect ratio `4:3`).
   - **Mobile:** `780 × 548` (Aspect ratio ~ `1.42:1`).
4. **Our Craft Stages:**
   - **Dimensions:** `720 × 720` square (`1:1`).
   - Note: The reference site delivers MP4 micro-video loops (`720p 1.6Mbps`) with static poster thumbnails (`720×720`). If the project remains photographic, these 4 square posters provide the exact authentic visual stills.
5. **Karkhana Flagship Panoramic Slides:**
   - **Dimensions:** `3000 × 1500` (Strict `2:1` cinematic widescreen).
   - Stored in theme as `karkhana-exterior.jpg`, `karkhana-retail.jpg`, `karkhana-cafe.jpg`, `karkhana-chocolaterie.jpg`, and `karkhana-roasting.jpg`.
6. **WooCommerce Product Cards:**
   - **Dimensions:** `1080 × 1350` (Strict `4:5` vertical portrait ratio).
   - Master files for tablets are available up to `2251 × 2814`, allowing sharp zoom in single product gallery view.
7. **Press / Publication Logos:**
   - **Dimensions:** Clean transparent PNGs (`451 × 141` for horizontal mastheads; `1022 × 1146` for TIME seal).

---

## 5. Desktop / Mobile Image Variants

The reference site employs `<picture>` elements and media queries to serve distinct compositions for desktop and handheld displays. When replacing assets, both variants must be matched:

| Content Element | Desktop Asset (`min-width: 1000px`) | Mobile Asset (`max-width: 767px` / `999px`) | Rationale |
|---|---|---|---|
| **Promotional Hero** | `diwali_desktop_homepage_-_2160px_X_1080px.jpg` (`2:1`) | `diwali_mobile_homepage_-_1000px_X_1400px.jpg` (`5:7`) | Desktop wide layout vs. mobile full-screen vertical composition |
| **Brand Introduction** | `Illustration.jpg` (`1920×1440` botanical landscape) | `Rectangle_115.jpg` (`780×548` focused mobile crop) | Prevents botanical grove art from shrinking into an illegible band on smartphones |
| **Footer Seal / Emblem** | `IMAGE.png` (`333×381` desktop emblem) | `image_4.png` (`280×320` mobile emblem) | Compact padding for mobile footer stacking |
| **Footer Brand Lockup** | `Manam_and_Distinct.svg` (`209×43`) | `Manam_and_Distinct_1.png` | Optimized raster rendering on smaller screens |

---

## 6. Missing Images & Reference Edge Cases

During our exhaustive crawl of the reference website, the following specific observations and edge cases were identified:

1. **Workshops Collection Headers (Delhi & Hyderabad):**
   - The official URLs `https://manamchocolate.com/collections/workshops-in-delhi` and `https://manamchocolate.com/collections/workshops-in-hyderabad` contain **no photographic banner images**.
   - The live pages feature minimalist typography above the notification form: `"Leave us your contact information to get workshop updates!"`.
   - *Recommendation:* Our theme templates currently provide graceful fallback to custom vector artwork (`experience-workshop-delhi.svg` and `experience-workshop-hyderabad.svg`). If photographic headers are desired, the brand's approved workshop creative (`Manam_privateworkshopad_9July26_1.png`) or Karkhana interior photography can be assigned.
2. **Karkhana Tours Booking URL:**
   - As documented in Phase 14, `https://manamchocolate.com/products/manam-chocolate-karkhana-tour-hydd` returns **HTTP 404** on the live reference website. No separate bookable tour ticket photography exists on Shopify.
   - The 5 panoramic slides from the homepage Karkhana showcase (`1.jpg`, `Artboard_2.jpg`, `Artboard_3.jpg`, `Artboard_4.jpg`, `Artboard_5.jpg`) serve as the verified visual identity for Karkhana Tours.
3. **Our Craft Video Loops vs. Stills:**
   - The live site presents four `<video autoplay loop muted>` MP4 streams (`bfdf92fc838f...mp4`, `8d10e387...mp4`, `fc8a704c...mp4`, `74fc10e3...mp4`).
   - The high-resolution poster stills (`.thumbnail.0000000000.jpg`) correspond directly to the local filenames `craft-farming.jpg`, `craft-fermentation.jpg`, `craft-making.jpg`, and `craft-chocolaterie.jpg`.

---

## 7. Images Requiring Explicit Permission Confirmation

Prior to initiating asset downloads or committing them to the local WordPress Media Library/repository, the project team must verify copyright licensing and brand usage authorization for the following categories:

1. **Proprietary Packaging & Creative Renders:**
   - 3D product renders and commercial packaging artwork for tablets, bonbon selections, celebration tins, and barks.
2. **Farmer Community Portraits:**
   - Photographs and video stills of cacao farmers (GVS Prasad, GP Rao) in West Godavari, Andhra Pradesh.
3. **Flagship Architectural & Retail Photography:**
   - Interior and exterior architectural photography of the Manam Chocolate Karkhana on Road No. 12, Banjara Hills, Hyderabad.
4. **Editorial & Publication Trademarks:**
   - Registered mastheads and logos of **TIME Magazine**, **Travel + Leisure**, **The Hindu**, **The Week**, **Condé Nast Traveler**, and **Forbes**.
   - Note: The WordPress theme currently renders these publications as styled CSS wordmarks, avoiding potential trademark embedding while preserving the authentic layout.
5. **Brand Emblems & Seals:**
   - Distinct Origins lockup (`Manam_and_Distinct.svg`) and the official Indian Cacao origin seal (`IMAGE.png`).

---

## 8. Next Steps & Workflow Recommendations

When asset reuse permission is officially confirmed by the project owner:

1. **Download Phase:** Use a scripted batch process to retrieve the highest-resolution master files from the verified URLs listed in Section 2 & Section 3 without query parameter compression.
2. **Web Optimization:** Compress images to modern formats (WebP/AVIF alongside progressive JPEG/PNG fallbacks) while retaining original dimensions.
3. **Placement:** Place static theme assets into `wp-content/themes/manamchocolate/assets/images/` and import product images into WooCommerce via `wp_insert_attachment()` linking to respective product IDs.
4. **Verification:** Inspect all 8 templates across 1440px desktop down to 360px mobile viewports to guarantee pixel-perfect responsiveness and zero layout shift.

---

## 9. Stage 4 – Experience & Workshop Imagery Asset Integration

In Stage 4, all verified master photographs for the Experience and Workshop destinations were integrated using official Manam Chocolate assets downloaded directly from Shopify CDN (`https://manamchocolate.com/cdn/shop/files/`) and registered into the WordPress Media Library with full responsive sub-sizes.

| Local Asset Filename | Dimensions | Original Source URL / Reference File | WP Attach ID | Usage & Template | Descriptive Alt Text |
|:---|:---|:---|:---:|:---|:---|
| `experience-workshop-delhi.jpg` | 3000 × 1999 | `https://manamchocolate.com/cdn/shop/files/Manam_Chocolate_New_Delhi_photo_courtesy_Noughts_and_Crosses_319_1.jpg` | 75 | `page-workshops.php` (Delhi Desktop Hero), `page-experience.php` (Delhi Showcase Card) | Manam Chocolate craft chocolatiering workshop venue at Eldeco Center, Saket, New Delhi |
| `experience-workshop-delhi-listing.jpg` | 2160 × 2160 | `https://manamchocolate.com/cdn/shop/files/Eldeco_Store_Image_Listing_SML.jpg` | 66 | `page-workshops.php` (Delhi Mobile Hero `<picture>`) | Eldeco Center Saket storefront and craft chocolate studio |
| `experience-workshop-hyderabad.jpg` | 2801 × 1401 | `https://manamchocolate.com/cdn/shop/files/Karkhana_desktop_1.jpg` | 76 | `page-workshops.php` (Hyderabad Desktop Hero), `page-karkhana-tours.php` (Desktop Hero), `page-experience.php` (Hyderabad Card) | Manam Chocolate Karkhana craft chocolate masterclass and factory floor in Banjara Hills, Hyderabad |
| `experience-workshop-hyderabad-mobile.jpg` | 1801 × 1801 | `https://manamchocolate.com/cdn/shop/files/Karkhana_mobile_1.jpg` | 68 | `page-workshops.php` (Hyderabad Mobile Hero `<picture>`), `page-karkhana-tours.php` (Mobile Hero) | Manam Chocolate Karkhana craft chocolate masterclass and factory floor (Mobile) |
| `experience-karkhana-cafe.jpg` | 2801 × 1401 | `https://manamchocolate.com/cdn/shop/files/KC_desktop_2.jpg` | 77 | `page-experience.php` (Destination Banner), `page-karkhana-tours.php` (Highlight 04) | Artisanal chocolate café and tasting salon at Manam Chocolate Karkhana, Hyderabad |
| `experience-karkhana-cafe-mobile.jpg` | 1801 × 1801 | `https://manamchocolate.com/cdn/shop/files/KC_mobile_2.jpg` | 70 | `page-experience.php` (Mobile Destination Banner) | Artisanal chocolate café and tasting salon at Manam Chocolate Karkhana, Hyderabad (Mobile) |
| `experience-private-workshop.png` | 2250 × 2251 | `https://manamchocolate.com/cdn/shop/files/Manam_privateworkshopad_9July26_1.png` | 71 | `page-experience.php` (Private Workshops Card), WooCommerce Product 32 Primary (`private-chocolatiering-workshops-primary.png`) | Manam Chocolate private chocolatiering workshops and group masterclasses creative artwork |
| `karkhana-exterior-flagship.jpg` | 2160 × 1080 | `https://manamchocolate.com/cdn/shop/files/1.jpg` | 72 | `page-karkhana-tours.php` (Exterior Showcase), `page-experience.php` (Karkhana Tours Card) | Architectural exterior view of Manam Chocolate Karkhana flagship in Banjara Hills, Hyderabad |
| `karkhana-chocolaterie-lab.jpg` | 2160 × 1080 | `https://manamchocolate.com/cdn/shop/files/Artboard_3.jpg` | 73 | `page-karkhana-tours.php` (Highlight 03 - Chocolatiering Laboratory) | Observation windows of the chocolatiering laboratory inside Manam Chocolate Karkhana |
| `karkhana-roasting-room.jpg` | 2160 × 1080 | `https://manamchocolate.com/cdn/shop/files/Artboard_4.jpg` | 74 | `page-karkhana-tours.php` (Highlight 01 & 02 - Cacao Roasting & Melangers) | Cacao roasting, winnowing, and granite stone melangers refining cacao liquor |

---

## 10. Stage 5 – Remaining Website Pages & Destinations Asset Integration

In Stage 5, nineteen (19) authentic photographic assets from the official Manam Chocolate Shopify infrastructure were downloaded, optimized, registered into the WordPress Media Library with full responsive thumbnails, and assigned across WooCommerce product records and custom destination templates.

### 10.1 Registered Visual Assets (Attachment IDs 78 – 96)

| Local Asset Filename | Dimensions | Original Source URL | WP Attach ID | Usage / Template / Product ID | Descriptive Alt Text |
|:---|:---|:---|:---:|:---|:---|
| `gift-card-master.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/gift-card_fbbab3fc-555e-49b2-a42e-1498b8c7bf90.jpg` | 78 | WC Product 97 (`gift-card`), `content-single-product.php` | Manam Chocolate Digital Gift Card with golden signature typography |
| `baking-collection-desktop-banner.jpg` | 3840 × 1400 | `https://manamchocolate.com/cdn/shop/collections/baking_desktop_banner.jpg` | 79 | `archive-product.php` (Baking Category Desktop Hero) | Manam Chocolate artisanal chocolate baking tablets, natural cacao powder, and nibs collection banner |
| `baking-collection-mobile-banner.jpg` | 1080 × 1080 | `https://manamchocolate.com/cdn/shop/collections/baking_mobile_banner.jpg` | 80 | `archive-product.php` (Baking Category Mobile Hero) | Manam Chocolate artisanal chocolate baking collection banner (Mobile) |
| `baking-cacao-powder-1.png` | 2000 × 2000 | `https://manamchocolate.com/cdn/shop/files/NaturalCacaoPowderNo.1-WestGodavari_200g_Front.png` | 81 | WC Product 98 Primary (`natural-cacao-powder-no-1-west-godavari`) | Natural Cacao Powder No. 1 - West Godavari 200g front pouch packaging |
| `baking-cacao-powder-2.png` | 2000 × 2000 | `https://manamchocolate.com/cdn/shop/files/NaturalCacaoPowderNo.1-WestGodavari_200g_Back.png` | 82 | WC Product 98 Gallery (`natural-cacao-powder-no-1-west-godavari`) | Natural Cacao Powder No. 1 - West Godavari 200g nutrition and baking guidelines |
| `baking-tablet-80-dark-1.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/01_7_72945d82-8959-4d8c-a115-4fa815e9a4f8.jpg` | 83 | WC Product 99 Primary (`chocolate-baking-tablet-no-4-80-extra-dark`) | Chocolate Baking Tablet No. 4 - 80% Extra Dark 250g packaging box |
| `baking-tablet-80-dark-2.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/02_7.jpg` | 84 | WC Product 99 Gallery (`chocolate-baking-tablet-no-4-80-extra-dark`) | Chocolate Baking Tablet No. 4 - 80% Extra Dark reverse specifications |
| `baking-tablet-60-dark-1.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/01_5.jpg` | 85 | WC Product 100 Primary (`chocolate-baking-tablet-no-2-60-dark`) | Chocolate Baking Tablet No. 2 - 60% Dark 250g packaging box |
| `baking-tablet-60-dark-2.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/02_5.jpg` | 86 | WC Product 100 Gallery (`chocolate-baking-tablet-no-2-60-dark`) | Chocolate Baking Tablet No. 2 - 60% Dark reverse specifications |
| `baking-cacao-nibs-1.png` | 2000 × 2000 | `https://manamchocolate.com/cdn/shop/files/BakingCacaoNibs_200g_Front.png` | 87 | WC Product 101 Primary (`baking-cacao-nibs`) | Baking Cacao Nibs 200g front pouch packaging |
| `baking-cacao-nibs-2.png` | 2000 × 2000 | `https://manamchocolate.com/cdn/shop/files/BakingCacaoNibs_200g_Back.png` | 88 | WC Product 101 Gallery (`baking-cacao-nibs`) | Baking Cacao Nibs 200g origin details and culinary use notes |
| `baking-tablet-45-milk-1.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/01_4.jpg` | 89 | WC Product 102 Primary (`chocolate-baking-tablet-no-1-45-milk`) | Chocolate Baking Tablet No. 1 - 45% Milk 250g packaging box |
| `baking-tablet-45-milk-2.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/02_4.jpg` | 90 | WC Product 102 Gallery (`chocolate-baking-tablet-no-1-45-milk`) | Chocolate Baking Tablet No. 1 - 45% Milk reverse specifications |
| `baking-tablet-white-1.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/01_8.jpg` | 91 | WC Product 103 Primary (`chocolate-baking-tablet-no-5-white`) | Chocolate Baking Tablet No. 5 - White Chocolate 250g packaging box |
| `baking-tablet-white-2.jpg` | 2048 × 2048 | `https://manamchocolate.com/cdn/shop/files/02_8.jpg` | 92 | WC Product 103 Gallery (`chocolate-baking-tablet-no-5-white`) | Chocolate Baking Tablet No. 5 - White Chocolate reverse specifications |
| `corporate-gifting-hero-desktop.jpg` | 3840 × 1060 | `https://manamchocolate.com/cdn/shop/files/Corporate_Gifting_Desktop_Banner.jpg` | 93 | `page-corporate-gifting.php` (Desktop Hero) | Manam Chocolate bespoke corporate gifting curation, presentation boxes, and artisan tablets |
| `corporate-gifting-hero-mobile.jpg` | 1080 × 1080 | `https://manamchocolate.com/cdn/shop/files/Corporate_Gifting_Mobile_Banner.jpg` | 94 | `page-corporate-gifting.php` (Mobile Hero `<picture>`) | Manam Chocolate bespoke corporate gifting curation banner (Mobile) |
| `store-delhi-dlf-promenade.jpg` | 2160 × 1440 | `https://manamchocolate.com/cdn/shop/files/DLF_Promenade_store.jpg` | 95 | `page-store-locator.php` (DLF Promenade Store Card) | Manam Chocolate Beverage Bar at DLF Promenade Mall, Vasant Kunj, New Delhi |
| `store-gurgaon-ireo-grandview.jpg` | 2160 × 1440 | `https://manamchocolate.com/cdn/shop/files/Ireo_Grandview_store.jpg` | 96 | `page-store-locator.php` (IREO Grand View Store Card) | Manam Chocolate Store, Café & Beverage Bar at IREO Grand View High Street, Gurgaon |

### 10.2 WooCommerce Product Catalog Integration

1. **Digital Gift Card (Product ID 97):**
   - Slug: `gift-card`, Base MRP: ₹1,000, Virtual: `true`.
   - Denominations: ₹1,000, ₹2,000, ₹3,000, ₹5,000.
   - Recipient fields: `gift_card_recipient_email` (required), `gift_card_recipient_name`, `gift_card_message`, `gift_card_sender_name`, `gift_card_send_on`.
   - Dynamic price calculation in WooCommerce cart via `woocommerce_before_calculate_totals` hook.
   - Physical pincode checker conditionally hidden; complete 8-section Terms & Conditions embedded.

2. **Baking Collection Products (Product IDs 98 – 103):**
   - Natural Cacao Powder No. 1 (Product ID 98): MRP ₹625 (200g)
   - Chocolate Baking Tablet No. 4 - 80% Extra Dark (Product ID 99): MRP ₹980 (250g)
   - Chocolate Baking Tablet No. 2 - 60% Dark (Product ID 100): MRP ₹980 (250g)
   - Baking Cacao Nibs (Product ID 101): MRP ₹580 (200g)
   - Chocolate Baking Tablet No. 1 - 45% Milk (Product ID 102): MRP ₹980 (250g)
   - Chocolate Baking Tablet No. 5 - White (Product ID 103): MRP ₹1,025 (250g)

---
*End of Asset Manifest & Mapping Document.*


