<h1>Your Todo List</h1>
<form method="POST" action="index.php?action=add">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content"></textarea>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>
    </select>
    <button type="submit">Add Task</button>
</form>

<h2>Tasks</h2>
<ul>
    <?php foreach ($tasks as $id => $task): ?>
        <li>
            <strong><?= htmlspecialchars($task['title']) ?></strong> 
            (<?= htmlspecialchars($task['priority']) ?>) 
            <em><?= htmlspecialchars($task['status']) ?></em>
            <p><?= htmlspecialchars($task['content']) ?></p>
            <form method="POST" action="index.php?action=delete&id=<?= $id ?>">
                <button type="submit">Delete</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>
