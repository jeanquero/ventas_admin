<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['email'] == "avem@gmail.com" && $_POST['password'] == "avem2021@*"){
        echo "<script language='javascript'> 
                   window.location.replace('http://ventas_admin.test/');
                   localStorage.setItem('login', 'true');
              </script>";
    }else{
        echo "<script language='javascript'> 
                alert('Error clave o usuario incorrectos');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login AVEM</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/login.css">
</head>
<body>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="../../assets/images/login.jpg" alt="login" class="login-card-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="https://firebasestorage.googleapis.com/v0/b/hosting-2cadf.appspot.com/o/avem.png?alt=media&token=3494d193-0ea4-45d7-a263-8560b16efe9a" alt="logo" class="logo">
                        </div>
                        <p class="login-card-description">Sign into your account</p>
                        <form name="form-login" id="form-login" method="post">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('login').addEventListener('click',()=>{
        if(document.getElementById('email').value != '' && document.getElementById('password').value != ''){
            document.forms["form-login"].submit();
        }else{
            Swal.fire({
                title: 'Error!',
                text: 'Email y Password requeridos',
                icon: 'error',
                confirmButtonText: 'Cool'
            })
        }
    });

    const error= ()=>{
        Swal.fire({
            title: 'Error!',
            text: 'Email y Password requeridos',
            icon: 'error',
            confirmButtonText: 'Cool'
        })
    }
</script>
</body>
</html>
