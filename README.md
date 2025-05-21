# 📚 Book Insight

**Book Insight** is a web application that allows users to view book lists,
rating, as well as see a list of the most famous authors based on the total voter of the
rating of the books they write.

## 🚀 Key Features

-   🔍 **Book List:** Display all available books.
-   ⭐ **Rate:** Users can give a rating and the number of voters for a book.
-   🏆 **Top Authors:** Displays the top 10 most famous authors based on the number of _voters_ of their books (with a rating > 5).
-   🧪 **Seed & Factory:** Automatic dummy data for testing and demonstration.

## 📦 Technologies Used

-   Laravel 10
-   PHP 8.1+
-   MySQL
-   Faker (for dummy data)

## ⚙️ Installation

Follow these steps to run this project locally:

### 1. Clone Repository

```bash
git clone https://github.com/AriefLazuardi/Book-Insight.git
cd Book-Insight
```

### 2. Copy .env Files

```bash
 cp .env.example .env
```

### 3. Install Dependencies

```bash
  composer install
```

### 4. Generate Application Key

```bash
  php artisan key:generate
```

### 5. Create a New Database

```bash
  php artisan db:create
```

### 6. Run Migration and Seeder

```bash
   php -d memory_limit=4G artisan migrate:fresh --seed
```

Notes: The above command sets the PHP memory limit to 4GB to prevent Allowed memory size exhausted errors, especially when using multiple seeders or factories with large data.

If your laptop has limited memory, you can lower the limit, for example to 2GB:

```bash
   php -d memory_limit=2G artisan migrate:fresh --seed
```

### 7. Run the Server

```bash
   php artisan serve
```

## Access the application in a browser via:

```
http://localhost:8000
```

# 📬 Contact

## For questions or feedback, contact:

Name Mohammad Arief Lazuardi
Email [m.arieflazuardi.com]

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
