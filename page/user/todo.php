<?php

$tasks = $db->get_tasks($_SESSION['user_id']);
?>

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 main-header">
                <h2>Todo List</h2>
            </div>
            <div class="col-lg-6 breadcrumb-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i class="pe-7s-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Utility</li>
                    <li class="breadcrumb-item">Todo</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>To-Do</h5>
                </div>
                <div class="card-body">
                    <div class="todo">
                        <div class="todo-list-wrapper">
                            <div class="todo-list-container">
                                <div class="mark-all-tasks">
                                    <div class="mark-all-tasks-container"><span class="mark-all-btn" id="mark-all-finished" role="button"><span class="btn-label">Mark all as finished</span><span class="action-box completed"><i class="icon"><i class="icon-check"></i></i></span></span><span class="mark-all-btn move-down" id="mark-all-incomplete" role="button"><span class="btn-label">Mark all as Incomplete</span><span class="action-box"><i class="icon"><i class="icon-check"></i></i></span></span></div>
                                </div>
                                <div class="todo-list-body">
                                    <ul id="todo-list">
                                        <?php
                                        if (!empty($tasks)) {
                                            foreach ($tasks as $task) {
                                        ?>
                                                <li class="task <?php echo $task['completed'] == 1 ? 'completed' : ''; ?>">
                                                    <div class="task-container">
                                                        <h4 task-id="<?php echo $task['task_id']; ?>" class="task-label"><?php echo $task['task']; ?></h4>
                                                        <span class="task-action-btn"><span class="action-box large delete-btn" title="Delete Task"><i class="icon"><i class="icon-trash"></i></i></span><span class="action-box large complete-btn" title="Mark Complete"><i class="icon"><i class="icon-check"></i></i></span></span>
                                                    </div>
                                                </li>
                                            <?php }
                                        } else {
                                            ?>

                                            <li class="task">
                                                <div class="task-container">
                                                    <h4 class="task-label">No Tasks Available</h4>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="todo-list-footer">
                                    <div class="add-task-btn-wrapper"><span class="add-task-btn">
                                            <button class="btn btn-primary"><i class="icon-plus"></i> Add new task</button></span>
                                    </div>
                                    <div class="new-task-wrapper">
                                        <textarea id="new-task" placeholder="Enter new task here. . ."></textarea><span class="btn btn-danger cancel-btn" id="close-task-panel">Close</span><span class="btn btn-success ml-3 add-new-task-btn" id="add-task">Add Task</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="notification-popup hide">
                            <p><span class="task"></span><span class="notification-text"></span></p>
                        </div>
                    </div>
                    <!-- HTML Template for tasks-->
                    <script id="task-template" type="text/template">
                        <li class="task">
                  <div class="task-container">
                  <h4 class="task-label"></h4>
                  <span class="task-action-btn">
                  <span class="action-box large delete-btn" title="Delete Task">
                  <i class="icon"><i class="icon-trash"></i></i>
                  </span>
                  <span class="action-box large complete-btn" title="Mark Complete">
                  <i class="icon"><i class="icon-check"></i></i>
                  </span>
                  </span>
                  </div>
                  </li>
               </script>
                </div>
            </div>
        </div>
    </div>
</div>