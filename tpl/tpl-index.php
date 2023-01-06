<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= SITE_TITLE ?></title>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
          integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
    <div class="pageHeader">
        <div class="title">Dashboard</div>
        <div class="userPanel">
            <a href="/?action=logout" style="color: darkred">
                <i class="fa fa-sign-out"></i>
            </a>
            <span
                    class="username"><?= $userInfo->username ?></span><img
                    src="<?= $userInfo->profile ?>" width="40" height="40"/></div>
    </div>
    <div class="main">
        <div class="costume_nav">
            <div class="searchbox">
                <div><i class="fa fa-search"></i>
                    <input type="search" placeholder="Search"/>
                </div>
            </div>
            <div class="menu">
                <div class="title">Folder's</div>
                <ul class="folders">
                    <li class="<?= (!$fid) ? 'active' : ''; ?>">
                        <!-- fid = Folder ID -->
                        <a href="/" class="text-decoration-none" style="color: inherit">
                            <i class="<?= (!$fid) ? 'far fa-folder-open' : 'far fa-folder'; ?>"></i>All
                        </a>
                    </li>
                    <?php
                    if (!is_string($folders)) {
                        foreach ($folders as $folder) : ?>
                            <li class="<?= ($folder->id == $fid) ? 'active' : ''; ?>">
                                <!-- fid = Folder ID -->
                                <a href="?fid=<?= $folder->id ?>" class="text-decoration-none" style="color: inherit">
                                    <i class="<?= ($folder->id == $fid) ? 'far fa-folder-open' : 'far fa-folder'; ?>"></i><?= $folder->name ?>
                                </a>
                                <!-- dfid = Delete Folder ID -->
                                <a href="?dfid=<?= $folder->id ?>" class="text-decoration-none" style="color: inherit">
                                    <i class="fas fa-trash-alt d-icon"
                                       style="font-size: 1rem; float: right;padding-top: 0.5rem;color: #ce2424;opacity: 50%;"></i>
                                </a>
                            </li>
                        <?php endforeach;
                    } else {
                        echo $folders;
                    }
                    ?>
                </ul>
                <div>
                    <input type="text" placeholder="Add New Folder" class="form-control" id="addFolderInput"
                           style="width: 70%;display: inline;">
                    <button id="addFolderBtn" type="submit" class="btn btn-outline-success">+</button>
                </div>
            </div>
        </div>
        <div class="view">
            <div class="viewHeader">
                <div class="title">
                    <input type="text" name="taskInput" id="taskInput" class="form-control mx-5"
                           placeholder="Add New Task ..." autofocus
                           style="width: 200%;height: 36px;float: left;margin-top: 1rem;">
                </div>
                <div class="functions mx-5">
                    <div class="" style="height: 36px;line-height: 36px;">
                        <button class="button active border-0 h-100 w-100" type="submit">Add New Task</button>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="list">
                    <div class="title">Today</div>
                    <ul>
                        <?php
                        if (sizeof($tasks)) :
                            foreach ($tasks as $task) :
                                ?>
                                <li class="<?= $task->is_done ? "checked" : ""; ?>">
                                    <i id="isDone" data-taskId="<?= $task->id ?>"
                                       class="<?= $task->is_done ? "far fa-check-square" : "far fa-square"; ?>"></i>
                                    <span><?= $task->title ?></span>
                                    <div class="info">
                                        <div class="button <?= $task->is_done ? "green" : ""; ?>"><?= $task->is_done ? "Done" : "In Progress"; ?></div>
                                        <span><?= $task->created_at ?></span>
                                        <a href="?dtid=<?= $task->id ?>" class="text-decoration-none"
                                           style="color: #ce2424; font-size: 1rem"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </li>
                            <?php
                            endforeach;
                        else: ?>
                            <p class='text-danger m-1'>you haven't any Tasks !</p>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"
        integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/script.js"></script>
<script>
    $(document).ready(function () {
        $('#addFolderBtn').click(function (e) {
            const input = $('input#addFolderInput');
            $.ajax({
                url: 'process/ajaxHandler.php',
                method: 'post',
                data: {action: 'addFolder', folderName: input.val()},
                success: function (response) {
                    if (response == '1') {
                        $('<li><a href="?fid=" class="text-decoration-none" style="color: inherit"><i class="far fa-folder-open"></i>' + input.val() + '</a><a href="?dfid=" class="text-decoration-none" style="color: inherit"><i class="fas fa-trash-alt d-icon" style="font-size: 1rem; float: right;padding-top: 0.5rem;color: #ce2424;opacity: 50%;"></i></a></li>').appendTo('ul.folders');
                    } else {
                        alert(response);
                        location.reload();
                    }
                }
            });
        });

        $('#taskInput').on('keypress', function (e) {
            if (e.which == 13) {
                const input = $('input#taskInput');
                $.ajax({
                    url: 'process/ajaxHandler.php',
                    method: 'post',
                    data: {action: 'addTask', fid: <?= $_GET['fid'] ?? 0 ?>, taskTitle: input.val()},
                    success: function (response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        });

        $('i#isDone').click(function (e) {
            const tId = $(this).attr('data-taskId');
            $.ajax({
                url: 'process/ajaxHandler.php',
                method: 'post',
                data: {action: 'doneSwitch', taskId: tId},
                success: function (response) {
                    location.reload();
                }
            });
        });
    })
</script>
</body>
</html>
