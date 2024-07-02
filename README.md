# Document Storing System

## Installation Instructions

### Step 1: Clone the Repository

```bash
git clone git@github.com:sairilseb-me/document_storing_system.git
```

### Step 2: Navigate into the Project Directory

```bash
cd document_storing_system
```
### Step 3: Install PHP Dependencies

```bash
npm install
```


### Step 4: Install JavaScript Dependencies

```bash
npm run build
# or
npm run dev

```

### Step 5: Build Assets

```bash
npm run build
# or
npm run dev
```

If you encounter errors when running the build commands, delete the node_modules directory and try again.

```bash
rm -rf node_modules
npm install
npm run build
# or
npm run dev
```

### Step 6: Set Up Environment Variables
Create a .env file in the root directory of the project.

```bash
cp .env.example .env
```

### Step 7: Generate Application Key

```bash
php artisan key:generate
```

### Step 8: Run Migrations

```bash
php artisan migrate
```

### Step 9: Seed the Database

```bash
php artisan db:seed --class=UserSeeder
```

### Step 10: Connect to NAS
Ensure you are connected to the same network as the NAS.

### Step 11: Create a Symlink for Storage
For Windows:

```bash
mklink /D "system path\public\storage" "\\NAS Path"
```

For Mac or Unix-based OS:

```bash
ln -s "//NAS Path" "system path/public/storage"
```

### Step 12: Serve the Application

```bash
php artisan serve --host=<host ip> --port=<port>
```

### Step 13: Troubleshooting UI Issues
If you encounter issues loading the UI, delete the hot file in the public/build directory.

```bash
rm public/build/hot
```


