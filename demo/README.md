# Demo Blog

- Simple blog website, built completely with Enplated MVC.
- All Functions:
    - **User section**:
        - Post listing
        - Reading of posts
        - Listing by tags 

    - **Admin section**:
        - Login
        - Posts creation, editing and deletion
        - Tags creation, editing and deletion
        - Assigning tags to posts
        - User management
        - Profile management
        - Logout

<br/>

# Downloading this Demo
- **Just downloading the demo:**
    - Go to releases and download demo.zip.

- **Downloading including the Enplated MVC Core:**
    - Download this repo or clone it using git:
    <br><br>
    ```bash
    git clone https://github.com/K-cermak/Enplated-MVC.git
    ```

<br/>

# Installation
- Create some empty database.
- Extract the `demo.zip` / `demo` folder file into some directory.
- Go to `.env` file and set:
    - `BASE_URL` to your actual URL (e.g. http://localhost/enplated_mvc/demo). DO **NOT** ADD SLASH AT THE END.
    - `DB_*` credentials to your database.

<br/>

# Import database
- **Automatic import:**
    - Open this URL in your browser:
    <br><br>
    ```
    *BASE_URL*/run/import
    (e.g. http://localhost/enplated_mvc/demo/run/import )
    ```

- **Manual import**
    - Go to phpMyAdmin or any other database management tool.
    - Copy content of <a href="https://github.com/K-cermak/Enplated-MVC/blob/main/demo/database.sql" target="_blank">database.sql file</a> and run it.

<br/>

# Opening the website
- Open your browser and go to your BASE_URL (e.g. http://localhost/enplated_mvc/demo).
- If you want to login, click on `Admin dashboard` in the right top corner (or go to *BASE_URL*/admin)
    - Login credentials are:
        - `admin` (password: `password`)
        - `admin2` (password: `123456`)

<br/>

### Sources used for this Demo:
- Bootstrap (https://getbootstrap.com)
- Bootstrap Icons (https://icons.getbootstrap.com)
- Google Fonts (https://fonts.google.com)
- Quill.js (https://quilljs.com)
- highlight.js (https://highlightjs.org)