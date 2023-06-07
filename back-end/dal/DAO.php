
<?php
include("back-end/model/Student.php");
include("back-end/model/Teacher.php");
include("back-end/model/Homework.php");
include("back-end/model/Challenge.php");

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

function updateAll($newEmail, $newPhone, $id, $type, $header, $name, $username_){
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

    if(!preg_match("/^[a-zA-ZÀ-ỹ\s]{4,50}$/u", $name)){
        header("Location: $header?error=invalidname");
        $conn->close();
        exit();
    }

    if(!preg_match("/^[a-zA-Z0-9_\-]{4,20}$/", $username_)){
        header("Location: $header?error=invalidusername");
        $conn->close();
        exit();
    }

    if ($type == 'student') {
        $sql = "UPDATE student_info SET email = ?, phoneNumber = ?, username = ?, name = ? WHERE id = ?";
    } else {
        $sql = "UPDATE teacher_info SET email = ?, phoneNumber = ?, username = ?, name = ? WHERE id = ?";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $newEmail, $newPhone, $username_, $name, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: {$header}?success=1");
    exit();
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
    if($_SESSION["account"]->type === "student")
        $stmt = $conn->prepare("SELECT * FROM student_info WHERE id=?");
    else
        $stmt = $conn->prepare("SELECT * FROM teacher_info WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    // fetch the results     
    $result = $stmt->get_result();
    // retrieve the user's old password from the result set
    $row = $result->fetch_assoc();
    $cur_password = $row["password"];

    // verify the old password
    if ($cur_password !== md5($old_password)) {
        header("Location: changepass.php?error=2");
        exit();
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
    $stmt->bind_param("si", md5($new_password), $id);

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

function uploadHomework($file, $title, $description)
{
    include("connectDB.php");

    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        if ($img_size > 1500000) {
            $em = "the file size must below 1.5mb";
            header("Location: homework.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "rtf", "pdf", "docx", "txt");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("file-", true) . "." . $img_ex_lc;
                $img_upload_path = "../upload/" . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $sql = "INSERT INTO question(title, description, fileUpload) value (?, ?, ?)";
                $ppsm = $conn->prepare($sql);
                $ppsm->bind_param("sss",$title, $description, $new_img_name);
                $ppsm->execute();
                $ppsm->close();
                $conn->close();
                header("Location:homework.php?success");
                exit();
            } else {
                $em = "can not upload this type of file";
                header("Location:homework.php?error=$em");
                exit();
            }
        }
        echo $error;
    } else {
        $em = "unknown error occurred!";
        header("Location: homework.php?error=$em");
        exit();
    }
}

function uploadChallenge($title, $hint, $file, $answer, $mess){
    include("connectDB.php");

    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        if ($img_size > 1500000) {
            $em = "the file size must below 1.5mb";
            header("Location: challenge.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("txt", "docs");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("file-", true) . "." . $img_ex_lc;
                $img_upload_path = "../challenge/" . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $sql = "INSERT INTO challenge(title, hint, challenge_file, answer, message) value (?, ?, ?, ?, ?)";
                $ppsm = $conn->prepare($sql);
                $ppsm->bind_param("sssss",$title, $hint, $new_img_name, $answer, $mess);
                $ppsm->execute();
                $ppsm->close();
                $conn->close();
                header("Location: challenge.php?success");
                exit();
            } else {
                $em = "can not upload this type of file";
                header("Location: challenge.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "unknown error occurred!";
        header("Location: challenge.php?error=$em");
        exit();
    }
}

function addStudent($username_, $password_, $name, $email, $phoneNumber){
    include("connectDB.php");
    $sql = "INSERT INTO student_info (username, password, name, email, phoneNumber, imgProfile)
    VALUES (?, ?, ?, ?, ?, ?);";
    $ppsm = $conn->prepare($sql);
    $imgProfile = "default.png";
    $ppsm->bind_param("ssssss", $username_, $password_, $name, $email, $phoneNumber, $imgProfile);
    $ppsm->execute();
    $conn->close();
}

function deleteStudentByID($id){
    include("connectDB.php");
    $sql = "DELETE FROM student_info WHERE id = ?";
    $ppsm = $conn->prepare($sql);
    $ppsm->bind_param("i", $id);
    $ppsm->execute();
    $conn->close();
    header("Location: list.php?success");
    exit();
}

function getAllQuestion(){
    include("connectDB.php");
    $sql = "SELECT * FROM question";
    $result = $conn->query($sql);
    $homeworks = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $homework = new Homework($row["id"], $row["title"], $row["description"], $row["fileUpload"]);
            array_push($homeworks, $homework);
        }
    }

    $conn->close();
    return $homeworks;
}
function getAllChallenge(){
    include("connectDB.php");
    $sql = "SELECT * FROM challenge";
    $result = $conn->query($sql);
    $challenges = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $challenge = new Challenge($row["id"], $row["title"], $row["hint"], $row["challenge_file"], $row["answer"], $row["message"]);
            array_push($challenges, $challenge);
        }
    }
    $conn->close();
    return $challenges;
}

function upStudentPass($student_id, $challenge_id){
    include("connectDB.php");
    if($_SESSION["account"]->type === "student"){
        $objects = getAllStudentPass();
        foreach($objects as $object){
            if($object[0] == $student_id && $object[3] == $challenge_id){
                header("Location: challenge.php?you have do this challenge");
                exit();
            }
        }
        $sql = "INSERT INTO pass_challenge(student_id, challenge_id) VALUES(?, ?)";
        $ppsm = $conn->prepare($sql);
        $ppsm->bind_param("ii", $student_id, $challenge_id);
        $ppsm->execute();
        $conn->close();
        header("Location: challenge.php?success=well done");
    }
    else{
        header("Location: challenge.php?teacher");
        exit();
    }
}

function getAllStudentPass(){
    include("connectDB.php");
    $sql = "SELECT student_info.*, challenge.title, challenge.id AS challenge_id FROM pass_challenge
    LEFT JOIN challenge on pass_challenge.challenge_id = challenge.id
    LEFT JOIN student_info on student_info.id = pass_challenge.student_id;";
    $result = $conn->query($sql);
    $objects = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $list = [$row["id"], $row["name"], $row["title"], $row["challenge_id"]];    
            array_push($objects, $list);
        }
    }
    $conn->close();
    return $objects;
}

function checkUsernameDuplicate($username_){
    include("connectDB.php");
    $sql = "SELECT * FROM student_info";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($row["username"] == $username_)
                return true;
        }
    }
    return false;
}

?>