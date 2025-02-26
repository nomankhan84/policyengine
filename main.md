RBAC-based policy engine with a hierarchical access model where the main application and sub-applications have separate user roles, but some roles (like main application developers) have access to both.

Key Points to Implement:
Separate User Registration & Role Assignment

Users can register on either the main application or a sub-application.
Roles are assigned based on where the user is registered.
Users can have different permissions depending on the application.
Role & Permission Hierarchy

Super Admin (Main App) → Full access to main and all sub-applications.
Admin (Sub-App) → Only manages their respective sub-application.
Developers (Main App) → Access to both main and sub-apps.
Developers (Sub-App) → Access only to their sub-application.
Marketing (Main App) → Can manage marketing for all.
Marketing (Sub-App) → Can manage marketing only for their sub-application.
Data Access & Enforcement

Implement scoped access control so:
Main app developers see and modify both main & sub-application data.
Sub-app developers see only their sub-application data.
Use Security Voters or Middleware to check:
If a user is in the correct role.
If a user is trying to access unauthorized data.
Database Structure

Users Table (stores general user details)
Roles Table (super admin, admin, developer, marketing, etc.)
Permissions Table (actions allowed per role)
Applications Table (main application & sub-applications)
User_Application Table (links users to the app they belong to)
Role_Application Table (links roles to a specific app)
API & Dashboard

API for managing users, roles, and permissions.
Admin dashboard to assign roles and manage access.
Next Steps
Implement database design for role-based access control.
Set up authentication & role management.
Enforce data access rules using middleware or security voters.
Build an admin dashboard (optional) for role assignment.
