<?php
session_start(); // Start the session

// Include login.php file
include '../login/login.php';
include 'showUsersAdmin.php';
include 'population.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMS Admin </title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/admin.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        td:first-child,
        td:last-child {
            width: 10%;
        }
        td:nth-child(2) {
            width: 60%;
        }
    </style>
</head>
<body>
    <div class="container1">
        <div class="container2">
            <div class="container3">
                <div class="mainContainer">
                    <form method="post" action="../logout.php"> <!-- Modify action to logout.php -->
                        <button type="submit" class="logoutBTN" name="logout">Logout</button>
                    </form> 
                    <header>
                        <div class="imgContainer">
                            <img src="../assets/images/admin/default.jpg" alt="student_image" class="mainIMG">
                        </div>
                        <div class="infoContainer">
                            <div class="nameContainer">
                            <div class="info">Name:</div>
                                <?php echo $_SESSION['full_name']; ?>
                            </div>
                            <div class="idContainer">
                                <div class="info">ID No.</div>
                                <?php echo $_SESSION['idNo']; ?>
                            </div>
                        </div>
                    </header>
                    <hr>
                    <div class="features">
                        <div class="addAccountContainer">
                            <div class="addAccountHeader">
                                <a href="../register/register.html" id="addAccount">Add Account</a>
                            </div>
                        </div>
                        <div class="searchContainer">
                            <div class="searchHeader">Search Member</div>
                            <input type="search" id="search" placeholder="Search Member 🔎">
                            <div id="searchResults"></div>
                        </div>
                        <div class="populationContainer">
                            <div class="populationHeader">
                                Population
                            </div>
                            <div class="populationContent">
                                <div class="populationRow">
                                    <div class="populationCategory">Admin:</div>
                                    <div class="populationCount"><?php echo isset($counts['admin']) ? $counts['admin'] : 0; ?></div>
                                </div>
                                <div class="populationRow">
                                    <div class="populationCategory">Student:</div>
                                    <div class="populationCount"><?php echo isset($counts['student']) ? $counts['student'] : 0; ?></div>
                                </div>
                                <div class="populationRow">
                                    <div class="populationCategory">Instructors:</div>
                                    <div class="populationCount"><?php echo isset($counts['instructor']) ? $counts['instructor'] : 0; ?></div>
                                </div>
                                <div class="populationRow">
                                    <div class="populationCategory">Total:</div>
                                    <div class="populationCount"><?php echo array_sum($counts); ?></div>
                                </div>
                                <div id="userModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div id="modalContent">
                                            <h1>sup</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    <div class="content">
                        <hr>
                        <div class="tab-container">
                            <div class="tab-header">
                                <button class="tab-button active" data-tab="tab1">1st Year</button>
                                <button class="tab-button" data-tab="tab2">2nd Year</button>
                                <button class="tab-button" data-tab="tab3">3rd Year</button>
                                <button class="tab-button" data-tab="tab4">Instructors</button>
                            </div>
                            <div class="tab-content" id="tab1">
                                <div class="tableWrapper">
                                    <?php foreach ($tab1 as $user) : ?>
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($user['section']); ?>
                                                </td> 
                                                <td>
                                                    <?php echo htmlspecialchars($user['full_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['IDNo']); ?>
                                                </td> 
                                                <td>
                                                    <a href="#" class="remove-user" data-id="<?php echo $user['IDNo']; ?>" alt="remove" title="Remove">remove</a>
                                                    <a href="#" class="view-user" data-id="<?php echo $user['IDNo']; ?>" alt="view" title="View">view</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-content" id="tab2" style="display: none;">
                                <div class="tableWrapper">
                                    <?php foreach ($tab2 as $user) : ?>
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($user['section']); ?>
                                                </td> 
                                                <td>
                                                    <?php echo htmlspecialchars($user['full_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['IDNo']); ?>
                                                </td> 
                                                <td>
                                                    <a href="#" class="remove-user" data-id="<?php echo $user['IDNo']; ?>" alt="remove" title="Remove">remove</a>
                                                    <a href="#" class="view-user" data-id="<?php echo $user['IDNo']; ?>" alt="view" title="View">view</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-content" id="tab3" style="display: none;">
                                <div class="tableWrapper">
                                    <?php foreach ($tab3 as $user) : ?>
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($user['section']); ?>
                                                </td> 
                                                <td>
                                                    <?php echo htmlspecialchars($user['full_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['IDNo']); ?>
                                                </td> 
                                                <td>
                                                    <a href="#" class="remove-user" data-id="<?php echo $user['IDNo']; ?>" alt="remove" title="Remove">remove</a>
                                                    <a href="#" class="view-user" data-id="<?php echo $user['IDNo']; ?>" alt="view" title="View">view</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-content" id="tab4" style="display: none;">
                                <div class="tableWrapper">
                                    <?php foreach ($tab4 as $user) : ?>
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($user['section']); ?>
                                                </td> 
                                                <td>
                                                    <?php echo htmlspecialchars($user['full_name']); ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($user['IDNo']); ?>
                                                </td> 
                                                <td>
                                                    <a href="#" class="remove-user" data-id="<?php echo $user['IDNo']; ?>" alt="remove" title="Remove">remove</a>
                                                    <a href="#" class="view-user" data-id="<?php echo $user['IDNo']; ?>" alt="view" title="View">view</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
