# Try Martial Art

A martial arts newsletter blog built with Laravel 11, Blade Templates, TailwindCSS, and Alpine.js.

**Domain:** tryamartialart.com

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 11
- **Frontend:** Blade Templates, TailwindCSS, Alpine.js
- **Data:** JSON mock data (no database required)

## Brand Colors

| Color | Hex | Usage |
|-------|-----|-------|
| Primary | `#120D42` | 60% - Main brand color |
| Secondary | `#165AE7` | 30% - Buttons, links, accents |
| Tertiary | `#FAB301` | 10% - Highlights, CTAs |

## Project Structure

```
tryamartialart/
├── app/
│   ├── Http/Controllers/
│   │   └── PostController.php      # Handles all post-related routes
│   ├── Providers/
│   │   └── AppServiceProvider.php
│   └── Services/
│       └── PostService.php         # Reads and manages mock data
├── bootstrap/
│   └── app.php                     # Laravel 11 bootstrap
├── config/                         # Configuration files
├── data/
│   └── posts.json                  # Mock blog post data
├── public/
│   ├── images/                     # Post images
│   └── index.php                   # Entry point
├── resources/
│   ├── css/
│   │   └── app.css                 # TailwindCSS styles
│   ├── js/
│   │   └── app.js                  # Alpine.js setup
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php       # Main layout template
│       ├── home.blade.php          # Homepage
│       ├── post.blade.php          # Article page
│       ├── articles.blade.php      # All articles listing
│       ├── category.blade.php      # Category page
│       └── subscribe.blade.php     # Newsletter subscription
├── routes/
│   └── web.php                     # Web routes
└── storage/                        # Laravel storage
```

## Routes

| Route | Description |
|-------|-------------|
| `/` | Homepage with hero and latest posts |
| `/articles` | All articles listing |
| `/p/{slug}` | Individual article page |
| `/category/{category}` | Category filtered posts |
| `/subscribe` | Newsletter subscription page |

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm (for asset compilation)

### Setup

1. **Install PHP dependencies:**
   ```bash
   composer install
   ```

2. **Install Node dependencies:**
   ```bash
   npm install
   ```

3. **Copy environment file:**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

5. **Build assets (for production):**
   ```bash
   npm run build
   ```

6. **Start development server:**
   ```bash
   php artisan serve
   ```

   The site will be available at `http://localhost:8000`

## Development

### Running with Vite (Hot Reload)

```bash
npm run dev
```

In another terminal:
```bash
php artisan serve
```

### Adding New Posts

Edit `data/posts.json` to add new blog posts:

```json
{
    "id": 7,
    "title": "Your New Post Title",
    "slug": "your-new-post-title",
    "excerpt": "A brief description of your post.",
    "author": "Admin",
    "date": "2026-03-15",
    "category": "Business",
    "image": "/images/post7.jpg",
    "content": "<p>Your HTML content here...</p>"
}
```

### Adding Images

Place post images in `public/images/` directory. Reference them in posts.json as `/images/filename.jpg`.

## Features

- ✅ Responsive design (Desktop, Tablet, Mobile)
- ✅ SEO optimized (meta tags, OpenGraph)
- ✅ Clean URL slugs
- ✅ Category filtering
- ✅ Related posts
- ✅ Social sharing
- ✅ Newsletter signup forms
- ✅ Mobile-friendly navigation

## Mock Data

The project uses JSON files for data storage instead of a database. This allows for rapid UI development without database setup.

Data is stored in `/data/posts.json` and read by the `PostService` class.

## License

MIT License
