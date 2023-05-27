<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.js"
        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <button type="button" id="exit_quiz" class="btn btn-danger" data-dismiss="modal"
                    onclick="window.location.href='<?php echo base_url('admin1/logout'); ?>'">Log Out</button>

                <div class="card">
                    <div class="card-header">
                        <legend class="text-center"><b>Admin Dashboard</b></legend>
                    </div>

                    <div class="card-body table-responsive-sm table-responsive-md table-responsive-lg">
                        <!-- Your content here -->
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Total Questions</th>
                                    <th scope="col">Correct Questions</th>
                                    <th scope="col">Attempted Questions</th>

                                    <th scope="col">Total time</th>

                                </tr>
                            </thead>
                            <!-- <p><?php var_dump($rows)?></p> -->
                            <tbody id="tbody">

                                <?php if(!empty($rows)) {foreach($rows as $row){?>
                                <tr id="row-<?php echo $row['test_id'] ?>">
                                    <th scope="row"><?php echo $row['test_id'] ?></th>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['total_questions'] ?></td>
                                    <td><?php echo $row['correct_questions'] ?></td>
                                    <td> <?php echo $row['attempted_questions'] ?></td>

                                    <td><?php echo $row['total_time_taken'] ?><span> secs</span></td>

                                </tr>
                                <?php }} else{ ?>
                                <tr class="text-info">
                                    <th>Records Not Found!!</th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>





</html>

<!-- Bootstrap JS -->


</html>