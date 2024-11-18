<?php
class TodoList {
    private $todoFile = __DIR__ . '/../data/todos.json';

    public function viewTodos($username) {
        $todos = json_decode(file_get_contents($this->todoFile), true) ?? [];
        foreach ($todos as $userTodos) {
            if ($userTodos['username'] === $username) {
                return $userTodos['todos'];
            }
        }
        return [];
    }

    public function addTask($username, Task $task) {
        $todos = json_decode(file_get_contents($this->todoFile), true) ?? [];
        foreach ($todos as &$userTodos) {
            if ($userTodos['username'] === $username) {
                $userTodos['todos'][] = $task;
                file_put_contents($this->todoFile, json_encode($todos));
                return "Task added successfully.";
            }
        }
        $todos[] = ['username' => $username, 'todos' => [$task]];
        file_put_contents($this->todoFile, json_encode($todos));
        return "Task added successfully.";
    }

    public function editTask($username, $id, Task $task) {
        $todos = json_decode(file_get_contents($this->todoFile), true) ?? [];
        foreach ($todos as &$userTodos) {
            if ($userTodos['username'] === $username) {
                if (isset($userTodos['todos'][$id])) {
                    $userTodos['todos'][$id] = $task;
                    file_put_contents($this->todoFile, json_encode($todos));
                    return "Task updated successfully.";
                }
            }
        }
        return "Task not found.";
    }

    public function deleteTask($username, $id) {
        $todos = json_decode(file_get_contents($this->todoFile), true) ?? [];
        foreach ($todos as &$userTodos) {
            if ($userTodos['username'] === $username) {
                if (isset($userTodos['todos'][$id])) {
                    array_splice($userTodos['todos'], $id, 1);
                    file_put_contents($this->todoFile, json_encode($todos));
                    return "Task deleted successfully.";
                }
            }
        }
        return "Task not found.";
    }
}
?>
