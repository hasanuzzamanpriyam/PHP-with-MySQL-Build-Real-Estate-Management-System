# Homeland - Real Estate Website

Homeland is a full-featured web application for browsing and managing real estate property listings. It provides a clean, user-friendly interface for potential buyers and renters, and a comprehensive admin panel for property managers.

## Features

### User-Facing Features

- **Browse Properties**: Users can view all listed properties.
- **Filter and Search**: Properties can be filtered by type (Sale, Rent, Lease) and other criteria.
- **Property Details**: A dedicated page for each property shows detailed information, including:
  - Price, location, and description.
  - Key specs: number of beds, baths, and square footage.
  - An image gallery and a main image slider.
  - Information like home type, year built, and price per square foot.
- **Related Properties**: The details page suggests other similar properties to the user.
- **User Authentication**: Users can register for an account and log in.
- **Contact Agent**: Logged-in users can send a message request to the property agent. The system prevents duplicate requests for the same property.
- **Favorites**: Logged-in users can add properties to their favorites list and remove them.
- **Social Sharing**: Easily share property details on Facebook, Twitter, and LinkedIn.

### Admin Panel Features

- **Secure Login**: Separate login for administrators.
- **Dashboard**: A central home page for the admin panel.
- **Admin Management**: Manage other administrator accounts.
- **Category Management**: Create, view, update, and delete property categories (e.g., Condo, Commercial Building).
- **Property Management**: Add, view, update, and delete property listings.
- **Request Management**: View and manage contact requests submitted by users for various properties.

## Technologies Used

### Backend
- **PHP**: Server-side scripting language.
- **MySQL**: Relational database for storing all application data.
- **PDO (PHP Data Objects)**: Used for secure database access.

### Frontend
- **HTML5**
- **CSS3 / SCSS**: Styling built upon the Bootstrap framework.
- **Bootstrap v4.1.3**: For responsive design and pre-styled components.
- **JavaScript**: For interactive elements and client-side logic.
- **jQuery v3.3.1**: Simplifies DOM manipulation and event handling.
- **Owl Carousel**: Used for the image sliders.
- **IcoMoon**: For custom icon fonts.

## Database Schema

The application uses a MySQL database with the following key tables:

- `users`: Stores registered user information, including credentials.
- `admins`: Stores administrator credentials and information.
- `properties`: The central table for all property listings and their details.
- `categories`: Stores property categories (e.g., Condo, Property-Land).
- `related_images`: Holds paths to additional images for each property gallery.
- `requests`: Logs contact requests made by users for properties.
- `favs`: Maps users to their favorited properties.

## Setup and Installation

To get a local copy up and running, follow these simple steps.

### Prerequisites

You will need a local server environment with PHP and MySQL, such as:
- XAMPP
- WAMP
- Laragon (as seen in the file paths)

### Installation

1.  **Clone the repository** to your local server's web directory (e.g., `htdocs`, `www`).
    ```sh
    git clone https://github.com/hasanuzzamanpriyam/homeland.git
    ```

2.  **Database Setup**:
    - Open your database management tool (like phpMyAdmin).
    - Create a new database named `homeland`.
    - Import the `database/homeland.sql` file into the `homeland` database. This will create all the necessary tables and seed them with initial data.

3.  **Configure Application Constants**:
    - You will need to configure the database connection and application URL. This is typically done in a configuration file. Look for a file like `includes/config.php` or similar (this file was not provided in the context).
    - **Database Connection**: Update the file with your database credentials (host, username, password, and database name).
      ```php
      // Example of what the config might look like
      define("DB_HOST", "localhost");
      define("DB_USER", "root");
      define("DB_PASS", "your_db_password");
      define("DB_NAME", "homeland");
      ```
    - **Application URL**: Ensure the `APPURL` and `ADMINURL` constants are correctly set to your local development URL.
      - In `property-details.php` and other user-facing files, `APPURL` should be `http://localhost/homeland`.
      - In `admin-panel/layouts/header.php`, `ADMINURL` is set to `http://localhost/homeland/admin-panel`.

4.  **Running the Application**:
    - Open your web browser and navigate to your local server URL (e.g., `http://localhost/homeland/`).
    - You should see the Homeland website's homepage.

### Accessing the Admin Panel

- Navigate to `http://localhost/homeland/admin-panel/`.
- You can log in using the default admin credentials found in the `admins` table. You can find a hashed password in the `homeland.sql` file.

---

*This README was generated based on the project's file structure and code.*