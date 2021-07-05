<?php
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href=".">ToDo App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="aboutus.html">About Us!</a>
            </div>
        </div>
    </nav>
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                    <input type="text" name="title" style="border-color: #ff6666" placeholder="This field is required" />
                    <!--<input type="text" name="description" placeholder="Here you can describe your task" />-->
                    <button type="submit" class="bg-dark">Add &#43;</button>

                <?php } else { ?>
                    <input type="text" name="title" placeholder="What do you want to achieve?" />
                    <!--<input type="text" name="description" placeholder="Here you can describe your task" />-->
                    <button type="submit" class="bg-dark">Add &#43;</button>
                <?php } ?>
            </form>
        </div>
        <?php
        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>
        <div class="show-todo-section">
            <?php if ($todos->rowCount() <= 0) { ?>
                <div class="todo-item">
                    <div class="empty">
                        <h1>No tasks yet.</h1>
                    </div>
                </div>
            <?php } ?>

            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>" class="remove-to-do" ><a href="." style="color: black;">x</a></span>
                    <?php if ($todo['checked']) { ?>
                        <input type="checkbox" class="check-box" data-todo-id="<?php echo $todo['id']; ?>" checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php } else { ?>
                        <input type="checkbox" data-todo-id="<?php echo $todo['id']; ?>" class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <small>created: <?php echo $todo['date_time'] ?></small>
                </div>
            <?php } ?>
        </div>
        <br>
        <footer>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0); margin-top: 15%">
                © 2021 Technische Berufsschule Zürich
            </div>
        </footer>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/list.js"></script>


</body>

</html>