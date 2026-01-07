# Online-Practical-WPWeb

# WP Content Manager – Promo Blocks

## Overview

WP Content Manager is a custom WordPress plugin that allows administrators to create and manage **Promo Blocks** and display them dynamically on the frontend.

The plugin is designed to demonstrate real-world WordPress development practices including custom post types, admin configuration, AJAX and REST API usage, caching, performance optimization, and security best practices.

---

## Installation (Reviewer Steps)

### Install via Git (Recommended)

1. Clone the repository:
   git clone https://github.com/vijayy6153/Online-Practical-WPWeb

## Install via ZIP
WordPress Admin → Plugins → Add New → Upload Plugin

## Initial Configuration
After activating the plugin:

Go to:
Settings → Dynamic Content

Configure the following options:

- Enable Promo Blocks
- Maximum number of promo blocks to display
- Cache TTL (minutes)
- Enable AJAX loading
- Save the settings

## Promo Blocks (Custom Post Type)

The plugin registers a custom post type called Promo Blocks.
Each Promo Block includes:

- Title
- Content (WYSIWYG editor)
- Featured Image
- CTA Text
- CTA URL (absolute URL)
- Display Priority (numeric)
- Expiry Date

## Shortcode Usage

Use the core Shortcode:

[dynamic_promo]
