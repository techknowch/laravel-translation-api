# Laravel Translation API

A scalable API for managing translations across multiple languages, built with Laravel 12.

## 🚀 Features

- **Laravel 12**: Modern framework with closure-based bootstrap
- **Laravel Sanctum**: Token-based authentication
- **Custom API Key Middleware**: Fast, dependency-free access control
- **Multi-language Support**: Manage translations for multiple languages
- **Search and Export**: Advanced search capabilities and export functionality
- **Performance Optimized**: Database indexes and efficient queries
- **OpenAPI/Swagger Documentation**: Auto-generated API documentation
- **Comprehensive Testing**: Unit and feature tests with performance validation

## 🛠️ Technology Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Database**: MySQL/SQLite with optimized indexes
- **Authentication**: Laravel Sanctum + Custom API Key middleware
- **Testing**: PHPUnit with performance testing
- **Documentation**: Swagger/OpenAPI via zircote/swagger-php

## 📦 Installation

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL or SQLite
- Node.js and NPM (optional, for frontend)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/techknowch/laravel-translation-api.git
   cd laravel-translation-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   ```

4. **Update environment variables**
   ```env
   APP_URL=http://localhost
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_translation
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   
   API_KEY=your-secure-api-key-here
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed initial languages**
   ```bash
   php artisan tinker
   ```
   Then run:
   ```php
   Language::create(['code' => 'en', 'name' => 'English']);
   Language::create(['code' => 'ur', 'name' => 'Urdu']);
   Language::create(['code' => 'fr', 'name' => 'French']);
   Language::create(['code' => 'es', 'name' => 'Spanish']);
   ```

8. **Populate test data (optional)**
   ```bash
   php artisan db:populate-translations 100000
   ```

9. **Start the application**
   ```bash
   php artisan serve
   ```

## 📡 API Endpoints

### Authentication

The API supports two authentication methods:

#### API Key Authentication
Include the header:
```
X-API-KEY: your-secure-api-key-here
```

#### Bearer Token Authentication (Sanctum)
Include the header:
```
Authorization: Bearer <token>
```

### Available Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/api/translations` | List all translations | ✅ |
| `POST` | `/api/translations` | Create a new translation | ✅ |
| `GET` | `/api/translations/{id}` | Get specific translation | ✅ |
| `PUT` | `/api/translations/{id}` | Update translation | ✅ |
| `DELETE` | `/api/translations/{id}` | Delete translation | ✅ |
| `GET` | `/api/translations/search` | Search translations | ✅ |
| `GET` | `/api/translations/export` | Export translations | ✅ |
| `GET` | `/api/translations/translate` | Translate text | ✅ |
| `GET` | `/api/languages` | List all languages | ✅ |
| `POST` | `/api/languages` | Create a new language | ✅ |
| `GET` | `/api/languages/{id}` | Get specific language | ✅ |
| `PUT` | `/api/languages/{id}` | Update language | ✅ |
| `DELETE` | `/api/languages/{id}` | Delete language | ✅ |

### Example API Usage

#### Create a Translation
```bash
curl -X POST http://localhost:8000/api/translations \
  -H "X-API-KEY: your-secure-api-key-here" \
  -H "Content-Type: application/json" \
  -d '{
    "key": "welcome_message",
    "content": "Welcome to our application",
    "language_id": 1,
    "tags": ["web", "mobile"]
  }'
```

#### Search Translations
```bash
curl -X GET "http://localhost:8000/api/translations/search?key=welcome&tags=web" \
  -H "X-API-KEY: your-secure-api-key-here"
```

#### Translate Text
```bash
curl -X GET "http://localhost:8000/api/translations/translate?content=Hello&from=en&to=fr" \
  -H "X-API-KEY: your-secure-api-key-here"
```

## 🗄️ Database Schema

### Languages Table
- `id` (Primary Key)
- `name` (Unique)
- `code` (Unique)
- `created_at`, `updated_at`

### Translations Table
- `id` (Primary Key)
- `key` (Indexed)
- `content` (Text)
- `language_id` (Foreign Key)
- `tags` (JSON, nullable)
- `original_content` (Text, nullable)
- `from_locale` (String, nullable)
- `to_locale` (String, nullable)
- `created_at`, `updated_at`

**Indexes:**
- `key` index for fast lookups
- `language_id, key` composite index
- `language_id, tag_value` composite index

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run with coverage (requires Xdebug or PCOV)
php artisan test --coverage

# Run performance tests
php artisan test --filter=testPerformanceIndex
```

### Test Coverage
The application includes comprehensive tests:
- **Unit Tests**: Controller and service layer testing
- **Feature Tests**: API endpoint testing
- **Performance Tests**: Validates response times under load

## 🏗️ Architecture

### Models
- **Translation**: Manages translation content with relationships to languages
- **Language**: Manages supported languages
- **User**: Laravel's default user model for Sanctum authentication

### Controllers
- **TranslationController**: Handles CRUD operations for translations
- **LanguageController**: Manages language operations

### Services
- **BasicTranslationService**: Provides translation functionality with fallback mappings

### Middleware
- **CheckApiKey**: Custom middleware for API key validation

### Console Commands
- **PopulateTranslations**: Populates the database with test data

## 🔧 Configuration

### API Key Setup
The API key middleware is configured in `bootstrap/app.php`:
```php
$middleware->alias([
    'api.key' => CheckApiKey::class,
]);
```

### Database Optimization
The application includes optimized database indexes for:
- Fast translation lookups by key
- Efficient language-based queries
- Tag-based filtering

## 🚀 Performance Features

- **Database Indexing**: Optimized indexes for common query patterns
- **Batch Processing**: Efficient handling of large datasets
- **Memory Management**: Chunked processing for large operations
- **Response Time Validation**: Tests ensure sub-200ms response times

## 📚 Documentation

### OpenAPI/Swagger
The API includes auto-generated OpenAPI documentation via swagger-php annotations.

### Code Documentation
All controllers and services include comprehensive PHPDoc comments.

## 🔮 Future Enhancements

- **Caching Layer**: Redis integration for frequently accessed translations
- **Real-time Translation APIs**: Integration with Google Translate, DeepL, etc.
- **Advanced Search**: Full-text search capabilities
- **Translation Memory**: Learning from previous translations
- **Bulk Operations**: Batch import/export functionality
- **Version Control**: Translation versioning and rollback capabilities

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions, please open an issue on GitHub or contact the development team.