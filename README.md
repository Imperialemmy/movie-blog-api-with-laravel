# Laravel API with Sanctum Authentication

## 🚀 Project Overview
This is a Laravel-based REST API that provides authentication using Laravel Sanctum and supports CRUD operations for movies and blog posts. The project is deployed with a MySQL database on Railway.

## 🛠️ Features
- User authentication using Laravel Sanctum
- CRUD operations for movies and blog posts
- Filtering movies by genre or release date
- Pagination for movies and blog posts
- MySQL database hosted on Railway
- Secure API endpoints

---

## 📌 Installation
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/yourusername/yourproject.git
cd yourproject
```

### **2️⃣ Install Dependencies**
```sh
composer install
```

### **3️⃣ Set Up Environment Variables**
Copy `.env.example` to `.env`:
```sh
cp .env.example .env
```

Then update the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=host
DB_PORT=3306
DB_DATABASE=user
DB_USERNAME=root
DB_PASSWORD=your-database-password
```

### **4️⃣ Generate Application Key**
```sh
php artisan key:generate
```

### **5️⃣ Run Database Migrations**
```sh
php artisan migrate --seed
```

### **6️⃣ Serve the Application**
```sh
php artisan serve
```

---

## 🔑 Authentication
### **Register a User**
```http
POST /api/register
```
#### Request Body:
```json
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

### **Login User**
```http
POST /api/login
```
#### Request Body:
```json
{
    "email": "johndoe@example.com",
    "password": "password"
}
```

### **Logout User**
```http
POST /api/logout
```

---

## 🎬 Movies API
### **Get All Movies (with Filtering & Pagination)**
```http
GET /api/movies?genre=Action&release_date=2024&page=1
```

### **Create a Movie**
```http
POST /api/movies
```
#### Request Body:
```json
{
    "title": "Movie Title",
    "genre": "Action",
    "release_date": "2024-01-01"
}
```

---

## 📝 Blog Posts API
### **Get Paginated Blog Posts**
```http
GET /api/blog-posts?page=1
```

### **Create a Blog Post**
```http
POST /api/blog-posts
```
#### Request Body:
```json
{
    "title": "Blog Title",
    "content": "This is a sample blog post content.",
    "movie_id": 1
}
```

---

## 🚀 Deployment
### **Deploying to Railway**
1. **Create a New Project** on [Railway.app](https://railway.app/)
2. **Add the MySQL Plugin**
3. **Deploy Laravel on Railway** (with GitHub or manually upload code)
4. **Update `.env` with Railway Credentials**
5. **Run Migrations**
   ```sh
   php artisan migrate --seed
   ```
6. **Access API via Railway's Public URL**

---

## 🔥 License
This project is open-source and available under the MIT License.

