<?php
include 'config.php';
$name = $_POST['name'];
$price = $_POST['price'];
$url = $_POST['url'];
$category = $_POST['category'];
$description = $_POST['description'];

// Create
if (isset($_POST['submit'])) {
	$sql = ("INSERT INTO `items`(`name`, `price`, `url`, `category`, `description`) VALUES (?,?,?,?,?)");
	$query = $pdo->prepare($sql);
	$query->execute([$name, $price, $url, $category, $description]);
	$success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Данные успешно отправлены!</strong> Вы можете закрыть это сообщение.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	
}

// Read
$sql = $pdo->prepare("SELECT * FROM `items`");
$sql->execute();
$result = $sql->fetchAll();

// Update
$edit_name = $_POST['edit_name'];
$edit_price = $_POST['edit_price'];
$edit_url = $_POST['edit_url'];
$edit_category = $_POST['edit_category'];
$edit_description = $_POST['edit_description'];

$get_id = $_GET['id'];
if (isset($_POST['edit-submit'])) {
    $sqll = "UPDATE items SET name=?,price=?, url=?, category=?, description=? WHERE id=?";
	$querys = $pdo->prepare($sqll);
	$querys->execute([$edit_name, $edit_price, $edit_url, $edit_category, $edit_description, $get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);  
}

// DELETE
if (isset($_POST['delete_submit'])) {
	$sql = "DELETE FROM items WHERE id=?";
	$query = $pdo->prepare($sql);
	$query->execute([$get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}
