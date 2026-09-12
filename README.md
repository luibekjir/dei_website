# CulinaryAtelier: Culinary Marketplace & Food Delivery Platform

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)

## Project Overview
CulinaryAtelier is a comprehensive food delivery and culinary marketplace platform built with Laravel and Livewire. The platform connects customers with local restaurants, providing a seamless experience for discovering menus, placing orders, negotiating delivery fees, and processing payments securely. It aims to empower local culinary businesses by providing them with a digital storefront and robust order management tools.

## Core Features & Problems Solved
1. **Restaurant & Menu Exploration**: How can users find the best food nearby using geolocation and regional mapping?
2. **Interactive Delivery Fee Negotiation**: How to handle delivery costs fairly through a real-time negotiation system between users and drivers?
3. **Secure Transactions**: How to ensure safe and flexible payments using Midtrans Payment Gateway?
4. **24/7 Customer Assistance**: How to assist users instantly through an AI-powered Chatbot?
5. **Vendor Management**: How can restaurants efficiently manage their menus, orders, facilities, and earnings withdrawals?

## Database & Entities
- **Source**: Relational database (SQLite/MySQL).
- **Size**: Scalable schema accommodating restaurants, menus, users, and transactions.
- **Key Entities**: Complex relational data including `Users` (with 2FA), `Restaurants` (with coordinates & facilities), `Orders`, `Delivery Rules`, `Reviews`, `Messages`, and `Withdrawals`.

## Methodology & Tech Stack
1. **Backend Framework**: Laravel 11.x, providing robust routing, authentication, and database ORM (Eloquent).
2. **Frontend & Interactivity**: Laravel Livewire & Flux for reactive, single-page-application (SPA) behavior without writing custom JavaScript.
3. **Styling**: Tailwind CSS (v4) integrated through Vite for modern, responsive, and utility-first UI design.
4. **Payment Gateway**: Midtrans PHP SDK integrated to handle secure, multi-channel payment processing.
5. **Version Control & Tooling**: Git for collaboration, Laravel Pint for code linting, and Pest for testing.

## System Highlights & Business Insights

### 1. Delivery Fee Negotiation (Unique Value Proposition)
Unlike traditional food delivery apps with fixed rates, CulinaryAtelier implements a real-time delivery fee negotiation system. Users can propose a delivery fee before checkout, and drivers/system can accept or reject it, offering dynamic pricing and a fairer logistics ecosystem.

### 2. Comprehensive Restaurant Management
Restaurants aren't just names on a list; they have detailed profiles including facilities, dynamic delivery rules, categorized menus with ratings, and regional metadata to improve local discovery.

### 3. Integrated Financial System
The platform handles the entire financial lifecycle, from order service charges and Midtrans payment processing to restaurant earnings tracking and a withdrawal system for vendors to cash out securely.

### 4. Smart Chatbot Assistant
Integrated an intelligent Chatbot controller to help customers navigate the app, find specific restaurants or menu items, and resolve common queries instantly, significantly reducing customer support overhead.

## Application Performance & Security
The platform utilizes Laravel's built-in security features including CSRF protection, secure authentication, and sanitized database queries. The Livewire architecture ensures fast, dynamic component updates without full page reloads, resulting in a seamless and highly responsive user experience.

## Future Recommendations & Roadmap
1. **Real-time Tracking**: Implement WebSockets (e.g., Laravel Reverb) for live order tracking and real-time negotiation status updates.
2. **Advanced Analytics**: Build a merchant dashboard with predictive analytics for restaurants to forecast demand and optimize their menu availability.
3. **Driver Application**: Develop a dedicated interface or mobile API for delivery drivers to manage negotiation requests and route optimization.

---
**Teams**:  
- **Maverick S.T** (CEO)  
- **N. Hera Joevandy** (CMO)  
- **F. Jose Hagen** (COO)  
- **Louie N.C.** (CFO)  
- **M. Dzaky Nabil** (CDO)  
- **M. Althaf Hilmi** (CTO)
