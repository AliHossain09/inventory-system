## Product Inventory System

This project was built as part of a Junior Laravel Developer (Remote) technical assessment. The goal was to create a clean and practical Product Inventory Management module using Laravel 12, Inertia.js, Vue 3, and ShadCN Vue. The focus was on writing readable, maintainable code, keeping controllers clean, and following real‑world best practices rather than over‑engineering the solution

## Tech Stack
- Backend: Laravel 12.
- Frontend: Inertia.js + Vue 3.
- UI Components: ShadCN Vue.
- Styling: Tailwind CSS.
- Extras: SweetAlert (confirmation dialogs).
- Database: MySQL.

## Features
- Product listing with image, name, SKU, price, and stock.
- Search by product name or SKU.
- Pagination 10 products per page.
- Create, edit, and update products.
- Product image upload with validation.
- Soft delete (archive) with confirmation modalL.
- Clean and responsive UI using ShadCN Vue components.
- Database: MySQL.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# Installation & Setup

## Clone the repository
- git clone <your-repo-link>

## Go to project directory
- cd product-inventory

## Install backend dependencies
- composer install

## Install frontend dependencies
- npm install

## Environment setup
- cp .env.example .env
- php artisan key:generate

## Configure Database

#### Update your .env file with database credentials:

- DB_DATABASE=inventory_system_shadCN
- DB_USERNAME=root
- DB_PASSWORD=
 
## Run Migrations & Seeders
- php artisan migrate --seed

## Storage Link for product images
- php artisan storage:link

## Run frontend
- npm run dev

## Run backend
- php artisan serve



## 1. Dependency Injection vs Facade Laravel 12

A Facade is Laravel’s shortcut system for accessing services. Dependency Injection means injecting the required class directly through the constructor or method.

#### Differences

- Facades make code shorter but often hide what’s happening behind the scenes.

- Dependency Injection results in cleaner, more testable, and maintainable code.

#### When I Use Dependency Injection

- When working with service classes like file upload logic

- When unit testing is required

- When long‑term maintainability is important

In real‑world projects, Dependency Injection is a safer and more professional approach.


## 2. Performance Optimization (Handling 10,000 Products)

Loading all products at once would slow down the application. To optimize performance:
- Add database indexes on SKU and name.
- Use pagination instead of loading all records.
- Optimize search queries using LIKE with proper indexing
- Avoid eager‑loading relationships unless they are required

This approach keeps page load times fast and reduces server load.

## 3. CSRF Protection with Inertia.js

Laravel generates a CSRF token for every form submission. Inertia.js automatically sends this token with each request.

#### Why Important

- Protects the application from CSRF attacks.
- Prevents unauthorized form submissionsd.

When using Laravel with Inertia.js, CSRF protection works out of the box and provides security by default.

## 4. N+1 Query Problem & Solution
If there are 10 products and each product loads its category with a separate query, the total becomes 1 + 10 = 11 queries, which negatively impacts performance.

#### Solution:
Using eager loading with with(): Product::with('category')->paginate(10);
This loads all related categories in a single query and significantly improves performance.

## Code Structure Notes
- Controllers handle only request logic.
- Image upload logic is handled in a dedicated Service class.
- Laravel Form Requests are used for validation.
- Named routes and a clean folder structure are followed.

## Extra Notes
- SweetAlert is used for delete confirmation dialogs.
- Tailwind CSS is used for a clean and modern UI.
- php artisan storage:link is used to make uploaded images publicly accessible.

