# **Workload Management and Evaluation Tool for University Courses**

_The Web application was developed to enhance the organization and scheduling of the academic workload for professors at our University. Additionally, it serves as a platform for recording course requirements and resources, while facilitating a collaborative environment for professors to evaluate students across all participating faculty members.

## **Table of Contents**
- [**Features**](#features)
- [**Installation**](#installation)
- [**Usage**](#usage)
- [**Architecture**](#architecture)
- [**Contributing**](#contributing)

## **Features**
- **User authentication and authorization**
- **Responsive design for mobile and desktop**
- **Admin dashboard** with analytics
- **Course management** partners and activities insertion & student evaluation
- **Personal calendar with analytic activities** for each professor and each course
- **Calendar Event Integration with Conflict Detection** checks if the professor is assessed with an activity on another course 
- **Icalendar integration** works for all online calendars like Google calendar, Outlook etc.
- **Supervision of grades** also keeps track of older grades


## **Installation**

1. The application was installed on a University Server in order to be evaluated by teachers.
2. We used three docker containers
    *An apache container where our PHP application serves content
    *A mySQL container where our database is located
    *A phpmyadmin container in order to provide a visual interface with the database
3. On the server we install SSL certificates so that our application can be safely accessed.


## **Usage**

Some of the core functionalities of the application are described below:

1. Login Page
The first step in using the application is logging in. Below is a screenshot of the login page where users can enter their credentials to access the system.

![Login Screenshot](https://github.com/nkanakhs/thesis/blob/main/web/images/Login.PNG)

2. Dashboard Overview
After logging in, users are taken to the main dashboard. The dashboard provides an overview of the professor's list of courses

![Welcome Screen](https://github.com/nkanakhs/thesis/blob/main/web/images/WelcomeScreen.PNG)

3. Course Management
In the course management section, users can add, update, or delete courses partners activities and evaluation courses. This section allows the management of course-related information, such as class schedules and resources.

![Manage Activities](https://github.com/nkanakhs/thesis/blob/main/web/images/AddActivity.PNG)

4. Calendar Event Creation with Conflict Detection
When creating a new event, the system checks for potential overlaps with other course activities. If there are any conflicts, the user is notified to prevent scheduling issues.

![Event Creation](https://github.com/nkanakhs/thesis/blob/main/web/images/calendar4.png)


![Event Insertion](https://github.com/nkanakhs/thesis/blob/main/web/images/Calendar7.PNG)







