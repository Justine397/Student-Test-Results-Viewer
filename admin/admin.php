<?php
session_start(); // Start the session

// Include login.php file
include '../login/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
    <script src="admin.js"></script>
</head>
<body>
    <div class="container1">
        <div class="container2">
            <div class="container3">
                <div class="mainContainer">
                    <header>
                        <div class="imgContainer">
                            <img src="../images/admin/default.jpg" alt="student_image" class="mainIMG">
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
                            <div class="populationHeader">Population</div>
                        </div>
                    </div>
                    <hr>
                    <div class="content">
                        <div class="tab-container">
                            <div class="tab-header">
                                <button class="tab-button active" data-tab="tab1">1st Year</button>
                                <button class="tab-button" data-tab="tab2">2nd Year</button>
                                <button class="tab-button" data-tab="tab3">3rd Year</button>
                            </div>
                            <div class="tab-content" id="tab1">
                                <div class="tableWrapper">
                                     <div>tab 1</div>
                                </div>
                            </div>
                            <div class="tab-content" id="tab2" style="display: none;">
                                <div class="tableWrapper">
                                    <div>tab 2</div>
                                </div>
                            </div>
                            <div class="tab-content" id="tab3" style="display: none;">
                                <div class="tableWrapper">
                                    <div>tab 3</div>
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
