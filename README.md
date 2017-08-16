## Introduction

Lalottery provides a lottery system with dashboard and code-driven configuration for your Laravel. 

## Installation

> **Note:** Lalottery is currently in beta.

Lalottery requires Laravel 5.4, which is currently in beta, and PHP 7.1+. You may use Composer to install Lalottery into your Laravel project:

    composer require ricardorsierra/lalottery

After installing Lalottery, publish its assets using the `vendor:publish` Artisan command:

    php artisan vendor:publish --provider="Ricardorsierra\Lalottery\LalotteryServiceProvider"

## Configuration

After publishing Lalottery's assets, its primary configuration file will be located at `config/lalottery.php`.

### Web Dashboard Authentication

Lalottery exposes a dashboard at `/lalottery`.
