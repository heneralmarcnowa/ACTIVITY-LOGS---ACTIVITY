CREATE TABLE user_accounts (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    password TEXT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE activity_logs (
    activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    operation VARCHAR(255),
    application_id INT,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE teacher_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    phone_number VARCHAR(20),
    gender VARCHAR(50),
    address VARCHAR(255),
    state VARCHAR(255),
    nationality VARCHAR(255),
    qualification VARCHAR(255),
    experience_years INT,
    subjects VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    added_by VARCHAR(255),
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_updated_by VARCHAR(255)
);

INSERT INTO teacher_applications (id, first_name, last_name, email, phone_number, gender, address, state, nationality, qualification, experience_years, subjects, date_added) VALUES
(1, 'Darrin', 'Fawlks', 'dfawlks0@xinhuanet.com', '123-456-7890', 'Male', '1st Floor', 'Villa Paula de Sarmiento', 'Argentina', 'Bachelor of Education', 5, 'Mathematics', '2024-05-09 22:12:22'),
(2, 'Jane', 'Doe', 'jane.doe@example.com', '987-654-3210', 'Female', '2nd Street', 'New York', 'USA', 'Master of Education', 8, 'Science', '2024-06-15 14:30:00'),
(3, 'John', 'Smith', 'john.smith@example.com', '555-123-4567', 'Male', '3rd Avenue', 'London', 'UK', 'PhD in Education', 10, 'History', '2024-07-20 10:00:00'),
(4, 'Alice', 'Johnson', 'alice.johnson@example.com', '444-777-8888', 'Female', '4th Boulevard', 'Sydney', 'Australia', 'Bachelor of Arts in Education', 3, 'English', '2024-08-25 16:45:00'),
(5, 'Bob', 'Brown', 'bob.brown@example.com', '222-333-4444', 'Male', '5th Lane', 'Toronto', 'Canada', 'Diploma in Education', 6, 'Physical Education', '2024-09-10 09:15:00'),
(6, 'Emily', 'Davis', 'emily.davis@example.com', '111-222-3333', 'Female', 'Main Street', 'Los Angeles', 'USA', 'Bachelor of Science in Education', 4, 'Biology', '2024-05-12 10:20:30'),
(7, 'Michael', 'Wilson', 'michael.wilson@example.com', '555-666-7777', 'Male', 'High Street', 'Chicago', 'USA', 'Master of Arts in Education', 7, 'Geography', '2024-06-18 12:45:00'),
(8, 'Jessica', 'Martinez', 'jessica.martinez@example.com', '888-999-0000', 'Female', 'Elm Street', 'Houston', 'USA', 'Bachelor of Education', 3, 'Chemistry', '2024-07-22 14:00:00'),
(9, 'David', 'Anderson', 'david.anderson@example.com', '444-555-6666', 'Male', 'Oak Avenue', 'Phoenix', 'USA', 'PhD in Education', 9, 'Physics', '2024-08-29 16:30:00'),
(10, 'Sarah', 'Taylor', 'sarah.taylor@example.com', '333-444-5555', 'Female', 'Pine Road', 'Philadelphia', 'USA', 'Master of Education', 6, 'Social Studies', '2024-09-12 18:15:00');