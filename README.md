# AI Expense Tracker

A Laravel-based expense tracking application that helps you manage your personal finances.

## Features
- Income & Expense tracking
- Categorized transactions
- User authentication
- Dashboard overview
- Transaction history

## Prerequisites
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/ai-expense-tracker.git
   cd ai-expense-tracker
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Copy environment file and configure your database**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Configure your database in `.env` file**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ai_expense_tracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. **Run database migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

8. **Build assets**
   ```bash
   npm run dev
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

10. **Visit** `http://localhost:8000` **in your browser.**

## Usage
- Register a new account
- Login to your account
- Add new income transactions
- Add new expense transactions
- View your transaction history
- Monitor your financial overview in the dashboard
