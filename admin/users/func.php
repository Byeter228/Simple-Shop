<?php
include 'config.php';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$city = $_POST['city'];
$address = $_POST['address'];
$perms = $_POST['perms'];

// Create
if (isset($_POST['submit'])) {
    $password = md5(md5($password));
	$sql = ("INSERT INTO `users`(`name`, `email`, `password`, `contact`, `city`, `address`, `perms`) VALUES (?,?,?,?,?,?,?)");
	$query = $pdo->prepare($sql);
	$query->execute([$name, $email, $password, $contact, $city, $address, $perms]);
	$success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Данные успешно отправлены!</strong> Вы можете закрыть это сообщение.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	
}

// Read
$sql = $pdo->prepare("SELECT * FROM `users`");
$sql->execute();
$result = $sql->fetchAll();

function isValidMd5($md5 ='') {
  return strlen($md5) == 32 && ctype_xdigit($md5);
}

// Update
$edit_name = $_POST['edit_name'];
$edit_email = $_POST['edit_email'];
$edit_password = $_POST['edit_password'];
$edit_contact = $_POST['edit_contact'];
$edit_city = $_POST['edit_city'];
$edit_address = $_POST['edit_address'];
$edit_perms = $_POST['edit_perms'];
$get_id = $_GET['id'];
if (isset($_POST['edit-submit'])) {
    if(isValidMd5($edit_password))
    {
        $sqll = "UPDATE users SET name=?,email=?, contact=?, city=?, address=?, perms=? WHERE id=?";
	    $querys = $pdo->prepare($sqll);
	    $querys->execute([$edit_name, $edit_email, $edit_contact, $edit_city, $edit_address, $edit_perms, $get_id]);
	    header('Location: '. $_SERVER['HTTP_REFERER']);
    }
    else {
        $edit_password = md5(md5($edit_password));
	    $sqll = "UPDATE users SET name=?,email=?, password=?, contact=?, city=?, address=?, perms=? WHERE id=?";
	    $querys = $pdo->prepare($sqll);
	    $querys->execute([$edit_name, $edit_email, $edit_password, $edit_contact, $edit_city, $edit_address, $edit_perms, $get_id]);
	    header('Location: '. $_SERVER['HTTP_REFERER']);
    }
}

// DELETE
if (isset($_POST['delete_submit'])) {
	$sql = "DELETE FROM users WHERE id=?";
	$query = $pdo->prepare($sql);
	$query->execute([$get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}
