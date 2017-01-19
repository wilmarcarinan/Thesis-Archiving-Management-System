#Thesis Archiving Management System

* Files
	- File CRUD
	- Manage Files
	- QR Code Feature
	- Search
	- Filtering
	- Favorites
	- Recent Views
	- To-Read
	- Archive
	- Backup

* Users
	- User CRUD
	- Login
	- Forgot Password
	- User/Admin Settings
	- Manage Users

* Logs
	- Log Tracking

* Reports/Feedbacks
	- Send Feedback/Report

* Dashboard
	- View Dashboard

##Sprints

* Sprint 1
	- User CRUD
	- File CRUD
	- QR Code Feature
	- Search
	- Login
	- Forgot Password

* Sprint 2
	- User/Admin Settings
	- Manage Files
	- Manage Users
	- Log Tracking

* Sprint 3
	- Filtering
	- Recent Views
	- Favorites
	- To-read

* Sprint 4
	- Archive
	- Backup
	- View Dashboard
	- Send Feedback/Report

##Database

* Users
	- id
	- StudentID
	- FirstName
	- MiddleName
	- LastName
	- Course
	- College
	- email
	- password
	- Role
	- Status
	- rememberToken
	- created_at
	- updated_at

* Files
	- id
	- FileTitle
	- Abstract
	- Category
	- Authors
	- Adviser
	- FilePath
	- Status
	- created_at
	- updated_at

* Logs
	- id
	- Subject
	- Details
	- student_id
	- created_at
	- updated_at

* password_resets
	- email
	- token
	- created_at

* migrations
	- id
	- migration
	- batch

* Recent_Views
	- id
	- recent_view
	- file_id
	- user_id
	- created_at
	- updated_at

* Favorites
	- id
	- favorite
	- file_id
	- user_id
	- created_at
	- updated_at

* Notes
	- id
	- note
	- file_id
	- user_id
	- created_at
	- updated_at

* To-read
	- id
	- to-read
	- file_id
	- user_id
	- created_at
	- updated_at

* Messages
	- id
	- message
	- user_id
	- created_at
	- updated_at