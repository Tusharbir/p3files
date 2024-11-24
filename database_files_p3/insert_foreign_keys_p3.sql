-- Add foreign key constraints to the uw_employee table
ALTER TABLE uw_employee
ADD CONSTRAINT fk_super_ssn FOREIGN KEY (Super_ssn) REFERENCES uw_employee(Ssn);

ALTER TABLE uw_employee
ADD CONSTRAINT fk_dno FOREIGN KEY (Dno) REFERENCES uw_department(Dnumber);

ALTER TABLE uw_employee
ADD CONSTRAINT fk_position_id FOREIGN KEY (Position_id) REFERENCES uw_position(Position_id);

-- Add foreign key constraints to the uw_department table
ALTER TABLE uw_department
ADD CONSTRAINT fk_mgr_ssn FOREIGN KEY (Mgr_ssn) REFERENCES uw_employee(Ssn);

-- Add foreign key constraints to the uw_dept_locations table
ALTER TABLE uw_dept_locations
ADD CONSTRAINT fk_dept_locations_dnumber FOREIGN KEY (Dnumber) REFERENCES uw_department(Dnumber);

-- Add foreign key constraints to the uw_project table
ALTER TABLE uw_project
ADD CONSTRAINT fk_project_dnum FOREIGN KEY (Dnum) REFERENCES uw_department(Dnumber);

-- Add foreign key constraints to the uw_works_on table
ALTER TABLE uw_works_on
ADD CONSTRAINT fk_works_on_essn FOREIGN KEY (Essn) REFERENCES uw_employee(Ssn);

ALTER TABLE uw_works_on
ADD CONSTRAINT fk_works_on_pno FOREIGN KEY (Pno) REFERENCES uw_project(Pnumber);

-- Add foreign key constraints to the uw_dependent table
ALTER TABLE uw_dependent
ADD CONSTRAINT fk_dependent_essn FOREIGN KEY (Essn) REFERENCES uw_employee(Ssn);

-- Add foreign key constraints to the uw_employee_benefits table
ALTER TABLE uw_employee_benefits
ADD CONSTRAINT fk_employee_benefits_essn FOREIGN KEY (Essn) REFERENCES uw_employee(Ssn);
