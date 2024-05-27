<?php
session_start();

include '../login/login.php';

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "strv";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userIdQuery = "SELECT id, full_name, IDNo, section FROM users WHERE IDNo = ?";
    $stmtUserId = $conn->prepare($userIdQuery);
    $stmtUserId->bind_param("s", $userId);
    $stmtUserId->execute();
    $userIdResult = $stmtUserId->get_result();

    if ($userIdResult->num_rows > 0) {
        $userData = $userIdResult->fetch_assoc();
        $numericUserId = $userData['id'];

        $gradesSql = "SELECT g.*, u.full_name AS instructor_name 
                      FROM grades g 
                      JOIN users u ON g.instructor_id = u.id 
                      WHERE g.student_id = ? AND g.instructor_id = ?";
        $stmtGrades = $conn->prepare($gradesSql);
        $stmtGrades->bind_param("ss", $numericUserId, $_SESSION['id']); 
        $stmtGrades->execute();
        $gradesResult = $stmtGrades->get_result();

        if ($gradesResult->num_rows > 0) {
            $grades = $gradesResult->fetch_all(MYSQLI_ASSOC);

            $htmlContent = "<!DOCTYPE html>
                            <html lang='en'>
                            <head>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <title>Student</title>
                                <script>
                                    var numericUserId = $numericUserId; // Echo the numeric user ID into JavaScript
                                </script>
                            </head>
                            <body>
                                <div class='mainContainer'>
                                    <header>
                                        <div class='imgContainer'>
                                            <img src='../assets/images/students/ayaka.jpg' alt='student_image' class='mainIMG'>
                                        </div>
                                        <div class='infoContainer'>
                                            <div class='nameContainer'>
                                                <div class='info'>Name:</div>
                                                ".$userData['full_name']."
                                            </div>
                                            <div class='idContainer'>
                                                <div class='info'>ID No.</div>
                                                ".$userData['IDNo']."
                                            </div>
                                            <div class='sectionContainer'>
                                                <div class='info'>Section:</div>
                                                ".$userData['section']."
                                            </div>
                                        </div>
                                    </header>
                                <hr>
                                    <div class='content'>
                                        <div class='gradesContainer'>
                                            <h2>Grades</h2>
                                            <div class='gradesTable'>
                                                <table id='gradesTable'>
                                                    <tr>
                                                        <th>Instructor</th>
                                                        <th>Subject</th>
                                                        <th>1st Sem</th>
                                                        <th>2nd Sem</th>
                                                        <th>Final</th>
                                                    </tr>";
            foreach ($grades as $grade) {
                $htmlContent .= "<tr>
                                    <td>".$grade['instructor_name']."</td>
                                    <td>".$grade['subject']."</td>
                                    <td contenteditable='true'>".$grade['first_semester_grade']."</td>
                                    <td contenteditable='true'>".$grade['second_semester_grade']."</td>
                                    <td contenteditable='true'>".$grade['final_grade']."</td>
                                 </tr>";
            }
            $htmlContent .= "</table>
                            <br>
                            <button id='modifyBtn'>Modify Grades</button>
                            </div>
                            </div>
                            </div>
                            </div>
                            <script>
                            document.getElementById('modifyBtn').addEventListener('click', function() {
                                var table = document.getElementById('gradesTable');
                                var data = [];

                                for (var i = 1; i < table.rows.length; i++) {
                                    var row = table.rows[i];
                                    var rowData = [];
                                    for (var j = 0; j < row.cells.length; j++) {
                                        rowData.push(row.cells[j].innerText);
                                    }
                                    rowData.push(numericUserId); // Use the JavaScript variable
                                    data.push(rowData);
                                }

                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', 'update_grades.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/json');
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === XMLHttpRequest.DONE) {
                                        if (xhr.status === 200) {
                                            console.log(xhr.responseText);
                                        } else {
                                            console.error('Error:', xhr.statusText);
                                        }
                                    }
                                };
                                xhr.send(JSON.stringify(data));
                            });
                            </script>
                            </body>
                            </html>";

            echo $htmlContent;
        } else {
            echo "<p>No grades found for this student and instructor.</p>";
        }
        $stmtGrades->close();
    } else {
        echo "<p>Error: User data not found.</p>";
    }

    $stmtUserId->close(); 
    $conn->close(); 
} else {
    echo "<p>Error: User ID not provided.</p>";
}
?>
