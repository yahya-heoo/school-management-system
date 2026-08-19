# School Management System

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200" alt="Laravel Logo">
</p>

A comprehensive Laravel-based school management system designed to streamline educational institution operations including student management, teacher administration, fee tracking, attendance monitoring, and online classes integration.

## 🚀 Features

### Core Functionality

- **Student Management**: Complete student lifecycle management with academic records
- **Teacher Administration**: Teacher profiles, specializations, and class assignments
- **Academic Structure**: Hierarchical organization (Grades → Classrooms → Sections)
- **Fee Management**: Comprehensive fee structure, invoicing, and payment tracking
- **Attendance System**: Daily attendance tracking with teacher verification
- **Online Classes**: Zoom integration for virtual classroom sessions
- **Library Management**: Digital resource management and distribution
- **Parent Portal**: Dedicated parent information management with multi-step forms
- **Toast Notifications**: PHPFlasher with Toastr templates for user feedback

### Technical Features

- **Multi-language Support**: Arabic and English using Spatie Translatable
- **Polymorphic Attachments**: Flexible file attachment system for multiple entities
- **Repository Pattern**: Clean architecture with separated business logic
- **Livewire Integration**: Reactive components for complex forms
- **Soft Deletes**: Data recovery capabilities for critical records
- **Zoom API Integration**: Automated online meeting management
- **PHPFlasher Notifications**: Flash messages and toast notifications via `toastr()` helper

## 🛠️ Tech Stack

- **Framework**: Laravel 12.x
- **PHP**: 8.3+
- **Composer**: 2.x
- **Database**: MySQL
- **Frontend**: Blade Templates, TailwindCSS
- **Real-time**: Livewire 3.x
- **Frontend Build**: Vite 6.x
- **Authentication**: Laravel Sanctum 4.x
- **Notifications**: PHPFlasher 2.x (Toastr)
- **Testing**: PHPUnit 11.x
- **API Integration**: Zoom API (QuickZoom)
- **Localization**: mcamara/laravel-localization
- **File Management**: Custom attachment handling system

## 📋 Prerequisites

- PHP >= 8.3
- Composer 2.x
- MySQL
- Node.js >= 20 & NPM

## 🔧 Installation

1. Clone the repository

```bash
git clone https://github.com/yahya-heoo/school-management-system.git
cd school-management-system
```

2. Install dependencies

```bash
composer install
npm install
```

3. Environment setup

```bash
# Linux/macOS
cp .env.example .env

# Windows PowerShell
Copy-Item .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

4. Database configuration

- Configure database credentials in `.env`
- Run migrations:

```bash
php artisan migrate
php artisan db:seed
```

5. Link storage

```bash
php artisan storage:link
```

6. Install package resources (PHPFlasher & QuickZoom)

```bash
php artisan flasher:install
php artisan quickzoom:install
```

   > **Note**: After installing QuickZoom, add your Zoom API credentials to `.env`:
   > `ZOOM_API_KEY`, `ZOOM_API_SECRET`, `ZOOM_ACCOUNT_ID` (OAuth 2.0 Server-to-Server).

7. Run development server

```bash
php artisan serve
npm run dev
```

## 🔄 Project Status - Work in Progress

**⚠️ This project is currently undergoing active improvements**

The system is functional but being enhanced with:

- Performance optimization (database indexing, query optimization)
- Code quality improvements (standardization, documentation)
- Enhanced testing coverage
- Security hardening
- Service layer implementation

### Upcoming Improvements

- [ ] Add database indexes for performance optimization
- [ ] Implement pagination across all listing pages
- [ ] Add comprehensive unit and feature tests
- [ ] Implement Service Layer for better separation of concerns
- [ ] Add API documentation
- [ ] Enhanced error handling and logging
- [ ] Security enhancements (rate limiting, input validation)

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/      # Request handlers
│   ├── Livewire/         # Reactive components
│   ├── Middleware/       # HTTP middleware
│   └── Requests/         # Form validation
├── Models/              # Eloquent models
├── Repositories/        # Data access layer
├── Interfaces/          # Repository contracts
└── Traits/              # Reusable functionality
database/
├── migrations/          # Database schema
└── seeders/            # Sample data
```

## 🤝 Contributing

This is a portfolio project currently under active development. Contributions are welcome as the project evolves.

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer Notes

This project serves as a demonstration of Laravel best practices including:

- Repository Pattern implementation
- Polymorphic relationships
- Multi-language application architecture
- Third-party API integration (Zoom)
- Complex form handling with Livewire

**Current Development Focus**: Performance optimization and code quality enhancements

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
