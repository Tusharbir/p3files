-- Create the uw_position table
CREATE TABLE uw_position (
    Position_id INT NOT NULL,  
    Position_name VARCHAR(30) NOT NULL,       
    Min_salary DECIMAL(10, 2),                
    Max_salary DECIMAL(10, 2),                
    PRIMARY KEY (Position_id)
);

-- Create the uw_department table
CREATE TABLE uw_department (
    Dname VARCHAR(15) NOT NULL UNIQUE,  
    Dnumber INT NOT NULL,               
    Mgr_ssn CHAR(9) NOT NULL,           
    Mgr_start_date DATE,                
    PRIMARY KEY (Dnumber)
);

-- Create the uw_employee table
CREATE TABLE uw_employee (
    Fname VARCHAR(15) NOT NULL,     
    Minit CHAR(1),                  
    Lname VARCHAR(15) NOT NULL,     
    Ssn CHAR(9) NOT NULL,           
    Bdate DATE,                     
    Address VARCHAR(30),            
    Sex CHAR(1),                   
    Salary DECIMAL(10, 2),       
    Super_ssn CHAR(9),             
    Dno INT NOT NULL,               
    Position_id INT NOT NULL,      
    PRIMARY KEY (Ssn)
);

-- Create the uw_dept_locations table
CREATE TABLE uw_dept_locations (
    Dnumber INT NOT NULL,                
    Dlocation VARCHAR(15) NOT NULL,     
    PRIMARY KEY (Dnumber, Dlocation)
);

-- Create the uw_project table
CREATE TABLE uw_project (
    Pname VARCHAR(15) NOT NULL UNIQUE,   
    Pnumber INT NOT NULL,                
    Plocation VARCHAR(15) NOT NULL,      
    Dnum INT NOT NULL,                 
    PRIMARY KEY (Pnumber)
);

-- Create the uw_works_on table
CREATE TABLE uw_works_on (
    Essn CHAR(9) NOT NULL,               
    Pno INT NOT NULL,                    
    Hours DECIMAL(3, 1) NOT NULL,        
    PRIMARY KEY (Essn, Pno)
);

-- Create the uw_dependent table
CREATE TABLE uw_dependent (
    Essn CHAR(9) NOT NULL,               
    Dependent_name VARCHAR(15) NOT NULL, 
    Sex CHAR(1),                         
    Bdate DATE,                          
    Relationship VARCHAR(8),           
    PRIMARY KEY (Essn, Dependent_name)
);

-- Create the uw_employee_benefits table
CREATE TABLE uw_employee_benefits (
    Essn CHAR(9) NOT NULL,                   
    Benefit_name VARCHAR(50) NOT NULL,       
    Description VARCHAR(100),                
    PRIMARY KEY (Essn, Benefit_name)
);
