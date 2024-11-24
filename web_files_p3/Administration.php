<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['Position_id'] != 1) {
    header('Location: login.php'); 
    exit();
}

require_once 'model.php';
$db = new SimpleDB();
$data = [];

$data['departments'] = $db->query("SELECT * FROM uw_department");
$data['positions'] = $db->query("SELECT * FROM uw_position");
$data['employees'] = $db->query("SELECT * FROM uw_employee");
$data['dept_locations'] = $db->query("SELECT * FROM uw_dept_locations");
$data['projects'] = $db->query("SELECT * FROM uw_project");
$data['employee_benefits'] = $db->query("SELECT * FROM uw_employee_benefits");
$data['works_on'] = $db->query("SELECT * FROM uw_works_on");
$data['dependents'] = $db->query("SELECT * FROM uw_dependent");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .section {
            display: none;
        }
        .featureb {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

    </style>
    <script>
        // Toggle visibility of each section
        function toggleSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });
            const section = document.getElementById(sectionId);
            if (section) {
                section.style.display = 'block'; // Show the selected section
            }
        }
    </script>
</head>

<body>
    <h1>Welcome to the Administration Panel</h1>

    <!-- Buttons -->
    <button class="featureb" onclick="toggleSection('departments')">Show Departments</button>
    <button class="featureb" onclick="toggleSection('positions')">Show Positions</button>
    <button class="featureb" onclick="toggleSection('employees')">Show Employees</button>
    <button class="featureb" onclick="toggleSection('dept_locations')">Show Department Locations</button>
    <button class="featureb" onclick="toggleSection('projects')">Show Projects</f_button>
    <button class="featureb" onclick="toggleSection('employee_benefits')">Show Employee Benefits</button>
    <button class="featureb" onclick="toggleSection('works_on')">Show Works On</Fbutton>
    <button class="featureb" onclick="toggleSection('dependents')">Show Dependents</Fbutton>
    <button class="featureb" onclick="location.href='find_dependents.php'">Find Dependents</Fbutton>
    <button class="featureb" onclick="location.href='find_employee.php'">Find Employee</button>
    <button class="featureb" onclick="location.href='add_employee.php'">Add Employee</button>
    <button class="featureb" onclick="location.href='delete_employee.php'">Delete Employee</button>
    <button class="featureb" onclick="location.href='sum_salary.php'">Sum Salary</button>
    <button class="featureb" onclick="location.href='average_salary.php'">Average Salary</button>
    <br>
    <br>
    <button onclick="location.href='logout.php'">Log Out</button>

    <!-- Departments Section -->
    <div id="departments" class="section">
        <h2>All Departments</h2>
        <table>
            <thead>
                <tr>
                    <th>Dnumber</th>
                    <th>Dname</th>
                    <th>Mgr SSN</th>
                    <th>Mgr Start Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['departments'] as $department): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($department['Dnumber']); ?></td>
                        <td><?php echo htmlspecialchars($department['Dname']); ?></td>
                        <td><?php echo htmlspecialchars($department['Mgr_ssn']); ?></td>
                        <td><?php echo htmlspecialchars($department['Mgr_start_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Positions Section -->
    <div id="positions" class="section">
        <h2>All Positions</h2>
        <table>
            <thead>
                <tr>
                    <th>Position ID</th>
                    <th>Position Name</th>
                    <th>Min Salary</th>
                    <th>Max Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['positions'] as $position): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($position['Position_id']); ?></td>
                        <td><?php echo htmlspecialchars($position['Position_name']); ?></td>
                        <td><?php echo htmlspecialchars($position['Min_salary']); ?></td>
                        <td><?php echo htmlspecialchars($position['Max_salary']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Employees Section -->
    <div id="employees" class="section">
        <h2>All Employees</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee SSN</th>
                    <th>First Name</th>
                    <th>Middle Name Init</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Bdate</th>
                    <th>Adress</th>
                    <th>Position ID</th>
                    <th>Department Number</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['employees'] as $employee): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($employee['Ssn']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Fname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Minit']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Lname']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Sex']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Bdate']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Address']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Position_id']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Dno']); ?></td>
                        <td><?php echo htmlspecialchars($employee['Salary']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Department Locations Section -->
    <div id="dept_locations" class="section">
        <h2>All Department Locations</h2>
        <table>
            <thead>
                <tr>
                    <th>Dnumber</th>
                    <th>Dlocation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['dept_locations'] as $location): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($location['Dnumber']); ?></td>
                        <td><?php echo htmlspecialchars($location['Dlocation']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Projects Section -->
    <div id="projects" class="section">
        <h2>All Projects</h2>
        <table>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Number</th>
                    <th>Project Location</th>
                    <th>Department Number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['projects'] as $project): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($project['Pname']); ?></td>
                        <td><?php echo htmlspecialchars($project['Pnumber']); ?></td>
                        <td><?php echo htmlspecialchars($project['Plocation']); ?></td>
                        <td><?php echo htmlspecialchars($project['Dnum']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Employee Benefits Section -->
    <div id="employee_benefits" class="section">
        <h2>All Employee Benefits</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee SSN</th>
                    <th>Benefit Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['employee_benefits'] as $benefit): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($benefit['Essn']); ?></td>
                        <td><?php echo htmlspecialchars($benefit['Benefit_name']); ?></td>
                        <td><?php echo htmlspecialchars($benefit['Description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Works On Section -->
    <div id="works_on" class="section">
        <h2>All Works On</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee SSN</th>
                    <th>Project Number</th>
                    <th>Hours Worked</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['works_on'] as $work): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($work['Essn']); ?></td>
                        <td><?php echo htmlspecialchars($work['Pno']); ?></td>
                        <td><?php echo htmlspecialchars($work['Hours']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Dependents Section -->
    <div id="dependents" class="section">
        <h2>All Dependents</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee SSN</th>
                    <th>Dependent Name</th>
                    <th>Relationship</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['dependents'] as $dependent): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dependent['Essn']); ?></td>
                        <td><?php echo htmlspecialchars($dependent['Dependent_name']); ?></td>
                        <td><?php echo htmlspecialchars($dependent['Relationship']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
