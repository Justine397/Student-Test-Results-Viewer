<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="../assets/style.css">
    
</head>
<body>
    <div class="container1">
        <div class="container2">
            <div class="container3">
                <div class="mainContainer">
                    <form method="post" action="../logout.php">
                        <button type="submit" class="logoutBTN" name="logout">Logout</button>
                    </form> 
                    <header>
                        <div class="imgContainer">
                            <?php
                            $imgPath = isset($_SESSION['imgPath']) ? $_SESSION['imgPath'] : '';
                            ?>
                            <img src="<?php echo !empty($imgPath) ? '../assets/images/upload/' . htmlspecialchars($imgPath) : '../assets/images/default.jpg'; ?>" alt="user_image" class="mainIMG" id="userImage">
                            <div class="overlay" id="studentOverlay">Change Photo</div>
                                <form id="uploadForm" enctype="multipart/form-data">
                                    <input type="hidden" name="userId" value="<?php echo isset($_SESSION['idNo']) ? htmlspecialchars($_SESSION['idNo']) : ''; ?>">
                                    <input type="file" class="hidden-input" id="file-input" name="profile_pic" accept="image/*">
                                </form>
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
                    <div class="content">
                      <hr>
                        <div class="tab-container">
                            <div class="tab-header">
                                <button class="tab-button active" data-tab="tab1">1st Year</button>
                                <button class="tab-button" data-tab="tab2">2nd Year</button>
                                <button class="tab-button" data-tab="tab3">3rd Year</button>
                            </div>
                            <div class="tab-content" id="tab1">
                                <div class="tableWrapper">
                                    <table>
                                        <tr>
                                            <th>Instructor</th>
                                            <th>Subject</th>
                                            <th>1st Sem</th>
                                            <th>2nd Sem</th>
                                            <th>Final</th>
                                          </tr>
                                          <tbody id="gradesTab1"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-content" id="tab2" style="display: none;">
                                <div class="tableWrapper">
                                    <table>
                                        <tr>
                                            <th>Instructor</th>
                                            <th>Subject</th>
                                            <th>1st Sem</th>
                                            <th>2nd Sem</th>
                                            <th>Final</th>
                                          </tr>
                                          <tbody id="gradesTab2"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-content" id="tab3" style="display: none;">
                                <div class="tableWrapper">
                                    <table>
                                        <tr>
                                            <th>Instructor</th>
                                            <th>Subject</th>
                                            <th>1st Sem</th>
                                            <th>2nd Sem</th>
                                            <th>Final</th>
                                          </tr>
                                          <tbody id="gradesTab3"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../assets/student.js"></script>
</body>
</html>