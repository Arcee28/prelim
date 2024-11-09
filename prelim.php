<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Student Enrollment and Grade Processing System</title>
</head>
<body>
    <br>
    <h3 class="text-center">Student Enrollment and Grade Processing System</h3>

<?php
    $studentBtnSubmit = false;
    $gradeBtnSubmit = false;
    $firstName = $lastName = $age = $gender = $course = $email = "";
    $prelim = $midterm = $final = $averageGrade = 0;
    $finalGrade = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitStudentInfo'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $studentBtnSubmit = true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitGrades'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $prelim = $_POST['prelim'];
        $midterm = $_POST['midterm'];
        $final = $_POST['final'];
        $averageGrade = ($prelim + $midterm + $final) / 3;
        $finalGrade = ($averageGrade >= 75) ? "Passed" : "Failed";
        $gradeBtnSubmit = true;
    }
?>

<?php if (!$studentBtnSubmit) { ?>
    <form method="post" class="form-container">
        <h4>Student Enrollment Form</h4>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" required class="form-control">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" required class="form-control">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" required class="form-control">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="gender-container">
                <label for="male" class="mr-2">Male</label>
                <input type="radio" id="male" name="gender" value="Male" required>
                <label for="female" class="mr-2">Female</label>
                <input type="radio" id="female" name="gender" value="Female" required>
                <label for="other" class="mr-2">Other</label>
                <input type="radio" id="other" name="gender" value="Other" required>
            </div>
        </div>
        <div class="form-group">
            <label for="course">Course</label>
            <select id="course" name="course" required class="form-control">
                <option value="" disabled selected>Choose Course</option>
                <option value="BSIT">BSIT</option>
                <option value="BSED">BSED</option>
                <option value="BSA">BSA</option>
                <option value="BSCRIM">BSCRIM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        <button type="submit" name="submitStudentInfo" class="btn btn-primary">Submit Student Information</button>
    </form>
<?php } ?>

<?php if ($studentBtnSubmit && !$gradeBtnSubmit) { ?>
    <form method="post" class="form-container">
        <h4>Enter Grades for <?php echo htmlspecialchars($firstName . " " . $lastName); ?></h4>
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
        <input type="hidden" name="gender" value="<?php echo htmlspecialchars($gender); ?>">
        <input type="hidden" name="course" value="<?php echo htmlspecialchars($course); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="form-group">
            <label for="prelim">Prelim</label>
            <input type="number" id="prelim" name="prelim" required class="form-control" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="midterm">Midterm</label>
            <input type="number" id="midterm" name="midterm" required class="form-control" min="0" max="100">
        </div>
        <div class="form-group">
            <label for="final">Final</label>
            <input type="number" id="final" name="final" required class="form-control" min="0" max="100">
        </div>
        <button type="submit" name="submitGrades" class="btn btn-success">Submit Grades</button>
    </form>
<?php } ?>

<?php if ($gradeBtnSubmit) { ?>
    <div class="student-details">
        <h4>Student Details</h4>
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <h4>Grades</h4>
        <p><strong>Prelim:</strong> <?php echo htmlspecialchars($prelim); ?></p>
        <p><strong>Midterm :</strong> <?php echo htmlspecialchars($midterm); ?></p>
        <p><strong>Final:</strong> <?php echo htmlspecialchars($final); ?></p>
        <p><strong>Average Grade:</strong> 
            <?php echo number_format($averageGrade, 2); ?> - 
            <span class="<?php echo $finalGrade == 'Passed' ? 'text-success' : 'text-danger'; ?>">
                <?php echo $finalGrade; ?>
            </span>
        </p>
    </div>
<?php } ?>

</body>
</html>






