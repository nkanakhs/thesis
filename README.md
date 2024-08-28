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

1. Login Page
The first step in using the application is logging in. Below is a screenshot of the login page where users can enter their credentials to access the system.

![Login Screenshot](https://example.com/screenshot.png)
