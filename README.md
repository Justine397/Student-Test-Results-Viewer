# Grade Management System (GMS)

## **PASSWORD:** ALL ACCOUNT'S PASSWORD IN THE 'strv.sql' is '1'.

## Installation Instructions

Follow these steps to set up the Grade Management System (GMS) on your local machine.

### Step 1: Extract Files

1. Download the project files.
2. Extract the files to the `C:\xampp\htdocs\gms` directory on your machine.
3. Rename the extracted folder to `gms`.

### Step 2: Start XAMPP

1. Open XAMPP Control Panel.
2. Start the **Apache** and **MySQL** services by clicking on the "Start" buttons.

### Step 3: Create the Database

1. Open your web browser.
2. Type `localhost/createDB.php` in the address bar and press Enter.
3. This script will create the necessary database for the GMS.

### Step 4: Import the Database Schema

1. Open `phpMyAdmin` by typing `localhost/phpmyadmin` in your web browser's address bar.
2. Select the `strv` database from the left sidebar.
3. Click on the **Import** tab.
4. Click the **Choose File** button and select the `strv.sql` file.
5. Click the **Go** button to import the database schema and data.

### Step 5: Access the Application

1. Open your web browser.
2. Type `localhost/gms/` in the address bar and press Enter.
3. You should now see the Grade Management System interface.

---

By following these steps, you should have the Grade Management System up and running on your local machine. If you encounter any issues, please refer to the troubleshooting section below.

---

## Troubleshooting

If you encounter any issues during the setup process or while using the Grade Management System (GMS), refer to the following troubleshooting tips:

### 1. Database Connection Errors

**Symptoms:** You receive an error message indicating that the application could not connect to the database.

**Possible Causes:**
- MySQL service is not running in XAMPP.
- Incorrect database credentials in the application configuration file (`config.php`).

**Troubleshooting Steps:**
1. Check if the MySQL service is running in XAMPP. Open XAMPP Control Panel and start the MySQL service if it is stopped.
2. Verify the database connection settings in the `config.php` file. Ensure that the hostname, username, password, and database name are correct.

### 2. File Not Found Errors

**Symptoms:** The browser displays a "File Not Found" error when trying to access the application.

**Possible Causes:**
- Incorrect folder structure or file path.
- The project folder was not renamed to `gms`.

**Troubleshooting Steps:**
1. Double-check that you have extracted the project files to the `xampp/htdocs` directory and renamed the folder to `gms`.
2. Ensure that you are accessing the correct URL in your browser (`localhost/gms/`).

### 3. Import Errors

**Symptoms:** You encounter errors while importing the `strv.sql` file into the database using phpMyAdmin.

**Possible Causes:**
- The `strv.sql` file is corrupted or incomplete.
- Compatibility issues with MySQL versions.

**Troubleshooting Steps:**
1. Verify that the `strv.sql` file is not corrupted and contains the complete database schema and data.
2. Check if the MySQL version you are using is compatible with the SQL syntax used in the `strv.sql` file.
3. Try importing the `strv.sql` file into a new, empty database to isolate any existing data conflicts.

If you continue to experience issues, please contact justine.branzuela@gmail.com for further assistance.
