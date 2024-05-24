# ArtNexus - Comprehensive Art Marketplace

Welcome to ArtNexus, an all-encompassing platform dedicated to connecting artists and art enthusiasts. ArtNexus provides a seamless experience for users to explore, buy, and sell art pieces while offering robust support and customer service.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#Installation)
- [Configuration](#configuration)
- [FAQ](#faq)
- [Contact](#contact)
- [Contributing](#contributing)
- [License](#license)

## Introduction

ArtNexus is designed to bring artists and art lovers together on one platform. It features a dynamic and user-friendly interface to browse through various art pieces, connect with artists, and make secure purchases. 

## Features

- **User Registration and Authentication**: Secure user authentication and profile management.
- **Artist and Vendor Dashboards**: Dedicated dashboards for artists to manage their portfolios and for vendors to manage their inventory.
- **Admin Dashboard**: Comprehensive control for administrators to oversee platform activities, manage users, and handle content.
- **Real-time Chat with Pusher**: Instant messaging feature for users to communicate with artists, vendors, and support.
- **Art Listings**: Detailed pages for each art piece, including descriptions, prices, and artist information.
- **Search and Filters**: Advanced search functionality with filters to find art by category, price range, and more.
- **Chatbot Assistance**: simple chatbot to assist users with common queries and provide instant support.
- **Contact Forms**: Easy-to-use contact forms for reaching out to support or artists directly.
- **Payment Gateway Integration**: Secure online payment options.
- **Order Tracking**: Users can track their orders and delivery status.
- **Newsletter Subscription**: Users can subscribe to newsletters for the latest updates and offers.

## Technologies Used

- **Backend**: Laravel 10
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Chatbot**: BotMan
- **Real-time Chat**: Pusher
- **Version Control**: Git

## Installation

To set up the project locally, follow these steps:

1. **Clone the Repository**

   ```
   git clone https://github.com/juinaik-1/ArtNexus
   ```


2. **Install Dependencies**

    ```
    composer install
    npm install
    ```

3. **Environment Setup**

Copy the .env.example file to .env and configure your environment variables.

```
cp .env.example .env
php artisan key:generate
```

4. **Database Migration**

Set up your database in the .env file and run migrations.

```
php artisan migrate
```
5. **Seed the Database**

(Optional) Seed the database with initial data.

```
php artisan db:seed
```

6. **Start the Development Server**

```
php artisan serve
npm run dev
```
7. **Contributing**

We welcome contributions to improve ArtNexus. Please follow these steps:

    1. Fork the repository.
    2. Create a new branch.
    3. Make your changes.
    4. Submit a pull request.

8. **License**

This project is licensed under the MIT License. See the LICENSE file for details.
