<?php
include_once("RFIDManager.php");
// Initialize RFIDManager
$rfidManager = new RFIDManager();
// Fetch the table name using the getter method
$tableName = $rfidManager->getTableName();
// Fetch all transactions
$sql = "SELECT * FROM " . $tableName . " ORDER BY id DESC";
$stmt = $rfidManager->getConnection()->prepare($sql);
$stmt->execute();
$attendances = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <script src="jquery-3.7.1.min.js"></script>
    <style>
        body {
            height: 100vh;
            width: 100%;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .sidebar {
            background-color: #333;
            width: 200px;
            padding-top: 20px;
            color: white;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .sidebar ul li a:hover {
            background-color: #555;
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-left: 200px;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #474a49;
            color: white;
        }        

        button#edit {
            background-color: #4CAF50;
            color: white;
        }
        button#delete {
            background-color: rgb(252, 112, 5);
            color: white;
        }

        .header {
            position: relative;
            background-color: #f4f4f4;
            padding: 20px;
            border-bottom: 2px solid #ddd;
        }

        .header h1 {
            margin: 0;
            text-align: center;
        }

        #pagination-controls {
            position: absolute;
            bottom: 20px; /* Distance from the bottom of the page */
            right: 20px; /* Distance from the right edge of the page */
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        #pagination-controls button {
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #302a25;
            color: white;
            transition: background-color 0.3s ease;
        }

        #pagination-controls button:hover {
            background-color: #020202;
        }

        #pagination-controls button:disabled {
            background-color: #ccc; /* Gray color for disabled buttons */
            cursor: not-allowed;
        }

        #order-div {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>All Employees attendance management is here!</h1>
    </div>

    <main style="display: flex;">
        <div class="sidebar">
            <ul style="list-style-type: none;" id="sidebar-list">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Employees</a></li>
                <li><a href="#">Attendance</a></li>
                <li><a href="#">Payroll</a></li>
                <li><a href="#">Leave Requests</a></li>
                <li><a href="#">Work Shifts</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">User Management</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </div>

        <table id="customers">
        <thead>
            <tr>
                <th>
                    <div id="order-div">
                        No. 
                        <button type="button" id="order-toggle">
                            <span id="order-icon">&#8593;</span> <!-- Initial Up Arrow (Ascending) -->
                        </button>
                    </div>
                </th>
                <th>Names</th>
                <th>clock_in</th>
                <th>clock_out</th>
                <th>hours_worked</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($attendances)): ?>
                    <?php foreach ($attendances as $attendance): ?>
                        <tr>
                            <td><?= htmlspecialchars($attendance['id']) ?></td>
                            <td><?= htmlspecialchars($attendance['name']) ?></td>
                            <td><?= htmlspecialchars($attendance['clock_in']) ?></td>
                            <td><?= htmlspecialchars($attendance['clock_out']) ?></td>
                            <td><?= htmlspecialchars($attendance['hours_worked']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr style="text-align: center; padding: 20px; color: #888;">
                        <td colspan="6" class="no-data">No Attendances found.</td>
                    </tr>
                <?php endif; ?>
        </tbody>
    
    </table>
    </main>

<footer>
    <section id="pagination-controls">
        <!-- <article style="margin-top: 2rem;">
                &copy; <?= date('Y') ?> Benax Technologies. All rights reserved. | <a href="https://benax.rw">benax.rw</a>
        </article> -->

        <article style="margin-left: 200px;">
            <button id="first" onclick="goToPage(1)">First</button>
            <button id="prev" onclick="goToPage(currentPage - 1)">Previous</button>
            <span id="page-number">Page 1</span>
            <button id="next" onclick="goToPage(currentPage + 1)">Next</button>
            <button id="last" onclick="goToPage(totalPages)">Last</button>
        </article>
      </section>
</footer>
</body>
</html>