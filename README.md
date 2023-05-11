# MarksMate

MarksMate is a university marks management system designed to streamline grade management for students, faculty, and administrators.

## Features
- **Student Portal (PHP)**
  - View grades and academic progress.
  - Download mark sheets.
- **Faculty Portal (PHP)**
  - Upload and manage student grades.
  - Generate performance reports.
- **Admin Dashboard (MERN)**
  - Manage users (students, faculty, admins).
  - Monitor and control the grading system.
  
## Tech Stack
- **Frontend (Admin Dashboard):** React.js
- **Backend:** Node.js (for admin), PHP (for student & faculty)
- **Database:** MSSQL
- **Authentication:** JWT-based authentication

## Installation

### Prerequisites
- Node.js & npm
- PHP & Apache Server
- MSSQL Server

### Setup Instructions
#### Admin (MERN Stack)
1. Navigate to the `admin` folder:
   ```sh
   cd admin
   ```
2. Install dependencies:
   ```sh
   npm install
   ```
3. Start the server:
   ```sh
   npm start
   ```

#### Student & Faculty (PHP)
1. Set up a local Apache server (e.g., XAMPP).
2. Place the PHP files in the `htdocs` directory.
3. Configure the database connection in `config.php`.
4. Start Apache and MSSQL services.

## Database Configuration
Ensure MSSQL is running and update database credentials in respective config files.

## Contributing
Pull requests are welcome. Ensure to follow best coding practices.

## License
This project is licensed under the GPL 3.0 License.