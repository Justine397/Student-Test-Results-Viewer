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
    <title>Instructor</title>
    <link rel="stylesheet" href="../assets/style.css">
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
                            <img src="../assets/images/instructor/lisa.jpg" alt="student_image" class="mainIMG">
                        </div>
                        <div class="infoContainer">
                            <div class="nameContainer">
                                <div class="info">Name:</div>
                                <?php include '../login/login.php'; echo $_SESSION['full_name']; ?>
                            </div>
                            <div class="idContainer">
                                <div class="info">ID No.</div>
                                <?php include '../login/login.php'; echo $_SESSION['idNo']; ?>
                            </div>
                            <div class="sectionContainer">
                                <div class="info">Section:</div>
                                <?php include '../login/login.php'; echo $_SESSION['section']; ?>
                            </div>
                        </div>
                    </header>
                    <hr>
                    <div class="features">
                        <div class="searchContainer">
                            <div class="searchHeader">Search Student</div>
                            <input type="search" id="search" placeholder="Search Student 🔎">
                            <div id="searchResults"></div>
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
                                    <div class="section">1A - 2A</div>
                                    <div class="section">1B - 2B</div>
                                    <div class="section">1C - 2C</div>
                                </div>
                            </div>
                            <div class="tab-content" id="tab2" style="display: none;">
                                <div class="tableWrapper">  
                                    <div class="section">3D - 4D</div>
                                    <div class="section">3E - 4E</div>
                                    <div class="section">3F - 4F</div>
                                </div>
                            </div>
                            <div class="tab-content" id="tab3" style="display: none;">
                                <div class="tableWrapper">
                                    <div class="section">5G - 6G</div>
                                    <div class="section">5H - 6H</div>
                                    <div class="section">5I - 6I</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../assets/instructor.js"></script>
</body>
</html>