CREATE DATABASE intern;

USE intern;

CREATE TABLE Student (
	student_Id INTEGER(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY (student_Id)
);

INSERT INTO Student VALUES(202001882, '202001882@ub.ac.bw');
INSERT INTO Student VALUES(202001883, '202001883@ub.ac.bw');
INSERT INTO Student VALUES(202006269, '202006269@ub.ac.bw');

-- Selects all data from the student table
SELECT * FROM Student;

-- Deletes all data from the student table
DELETE FROM Student;

 -- Deletes student table
DROP TABLE Student;


-- table for all the students
CREATE TABLE Student_account (
	student_Id INTEGER(20) NOT NULL,
    password VARCHAR(100) NOT NULL,
    full_Name VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    year INTEGER(5) NOT NULL,
    status VARCHAR(20) NOT NULL,
    supervisor INTEGER(5),
    preference VARCHAR(50),
    course VARCHAR(100) NOT NULL,
    last_login INTEGER(50) NOT NULL,
    account_status SMALLINT(3) NOT NULL,
    date_created INTEGER(50) NOT NULL,
    PRIMARY KEY (student_Id),
    FOREIGN KEY (student_Id) REFERENCES Student(student_Id),
    FOREIGN KEY (supervisor) REFERENCES Supervisor(supervisorId),
    CONSTRAINT CHK_Status CHECK (status = 'student') -- checks if number of rooms is greater than 0
);
DELETE FROM student_account;

-- Selects all data from the student table
SELECT * FROM Student_account;

DELETE FROM Student_account WHERE student_Id = '202006269';
-- Selects all data from the student table
DROP TABLE Student_account;

CREATE TABLE Supervisor (
	supervisorId INTEGER(5) AUTO_INCREMENT,
	fullname VARCHAR(20) NOT NULL,
--     status VARCHAR(20) NOT NULL,
--     last_login INTEGER(50) NOT NULL,
--     account_status SMALLINT(3) NOT NULL,
    PRIMARY KEY (supervisorId)
);

-- inserts data into the Supervisor table
INSERT INTO Supervisor(fullname) VALUES('Govan Deboz');
INSERT INTO Supervisor(fullname) VALUES('Luna Rose');
INSERT INTO Supervisor(fullname) VALUES('Ben Dover');

 -- Deletes Supervisor table
DROP TABLE Supervisor;

-- Selects all data from the Supervisor table
SELECT * FROM Supervisor;

-- inserts data into the student table
INSERT INTO Student() VALUES(202001882,'Thembi','Dibotelo','student','computer science');

CREATE TABLE Organization (
	name VARCHAR(50) NOT NULL,
    city VARCHAR(100) NOT NULL,
    PRIMARY KEY (name)
);

-- inserts data into the Organisation table
INSERT INTO Organization() VALUES('Debswana','Gaborone');
INSERT INTO Organization() VALUES('Tswana','Francistown');
INSERT INTO Organization() VALUES('Code','Serowe');

-- Selects all data from the Organisation table
SELECT * FROM Organization;

DELETE FROM Organization WHERE name="Bostwana Hub";

SELECT * FROM Organization WHERE name = 'Debswana';

 -- Deletes Organisation table
DROP TABLE Organization;

CREATE TABLE Org_account (
	name VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    supervisor VARCHAR(50) NOT NULL,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL,
    phone INTEGER(15) NOT NULL,
    status VARCHAR(50) NOT NULL,
    last_login INTEGER(50) NOT NULL,
    account_status SMALLINT(3) NOT NULL,
    date_created INTEGER(50) NOT NULL,
    about VARCHAR(500),
    PRIMARY KEY (name),
    FOREIGN KEY (name) REFERENCES Organization(name),
    CONSTRAINT CHK_Status CHECK (status = 'organisation') -- checks if number of rooms is greater than 0
);

-- Selects all data from the Organisation table
SELECT * FROM Org_account;

 -- Deletes Organisation table
DROP TABLE Org_account;

DELETE FROM Org_account WHERE name="Code";

CREATE TABLE Internship (
	internId INTEGER(10) NOT NULL AUTO_INCREMENT, -- Reference number is auto generated
    company VARCHAR(50) NOT NULL,
    position VARCHAR(50) NOT NULL,
    available_position INTEGER(10) DEFAULT 0,
    location VARCHAR(80) NOT NULL,
    duration VARCHAR(30) NOT NULL,
    stipend INTEGER(50) DEFAULT 0,
    phone INTEGER(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    due_date DATE NOT NULL, -- format for Mysql is YYYY-MM-DD and for SQL server is for example 14-Aug-2022
    about_intern VARCHAR(500),
    PRIMARY KEY (internId),
    FOREIGN KEY (company) REFERENCES Org_account(name)
);

-- Selects all data from the internship table
SELECT * FROM Internship;

DELETE FROM Internship WHERE location = 'Gantsi';

 -- Deletes internship table
DROP TABLE Internship;

CREATE TABLE files (
	fileId INTEGER(5) NOT NULL AUTO_INCREMENT,
    fileName VARCHAR(100) NOT NULL,
    fileOwner INTEGER(20) NOT NULL,
    fileType VARCHAR(20) NOT NULL,
    file BLOB,
    PRIMARY KEY (fileId),
    FOREIGN KEY (fileOwner) REFERENCES Student(student_Id)
);

SELECT * FROM files;

DELETE FROM files;