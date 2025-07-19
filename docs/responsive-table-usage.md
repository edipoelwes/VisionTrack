# Responsive Table Usage Guide

This guide explains how to use the shared responsive table styles in your Vue components.

## Overview

The responsive table styles have been moved from individual components to the global CSS file (`resources/css/app.css`). This makes the styles reusable across all pages in the application.

## How to Use the Responsive Table in Your Components

1. Simply add the `responsive-table` class to your `<table>` element:

```html
<table class="responsive-table">
  <thead>
    <tr>
      <th>Header 1</th>
      <th>Header 2</th>
      <!-- Add more headers as needed -->
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Data 1</td>
      <td>Data 2</td>
      <!-- Add more data cells as needed -->
    </tr>
    <!-- Add more rows as needed -->
  </tbody>
</table>
```

## Features

The responsive table includes the following features:

1. **Desktop View**:
   - Clean, bordered table layout
   - Proper spacing and alignment
   - Dark mode support

2. **Mobile View** (screen width < 768px):
   - Card-like presentation of each row
   - Headers are hidden
   - Each row becomes a standalone card
   - First column is emphasized with larger font
   - Action buttons (if in the last column) are positioned in the top-right corner

3. **Dark Mode Support**:
   - Automatically adjusts colors for dark mode

## Example

Here's an example of how the responsive table is used in the Clients page:

```html
<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 responsive-table">
  <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
    <tr>
      <th class="px-6 py-3 text-left">Cliente</th>
      <th class="px-6 py-3 text-left">Contato</th>
      <th class="px-6 py-3 text-left">E-mail</th>
      <th class="px-6 py-3 text-right">Actions</th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
    <!-- Table rows go here -->
  </tbody>
</table>
```

## Combining with Tailwind Classes

You can combine the `responsive-table` class with Tailwind CSS classes for additional styling. The responsive table styles will handle the basic structure and responsiveness, while Tailwind classes can be used for additional customization.

## Maintenance

If you need to modify the responsive table styles, edit the `resources/css/app.css` file. The styles are defined within the `@layer components` section.
