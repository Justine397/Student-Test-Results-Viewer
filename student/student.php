<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="student.css">
    
</head>
<body>
    <div class="container1">
        <div class="container2">
            <div class="container3">
                <div class="mainContainer">
                    <header>
                        <div class="imgContainer">
                            <img src="../images/students/ayaka.jpg" alt="student_image" class="mainIMG">
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
                    <div class="content">
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
                                          <tr>
                                            <td>Jose Flores</td>
                                            <td>Math</td>
                                            <td>90</td>
                                            <td>89</td>
                                            <td>89.5</td>
                                          </tr>
                                          <tr>
                                            <td>Pepito Echavez</td>
                                            <td>Science</td>
                                            <td>82</td>
                                            <td>89</td>
                                            <td>85.5</td>
                                          </tr>
                                          <tr>
                                            <td>Junee Mar Aguilar</td>
                                            <td>Pe</td>
                                            <td>79</td>
                                            <td>91</td>
                                            <td>85</td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>88</td>
                                          </tr>
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
                                          <tr>
                                            <td>Pepito Echavez</td>
                                            <td>Math</td>
                                            <td>90</td>
                                            <td>89</td>
                                            <td>89.5</td>
                                          </tr>
                                          <tr>
                                            <td>Jose Flores</td>
                                            <td>Science</td>
                                            <td>82</td>
                                            <td>89</td>
                                            <td>85.5</td>
                                          </tr>
                                          <tr>
                                            <td>Junee Mar Aguilar</td>
                                            <td>Pe</td>
                                            <td>79</td>
                                            <td>91</td>
                                            <td>85</td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>88</td>
                                          </tr>
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
                                          <tr>
                                            <td>Jose Flores</td>
                                            <td>Math</td>
                                            <td>90</td>
                                            <td>89</td>
                                            <td>89.5</td>
                                          </tr>
                                          <tr>
                                            
                                            <td>Junee Mar Aguilar</td>
                                            <td>Science</td>
                                            <td>82</td>
                                            <td>89</td>
                                            <td>85.5</td>
                                          </tr>
                                          <tr>
                                            <td>Pepito Echavez</td>
                                            <td>Pe</td>
                                            <td>79</td>
                                            <td>91</td>
                                            <td>85</td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>88</td>
                                          </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="student.js"></script>
</body>
</html>