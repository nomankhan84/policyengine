# RBAC Policy Engine with Hierarchical Access

## 📌 Overview
This project is an **RBAC (Role-Based Access Control) Policy Engine** designed to manage hierarchical access for multiple applications. It allows for:
- **Main Apps** and **Sub Apps** to manage access control.
- Creating **Roles** and assigning **Permissions** to these roles.
- Assigning **Roles** to Users.
- **Main App admins, developers, and marketers** having access to **all apps**.
- **Sub App admins, developers, and other roles** having access **only to their own Sub App's data**.

## 🏗️ How It Works
### 1️⃣ **User Management**
- Users are registered and assigned a **role**.
- Roles determine **what actions they can perform**.
- Users belong to either a **Main App** or a **Sub App**.

### 2️⃣ **Role & Permission Management**
- **Roles** are created and stored in the `roles` table.
- **Permissions** are created and assigned to roles in the `role_permissions` table.
- Each **role** can have multiple **permissions**.

### 3️⃣ **Access Control Logic**
- **Main App Users** (Admins, Developers, Marketers) **have full access** to all data.
- **Sub App Users** can **only access data of their own Sub App**.

## 🚀 Installation Guide
### 1️⃣ **Clone the Project**
```bash
git clone https://github.com/your-repository-name.git
cd your-repository-name
```

### 2️⃣ **Install Dependencies**
```bash
composer install
npm install # If frontend assets are needed
```

### 3️⃣ **Set Up Database**
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 4️⃣ **Configure Environment Variables**
Copy `.env` file:
```bash
cp .env.example .env
```
Update the database URL inside `.env`:
```
DATABASE_URL=mysql://user:password@127.0.0.1:3306/database_name
```

### 5️⃣ **Run the Symfony Server**
```bash
symfony server:start
```
Your application will be available at **http://127.0.0.1:8000**

## 🎯 Usage Guide
### 1️⃣ **Login & Dashboard**
- After logging in, the user is redirected to the **dashboard**.
- The dashboard dynamically shows the **role** and **permissions** of the logged-in user.
- If the user belongs to a **Sub App**, they will only see their own app’s data.

### 2️⃣ **Manage Roles & Permissions**
- Admins can create new **roles**.
- Admins can assign **permissions** to each role.
- Users can be assigned **roles** from the dashboard.

### 3️⃣ **Access Control Rules**
| User Role       | Access Level               |
|----------------|---------------------------|
| Main App Admin | Full access to all data   |
| Main App Dev   | Full access to all data   |
| Sub App Admin  | Access to only their app |
| Sub App Dev    | Access to only their app |


## **Project Links**
| Feature | URL |
|---------|-----|
| **Register** | [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register) |
| **Login** | [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login) |
| **Dashboard** | [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard) |
| **Users List** | [http://127.0.0.1:8000/admin/users](http://127.0.0.1:8000/admin/users) |
| **Assign Roles to Users** | [http://127.0.0.1:8000/admin/users/{id}/assign-role](http://127.0.0.1:8000/admin/users/{id}/assign-role) |
| **Roles Management** | [http://127.0.0.1:8000/admin/roles](http://127.0.0.1:8000/admin/roles) |
| **Permissions Management** | [http://127.0.0.1:8000/admin/permissions](http://127.0.0.1:8000/admin/permissions) |


## 📌 Future Enhancements
- Implement **2FA authentication** for better security.
- Add **logging & monitoring** for access control actions.
- Create **API endpoints** for external integrations.

## 🛠️ Tech Stack
- **Symfony** (PHP Framework)
- **Doctrine ORM** (Database Management)
- **Twig** (Templating Engine)
- **MySQL** (Database)
- **Bootstrap** (Frontend Styling)

## ✨ Contributing
If you want to contribute, fork the repository, create a new branch, and submit a pull request!

## 📄 License
This project is licensed under the MIT License.

---
**🎉 Done! Now your project is documented properly! 🚀**
