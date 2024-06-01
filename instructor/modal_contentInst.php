<?php
session_start();

include '../login/login.php';

$imgPath = "../assets/images/default.jpg";

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

    $userIdQuery = "SELECT id, full_name, IDNo, section, imgPath FROM users WHERE IDNo = ?";
    $stmtUserId = $conn->prepare($userIdQuery);
    $stmtUserId->bind_param("s", $userId);
    $stmtUserId->execute();
    $userIdResult = $stmtUserId->get_result();

    if ($userIdResult->num_rows > 0) {
        $userData = $userIdResult->fetch_assoc();
        $numericUserId = $userData['id'];

        if (!empty($userData['imgPath'])) {
            $imgPath = "../assets/images/upload/" . htmlspecialchars($userData['imgPath']);
        }

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
        }

        $stmtGrades->close();
    }

    $stmtUserId->close(); 
    $conn->close(); 
} else {
    echo "<p>Error: User ID not provided.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <script>
        var numericUserId = <?php echo isset($numericUserId) ? $numericUserId : 'null'; ?>; 
    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        
        #modifyBtn {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        #modifyBtn:hover {
            background-color: #d32f2f;
        }

        #addGradesForm {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        #addGradesForm h2, h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        #addGradesForm label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        #addGradesForm input[type="text"],
        #addGradesForm input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        #addGradesForm input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #addGradesForm input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="mainContainer">
        <header>
            <div class="imgContainer">
                <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="student_image" class="mainIMG">
            </div>
            <div class="infoContainer">
                <div class="nameContainer">
                    <div class="info">Name:</div>
                    <?php echo isset($userData['full_name']) ? htmlspecialchars($userData['full_name']) : 'Student Not Found'; ?>
                </div>
                <div class="idContainer">
                    <div class="info">ID No.</div>
                    <?php echo isset($userData['IDNo']) ? htmlspecialchars($userData['IDNo']) : ''; ?>
                </div>
                <div class="sectionContainer">
                    <div class="info">Section:</div>
                    <?php echo isset($userData['section']) ? htmlspecialchars($userData['section']) : ''; ?>
                </div>
            </div>
        </header>
        <hr>
        <div class="content">
            <div class="gradesContainer">
                <h1>Grades</h1>
                <?php if (isset($grades) && !empty($grades)) : ?>
                    <div class="gradesTable">
                        <table id="gradesTable">
                            <tr>
                                <th>Instructor</th>
                                <th>Subject</th>
                                <th>1st Sem</th>
                                <th>2nd Sem</th>
                                <th>Final</th>
                            </tr>
                            <?php foreach ($grades as $grade) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($grade['instructor_name']); ?></td>
                                    <td><?php echo htmlspecialchars($grade['subject']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($grade['first_semester_grade']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($grade['second_semester_grade']); ?></td>
                                    <td contenteditable="true"><?php echo htmlspecialchars($grade['final_grade']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <br>
                        <button id="modifyBtn">Modify Grades</button>
                    </div>
                <?php else : ?>
                    <p>No grades found for this student and instructor.</p>
                <?php endif; ?>
                <hr>
                <form id="addGradesForm" action="add_grades.php" method="post">
                    <h2>Add Grades</h2>
                    <input type="hidden" name="userData" value="<?php echo htmlspecialchars(json_encode($userData)); ?>">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                    <label for="firstSemesterGrade">1st Semester Grade:</label>
                    <input type="number" id="firstSemesterGrade" name="firstSemesterGrade" required>
                    <label for="secondSemesterGrade">2nd Semester Grade:</label>
                    <input type="number" id="secondSemesterGrade" name="secondSemesterGrade" required>
                    <label for="finalGrade">Final Grade:</label>
                    <input type="number" id="finalGrade" name="finalGrade" required>
                    <input type="submit" value="Add Grade">
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/instructor.js"></script>
</body>
</html>
