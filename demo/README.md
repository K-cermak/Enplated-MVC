# Demo Blog

- A simple blog built entirely with Enplated MVC.
- Features:
    - **User section**:
        - Listing posts
        - Reading posts
        - Filtering posts by tag

    - **Admin section**:
        - Login
        - Creating, editing, and deleting posts
        - Creating, renaming, and deleting tags
        - Assigning tags to posts
        - User management
        - Profile management
        - Logout

<br/>

# Downloading the demo
- **Demo only:**
    - Go to Releases and download `demo.zip`.

- **Demo including the Enplated MVC core:**
    - Download this repository or clone it using git:
    <br><br>
    ```bash
    git clone https://github.com/K-cermak/Enplated-MVC.git
    ```

<br/>

# Installation
- Create an empty database.
- Extract `demo.zip` (or copy the `demo` folder) into a directory on your web server.
- Open the `.env` file and set:
    - `BASE_URL` to your actual URL (e.g. http://localhost/enplated_mvc/demo). Do **not** add a trailing slash.
    - `DB_*` to your database credentials.

<br/>

# Importing the database
- **Automatic import:**
    - Open this URL in your browser:
    <br><br>
    ```
    *BASE_URL*/run/import
    (e.g. http://localhost/enplated_mvc/demo/run/import )
    ```

- **Manual import:**
    - Go to phpMyAdmin or any other database management tool.
    - Copy the contents of the <a href="https://github.com/K-cermak/Enplated-MVC/blob/main/demo/database.sql" target="_blank">database.sql</a> file and run it.

<br/>

# Opening the website
- Open your browser and go to your BASE_URL (e.g. http://localhost/enplated_mvc/demo).
- To log in, click `Admin dashboard` in the top-right corner (or go to \*BASE_URL\*/admin).
    - Login credentials are:
        - `admin` (password: `password`)
        - `admin2` (password: `123456`)

<br/>

### Sources used in this demo:
- Bootstrap (https://getbootstrap.com)
- Bootstrap Icons (https://icons.getbootstrap.com)
- Google Fonts (https://fonts.google.com)
- Quill.js (https://quilljs.com)
- highlight.js (https://highlightjs.org)