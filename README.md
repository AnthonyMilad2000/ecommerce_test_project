# Candidate Task: Implement Review System and Refactor Blade Views

## Overview

As part of our project, you will be tasked with implementing a review system on the product details page. Additionally, you'll refactor our Blade views to improve the structure and maintainability of the code. Below are the specific tasks you should complete.

## Tasks

### 1. Implement Review System

-   **Objective**: Allow users to leave reviews for products on the product details page.
-   **Requirements**:
    -   Create a new model for `Review` with appropriate fields (e.g., `user_id`, `product_id`, `rating`, `comment`).
    -   Create a migration for the `reviews` table.
    -   Implement the necessary relationships between the `Product` and `Review` models.
    -   Update the `ProductController` to handle the display and submission of reviews.
    -   Create a form for submitting a review on the product details page.
    -   Display existing reviews for the product on the product details page.
    -   Ensure proper validation for review submissions.
    -   Use `@csrf` in the review form to protect against CSRF attacks.

### 2. Refactor Blade Views

-   **Objective**: Improve the organization and structure of Blade views.
-   **Requirements**:
    -   Create a master Blade file (e.g., `layouts/master.blade.php`) that will serve as the main layout for all pages.
        -   This file should include:
            -   A header section for navigation.
            -   A footer section.
            -   A section for yielding page-specific content.
    -   Refactor existing Blade views to extend the master layout.
        -   Ensure that all pages (e.g., product details, product listing) use this master layout.
    -   Create a separate Blade file for the header, which could include a search/filter component for products (e.g., `partials/header.blade.php`).
        -   This should be included in the master layout.

### 3. Style Product Details

-   **Objective**: Enhance the visual presentation of the product details.
-   **Requirements**:
    -   Review the existing styles applied to the product details and improve them using CSS or a CSS framework (e.g., Bootstrap, Tailwind CSS).
    -   Ensure the product details are visually appealing and easy to read.
    -   Apply consistent styling across all product-related pages.
    -   Consider responsive design principles to ensure that the product details look good on various screen sizes.

### 4. Add Product Status

-   **Objective**: Add a status setting for each product.
-   **Requirements**:
    -   Add a `status` column to the `products` table via a migration.
    -   Update the `ProductController` to handle the product status update.
    -   Ensure the status can NEVER be set or updated through the application interface (just a tested route for it is enough).

### 5. Track Product Status Update Date

-   **Objective**: Track the last date when the product status was updated.
-   **Requirements**:
    -   Add a `status_updated_at` column to the `products` table via a migration.
    -   Update the `Product` model to include the `status_updated_at` attribute.
    -   Modify the controller method that updates the product status to also update the `status_updated_at` column with the current date and time.
    -   Ensure the `status_updated_at` column is updated whenever the product status is changed.

## Submission Guidelines

-   Ensure your code is well-documented and follows the project's coding standards.
-   Provide a brief explanation of the design decisions you made during the implementation.
-   Submit your changes as a pull request to the main branch of the repository.
-   Include any additional resources or libraries you used in your implementation.

## Additional Notes

-   Make sure to test your implementation thoroughly.
-   If you encounter any challenges or have questions, feel free to reach out for clarification.
-   Try to showcase your knowledge and skills as much as possible in all tasks above.
