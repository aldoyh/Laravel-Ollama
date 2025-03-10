# Laravel Ollama boilerplate

A robust Laravel application integrating [Cloudstudio Ollama-Laravel](https://github.com/cloudstudio/ollama-laravel) and [Spatie Laravel-markdown](https://spatie.be/docs/laravel-markdown/v1/introduction) for local LLM integration.

![](public/screenshot.png)

## Features

- Local LLM integration with Ollama
- Markdown rendering support
- Real-time responses
- Copy-to-clipboard functionality
- Dark mode support

## What is what

**Ollama** is an open-source & user-friendly tool designed to run large language models (LLMs) locally on a computer. It supports a variety of AI models including LLaMA-2, uncensored LLaMA, CodeLLaMA, Falcon, Mistral, Vicuna model, WizardCoder, and Wizard uncensored. It is current1ly compatible with MacOS and Linux, with Windows support expected to be available soon. Get started with [Ollama](https://github.com/jmorganca/ollama)

**Ollama-Laravel** is a Laravel package that provides a seamless integration with the Ollama API. It includes functionalities for model management, prompt generation, format setting, and more. This package is perfect for developers looking to leverage the power of the Ollama API in their Laravel applications. Chek [Ollama-Laravel usage](https://github.com/cloudstudio/ollama-laravel?tab=readme-ov-file#usage) for more details.

**Laravel Markdown** is used render Markdown in a Laravel Blade view.

## Prerequisites

- PHP 8.1 or higher
- Node.js 16+ and NPM/PNPM
- [Ollama](https://ollama.ai/) installed locally
- Composer

## Environment
- You should have [Ollama](https://ollama.ai/) installed locally
- You should clone this repo & run Laravel locally using Sail 
- I tested it on Apple Silicon M1 Max running Sonoma 14.1.2 

## Setup
1. Install [Ollama](https://ollama.ai/)  
2. Clone this repository  
`git clone git@github.com:LeandroBerlin/Laravel-Ollama-boilerplate.git`  
3. Move to project folder  
`cd Laravel-Ollama-boilerplate`  
4. Install dependencies  
`composer install`  
5. Configure environment  
`cp .env.example .env`  
5. Create your App Key  
`php artisan key:generate`  
6. Install frontend dependencies  
`npm install`  
7. Run Vite  
`npm run dev`  
8. Go to localhost:8000

<hr>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
