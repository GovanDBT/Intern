CREATE DATABASE intern;

USE intern;

-- table for all the students
CREATE TABLE Student (
	student_Id INTEGER(10) NOT NULL,
    first_Name VARCHAR(50) NOT NULL,
    last_Name VARCHAR(50) NOT NULL,
    status VARCHAR(20) NOT NULL,
    course VARCHAR(100) NOT NULL,
    PRIMARY KEY (student_Id)
);

-- inserts data into the student table
INSERT INTO Student() VALUES(202001882,'Thembi','Dibotelo','student','computer science');

-- Selects all data from the Client table
SELECT * FROM Student;

-- Deletes all data from the student table
DELETE FROM Student;

 -- Deletes student table
DROP TABLE Student;

CREATE TABLE Organisation (
	
    PRIMARY KEY ()
);

CREATE TABLE Supervisor (
	
    PRIMARY KEY ()
);