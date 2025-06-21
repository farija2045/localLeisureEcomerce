# Local Leisure Finder System

## Overview

This is a simple web application for discovering and sharing leisure spots. Users can view uploaded entries, see images, descriptions, and prices, and interact with promotions. The system is built with Yii2 PHP framework and uses Bootstrap for styling.

---

## Features

- **View Promotions:** See current promotions at the top of the page.
- **Browse Leisure Entries:** Each entry shows an image, title, description, and a button to view the price.
- **Show Price:** Click the "Show Price" button (with a heart icon) to see the price in a red toast popup.
- **Visit Link:** If available, visit the external link for more details.
- **Book Now & Contact Seller:** Quick action buttons for booking or contacting the seller.
- **Responsive Design:** Works on both desktop and mobile devices.

---

## How to Use

1. **Homepage:**  
   - Promotions are displayed at the top.
   - Scroll down to see all uploaded leisure entries.

2. **Viewing an Entry:**  
   - Click on the image or "Visit Link" to open the external page.
   - Click the **Show Price** button to see the price popup.
   - Use **Book Now** or **Contact Seller** for further actions.

3. **Navigation:**  
   - Use the "Find Leisure Areas" button to search for nearby places on Google Maps.

---

## Requirements

- PHP 7.4+ with [intl extension](https://www.php.net/manual/en/intl.installation.php) (for currency formatting)
- MySQL or compatible database
- Composer dependencies installed
- Bootstrap 5 CSS & JS included in your layout

---

## Developer Notes

- To add new entries, use the admin upload form.
- Prices are stored in the database and displayed using Yii's currency formatter.
- To change the default currency, edit the `currencyCode` in `config/web.php`.
- For demo purposes, a few entries should be preloaded.

---

## Troubleshooting

- **Currency formatting error:**  
  Make sure the `currencyCode` is set in `config/web.php` and the PHP intl extension is enabled.
- **Images not showing:**  
  Ensure the `uploads/` directory exists and is writable.

---

## Credits

- Built with [Yii2 Framework](https://www.yiiframework.com/)
- UI powered by [Bootstrap 5](https://getbootstrap.com/)

---

Enjoy discovering local leisure spots!