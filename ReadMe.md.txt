Online Book Review and Recommendation System
Description
A comprehensive web application built with Laravel 10 that allows users to review books, rate them, and get personalized recommendations based on their reading preferences. The system features separate admin and user interfaces with role-based access control.
Features
User Features

📚 Browse and search books catalog
⭐ Rate and review books (1-5 star rating)
📝 Write detailed book reviews
👤 Create and manage user profile with bio and profile image
📖 Create personal reading lists
🔍 Get personalized book recommendations
🏠 User-friendly homepage and dashboard

Admin Features

🛠️ Complete admin dashboard
📚 Add, edit, and delete books
👥 Manage users and their accounts
📊 View and moderate book reviews
📈 System analytics and reports
⚙️ Admin-only access controls

Tech Stack

Framework: Laravel 10
PHP Version: 8.1+
Database: MySQL
Frontend: Blade Templates with Bootstrap (via CDN)
Authentication: Laravel's built-in authentication system
Styling: CSS3 + Bootstrap 5

Database Schema

Users Table: user_id, name, email, password, img, bio, role (admin/user)
Books: Book information with cover images
Reviews: User reviews and ratings
Categories: Book genres and categories
Reading Lists: User's personal book collections

Requirements

PHP 8.1 or higher
Composer
MySQL 5.7+ or MariaDB
Web server (Apache/Nginx)


