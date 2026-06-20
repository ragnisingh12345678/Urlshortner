# UrlshortnerURL Shortener Service
Yeh project ek robust URL Shortening Service hai jo Laravel framework ka upyog karke banayi gayi hai. Iska mukhya uddeshya companies aur unke users ke liye secure, role-based URL management provide karna hai.

🚀 Key Features
Role-Based Access Control (RBAC): SuperAdmin, Admin, Member, Sales, aur Manager ke liye alag-alag permissions.

Company Management: Har user ek specific company se judaa hai.

Invitation System: Roles ke hisaab se users ko invite karne ki suvidha (SuperAdmin aur Admin rules ke sath).

URL Restrictions:

SuperAdmin, Admin, aur Member URL create nahi kar sakte.

Role-based Visibility: Admin sirf apni company ke URL dekh sakte hain, Member sirf apne banaye huye.

Public Resolution: URLs publicly resolvable hain aur seedhe original URL par redirect karte hain.

🛠 Project Setup
Prerequisites
PHP 8.x

Laravel 10/11/12

MySQL / SQLite

Composer

Installation Steps
Clone the repository:

Bash
git clone <repository-url>
cd <project-folder>
Install dependencies:

Bash
composer install
Environment Setup:

.env.example ko .env mein rename karein.

Database credentials .env file mein update karein.

Generate Key & Migrate:

Bash
php artisan key:generate
php artisan migrate
Database Seeding:
(SuperAdmin account create karne ke liye):

Bash
php artisan db:seed
Serve the application:

Bash
php artisan serve