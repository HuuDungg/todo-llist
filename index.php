<?php
require_once 'classes/User.php';
require_once 'classes/Task.php';
require_once 'classes/TodoList.php';

session_start();

$action = $_GET['action'] ?? null;
$todolist = new TodoList();

if ($action === 'login') {
    $user = new User($_POST['username'], $_POST['password']);
    if ($user->login($_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        header('Location: index.php?action=todo');
    } else {
        echo "Login failed.";
    }
} elseif ($action === 'add') {
    $task = new Task($_POST['title'], 'incomplete', $_POST['content'], $_POST['priority']);
    echo $todolist->addTask($_SESSION['username'], $task);
    header('Location: index.php?action=todo');
} elseif ($action === 'todo') {
    $tasks = $todolist->viewTodos($_SESSION['username']);
    include 'templates/todos.php';
} elseif ($action === 'delete') {
    echo $todolist->deleteTask($_SESSION['username'], $_GET['id']);
    header('Location: index.php?action=todo');
} else {
    include 'templates/login.php';
}   
if ($action === 'register') {
    $user = new User($_POST['username'], $_POST['password']);
    $message = $user->register();
    echo "<p>$message</p>";
    if ($message === "User registered successfully.") {
        header('Location: index.php');
    }
    // Hiển thị lại form nếu đăng ký thất bại
    include 'templates/register.php';
} else {
    // Hiển thị form đăng ký nếu truy cập trực tiếp qua đường dẫn
    include 'templates/register.php';
}
?>
