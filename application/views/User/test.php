<!DOCTYPE html>
<html>

<head>
    <title>Quiz Game Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: cadetblue;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 100px auto;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    h1 {
        text-align: center;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 3px;
        border: 1px solid #cccccc;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: blue;
        color: #ffffff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to the Quiz Game!</h1>
        <form action="<?php echo base_url().'Quiz_controller/signin'?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="submit" value="Lets Play">

        </form>
    </div>
</body>

</html>