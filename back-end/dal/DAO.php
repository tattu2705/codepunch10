
<?php
include("../model/Student.php");
include("../model/Teacher.php");
function getAll()
{
    include("connectDB.php");
    $sql = "SELECT * FROM student_info";
    $result = $conn->query($sql);
    $students = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $student = new Student($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], "student");
            array_push($students, $student);
        }
    }

    $conn->close();
    return $students;
}
function getStudentByLogin($username_, $password_)
{
    include("connectDB.php");
    $sql = "SELECT * FROM student_info WHERE username = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_, $password_);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $student = new Student($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], "student");
    } else {
        $student = null;
    }
    $stmt->close();
    $conn->close();
    return $student;
}

function getTeacherByLogin($username_, $password_)
{
    include("connectDB.php");
    $sql = "SELECT * FROM teacher_info WHERE username = ? AND password = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_, $password_);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teacher = new Teacher($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], "teacher");
    } else {
        $teacher = null;
    }
    $stmt->close();
    $conn->close();
    return $teacher;
}

function getById($id, $type)
{
    include("connectDB.php");
    if($type === "student")
        $sql = "SELECT * FROM student_info WHERE id = ?";
    else
        $sql = "SELECT * FROM teacher_info WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($type === "student")
            $person = new Student($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], $type);
        else{
            $person = new Teacher($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], $type);
        }
    } else {
        $person = null;
    }
    $stmt->close();
    $conn->close();
    return $person;
}

function updateInfo($newEmail, $newPhone, $id, $type, $header)
{
    include('connectDB.php');

    // Validate email format
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: $header?error=invalidemail");
        $conn->close();
        exit();
    }

    // Validate phone number format
    if (!preg_match("/^[0-9]{10}$/", $newPhone)) {
        header("Location: $header?error=invalidphone");
        $conn->close();
        exit();
    }

    if ($type == 'student') {
        $sql = "UPDATE student_info SET email = ?, phoneNumber = ? WHERE id = ?";
    } else {
        $sql = "UPDATE teacher_info SET email = ?, phoneNumber = ? WHERE id = ?";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $newEmail, $newPhone, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $_SESSION["account"] = getById($id, $_SESSION["account"]->type);
    header("Location: {$header}?success=1");
    exit();
}
function updatePassword($old_password, $new_password, $confirm_password)
{
    include('connectDB.php');
    $id = $_SESSION["account"];
    $stmt = $conn->prepare("SELECT * FROM student_info WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    // fetch the results     
    $result = $stmt->get_result();
    // retrieve the user's old password from the result set
    $row = $result->fetch_assoc();
    $cur_password = $row["password"];

    // verify the old password
    if ($cur_password !== $old_password) {
        header("Location: changepass.php?error=2");
    }

    // validate the new password and confirm password fields
    if (strlen($new_password) < 8 || strlen($confirm_password) < 8) {
        header("Location: changepass.php?error=3");
        exit();
    } elseif ($new_password !== $confirm_password) {
        header("Location: changepass.php?error=4");
        exit();
    }

    // hash the new password

    // update the user's password in the database
    $stmt = $conn->prepare("UPDATE student_info SET password=? WHERE id=?");
    $stmt->bind_param("si", $new_password, $id);

    // execute the query
    $stmt->execute();

    // close the database connection
    $conn->close();

    // success!
    header("Location: changepass.php?success=1");
    exit();
}
function search($searchWord, $type)
{
    include('connectDB.php');
    if ($type === "student") {
        $sql = "SELECT * FROM student_info WHERE id = ? ";
    } else {
        $sql = "SELECT * FROM teacher_info WHERE id = ? ";
    }
    $ppsm = $conn->prepare($sql);
    $searchParam = $searchWord;
    $ppsm->bind_param("i", $searchParam);
    $ppsm->execute();
    $result = $ppsm->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($type === "student") {
            $student = new Student($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], "student");
            return $student;
        } else {
            $teacher = new Teacher($row["id"], $row["username"], $row["password"], $row["name"], $row["email"], $row["phoneNumber"], $row["imgProfile"], "teacher");
            return $teacher;
        }
    }

    $conn->close();
    return null;
}

function uploadImg($file, $id, $type)
{
    include("connectDB.php");

    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        if ($img_size > 1500000) {
            $em = "the file size must below 1.5mb";
            header("Location: Profile.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = "../image/" . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                if ($type === "student")
                    $sql = "UPDATE student_info SET imgProfile = ? WHERE id = ?";
                else
                    $sql = "UPDATE teacher_info SET imgProfile = ? WHERE id = ?";

                $ppsm = $conn->prepare($sql);
                $ppsm->bind_param("si", $new_img_name, $id);
                $ppsm->execute();
                $ppsm->close();
                $conn->close();
                $_SESSION["account"] = getById($id, $_SESSION["account"]->type);
                return;
            } else {
                $em = "can not upload this type of file";
                header("Location:Profile.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "unknown error occurred!";
        header("Location: Profile.php?error=$em");
        exit();
    }
}
?>