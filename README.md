# Trading Journey System

Welcome to the Trading Journey System, a Laravel-based web application designed to help you document and analyze your trading activities. This system is open-source and available for free on GitHub.

## Features

- **Login with Google by Firebase**: Seamless authentication using your Google account.
- **Setup Trading Parameters**:
  - **Trading Types**: Configure trading types including forex, crypto, and stocks.
  - **Pairs**: Set up different trading pairs.
  - **Platforms**: Manage various trading platforms.
  - **Accounts**: Keep track of multiple trading accounts.
  - **Strategies**: Define and use various trading strategies.
- **Create Trading Orders**: Log your buy and sell orders with detailed information.
- **Mistake and Best Practices Checklist**: Note down mistakes and best practices for continuous improvement.
- **Dashboard Monitoring**:
  - Overview of buy/sell orders.
  - Top orders and pairs.
  - P&L (Profit and Loss) tracking.
  - Performance charts (daily, monthly, yearly).
- **Motivation Page**: Collect and display motivational YouTube videos.
- **News Page**: Fetch and display basic trading news from the Finhub API.
- **Forum Page**: Community forum for discussions and knowledge sharing.


## Screenshots

![Dashboard Screenshot](https://github.com/tepmakaraofficial/mtj-laravel/blob/main/public/images/MTJ%20background.png)  
[![Watch the Demo on YouTube](https://img.youtube.com/vi/f8gsj2qBfvQ/0.jpg)](https://www.youtube.com/watch?v=f8gsj2qBfvQ)

## Installation

To get started with the Trading Journey System, follow these steps:

### Prerequisites

- PHP >= 8.1
- Composer
- Laravel 9.x
- Laravel Voyager
- MySQL
- Node.js and npm
- Vite

### Steps

1. **Clone the repository**
    ```bash
    git clone please see the repo link

    ```

2. **Install backend dependencies**
    ```bash
    composer install
    ```

3. **Install frontend dependencies**
    ```bash
    npm install
    ```

4. **Set up environment variables**
    Copy the `.env.example` file to `.env` and update the environment variables as needed.
    ```bash
    cp .env.example .env
    ```
The additional mandatory variables
```bash
FINNHUB_API_KEY=123
#On contact page when user submit will send to Telegram
TG_API_KEY=123
TG_GROUP_CHAT_ID = 123

VITE_FIREBASE_API_KEY=123
VITE_FIREBASE_DOMAIN=123
VITE_FIREBASE_PROJECT_ID=123
VITE_FIREBASE_STORAGE_BUCKET=123
VITE_FIREBASE_SENDER_ID=123
VITE_FIREBASE_APP_ID=123
VITE_FIREBASE_MEASUREMENT_ID=123
```
5. **Generate application key**
    ```bash
    php artisan key:generate
    ```

6. **Run migrations**
    ```bash
    php artisan migrate
    ```

7. **Install and configure Laravel Voyager**
    ```bash
    php artisan voyager:install
    php artisan voyager:admin your@email.com --create  //This is to create backend admin
    ```
    
8. **Build frontend assets using Vite**
    ```bash
    npm run dev
    ```
npm run build for production or you can learn/check more about npm

9. **Serve the application**
    ```bash
    php artisan serve
    ```
    This is depend on your web server

## Usage

- Register an account or log in with Google.
- Configure your trading parameters.
- Start logging your trades and journal entries.
- Use the dashboard to monitor your trading performance over time.
- Stay motivated with the motivation page and informed with the news page.
- Engage with the community on the forum page.


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Thanks to the Laravel community for their amazing work.
- I believe this system may have some points that need to be added or modified.

---

Happy Trading!
