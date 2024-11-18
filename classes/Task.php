<?php
class Task {
    public $title;
    public $status;
    public $content;
    public $priority;
    public $completed;

    public function __construct($title, $status, $content, $priority = 'low', $completed = false) {
        $this->title = $title;
        $this->status = $status;
        $this->content = $content;
        $this->priority = $priority;
        $this->completed = $completed;
    }
}
?>
