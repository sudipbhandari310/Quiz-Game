<!DOCTYPE html>

<html>

<head>

    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>">
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
</head>

<body class>
    <section>

        <div class="container mt-5 pt-7">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 n-auto">
                    <div class="card move-center">
                        <div class="card-body">

                            <svg class="mx-auto text-center" xmlns="http://www.w3.org/2000/svg" width="400" height="60"
                                fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                            </svg>
                            <form action="<?php echo base_url().'Quiz_controller/signin'?>" method="post">
                                <h1 class="h3 mb-3 fw-normal text-center">Sign in to start quiz </h1>


                                <div class="form-group">
                                    <input type="text" name="username" id="username" placeholder="Username"
                                        class="form-control my-3 py-2">
                                </div>


                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Email"
                                        class="form-control my-3 py-2">
                                </div>

                                <div class="text-center mt-3">

                                    <button class="btn btn-primary">Lets Play </button>




                                    <script
                                        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                                        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                                        crossorigin="anonymous"></script>


                                    <script src="https://code.jquery.com/jquery-3.6.4.js"
                                        integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
                                        crossorigin="anonymous">
                                    </script>



                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

</html>