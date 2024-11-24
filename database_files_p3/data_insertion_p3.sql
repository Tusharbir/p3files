-- Insert values into the uw_position table
INSERT INTO uw_position (Position_id, Position_name, Min_salary, Max_salary)
VALUES
(1, 'Administration', 60000.00, 120000.00),
(2, 'Manager', 50000.00, 100000.00),
(3, 'Employee', 40000.00, 90000.00);

-- Insert values into the uw_department table
INSERT INTO uw_department (Dname, Dnumber, Mgr_ssn, Mgr_start_date)
VALUES
('HR', 1, '123456789', '2020-01-01'),
('Development', 2, '234567890', '2021-05-15');

-- Insert values into the uw_employee table
INSERT INTO uw_employee (Fname, Minit, Lname, Ssn, Bdate, Address, Sex, Salary, Super_ssn, Dno, Position_id)
VALUES
('John', 'A', 'Doe', '123456789', '1985-03-15', '123 Elm St', 'M', 90000.00, NULL, 1, 1), -- HR (no supervisor)
('Jane', 'B', 'Smith', '234567890', '1990-07-25', '456 Oak St', 'F', 75000.00, NULL, 2, 2), -- Manager (no supervisor)
('Mark', 'C', 'Johnson', '345678901', '1982-12-05', '789 Pine St', 'M', 85000.00, '234567890', 2, 3), -- Employee, supervisor is Manager
('Emily', 'D', 'Davis', '456789012', '1992-01-20', '101 Maple St', 'F', 65000.00, '234567890', 2, 3); -- Employee, supervisor is Manager

-- Insert values into the uw_dept_locations table
INSERT INTO uw_dept_locations (Dnumber, Dlocation)
VALUES
(1, 'New York'),
(2, 'San Francisco');

-- Insert values into the uw_project table
INSERT INTO uw_project (Pname, Pnumber, Plocation, Dnum)
VALUES
('HR', 1, 'New York', 1),
('Project Alpha', 2, 'San Francisco', 2);

-- Insert values into the uw_works_on table
INSERT INTO uw_works_on (Essn, Pno, Hours)
VALUES
('123456789', 1, 40.0),
('234567890', 2, 35.5),
('345678901', 2, 42.0),
('456789012', 2, 20.0);

-- Insert values into the uw_dependent table
INSERT INTO uw_dependent (Essn, Dependent_name, Sex, Bdate, Relationship)
VALUES
('123456789', 'Alice', 'F', '2015-05-10', 'Daughter'),
('234567890', 'Bob', 'M', '2017-08-25', 'Son'),
('345678901', 'Charlie', 'M', '2019-02-17', 'Son'),
('456789012', 'Daisy', 'F', '2014-11-12', 'Daughter');

-- Insert values into the uw_employee_benefits table
INSERT INTO uw_employee_benefits (Essn, Benefit_name, Description)
VALUES
('123456789', 'Health Insurance', 'Full coverage health plan'),
('234567890', 'Dental Insurance', 'Coverage for dental care'),
('345678901', '401k Plan', 'Retirement savings plan'),
('456789012', 'Life Insurance', 'Term life insurance policy');
