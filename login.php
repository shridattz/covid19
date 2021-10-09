<!DOCTYPE html>
<html>
    <head>
        <title>Log In | Covid-19</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF"
            crossorigin="anonymous">
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
            crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="index.css">
        <style>
 .container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.title{
    font-style: normal;
    font-weight: bold;
    font-size: 06vw;
    font-variant-caps: all-small-caps;
    font-family: 'Poppins';
}
        </style>
    </head>
    <body>
        
        <div class="container align-items-center row">
            <div class="float-start">
                <a href="index.html"><p><i class="bi bi-chevron-compact-left"></i>Back</p></a>
            </div>
            <div class="row">
                <h1 class="title">Log In</h1>
            </div>

            <div class="row">
                <br>
                <br>
            </div>

            <div class="row">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control"
                            id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>

                    <div class="row">
                        <br>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control"
                            id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="row">
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>

                    <div class="row col-1 float-end"><a href="dashboard.html"><button onclick="logInFunction()" type="submit"
                            class="btn btn-primary">Log In</button></a></div>
                </form>
            </div>
        </div>

        <script>
            function logInFunction() {

            }
        </script>
    </body>
</html>