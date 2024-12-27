Laravel Sanctum API with Image CRUD
This project is a simple Laravel API that utilizes Sanctum for authentication and provides CRUD operations for handling images. It allows users to upload, view, update, and delete images with secure authentication.

Features
Authentication: Uses Laravel Sanctum for API authentication with token-based authentication.
CRUD Operations:
Create: Upload images and store them in the server.
Read: Retrieve image details and display images.
Update: Modify the image details, such as replacing the existing image.
Delete: Remove images from the server.
File Handling: Efficient handling of image files, including validation for file type and size.
Requirements
Before you begin, make sure you have the following installed:

PHP (>=7.3)
Composer
Laravel (>=8.x)
MySQL or any other database you prefer
Node.js (for front-end development if necessary)
Installation
Follow these steps to set up the project:

Step 1: Clone the repository
git clone <repository_url>
cd <project_directory>
Step 2: Install dependencies
Run the following command to install the required PHP and JavaScript dependencies:

composer install
npm install
Step 3: Set up the environment file
Copy the .env.example file to .env:
cp .env.example .env

Step 4: Configure database
Make sure to configure your database connection in the .env file. For example:env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

Step 5: Generate the application key
Run the following command to generate a unique application key:
php artisan key:generate

Step 6 : php artisan install:api do migration after run this command