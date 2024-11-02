<?php
include './includes/cn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Bogota');
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $query = "SELECT us.nombre, us.usuario, us.telefono, us.cargo, rl.permisos FROM usuarios as us
        INNER JOIN roles as rl on rl.nombre = us.cargo
        WHERE usuario = '$usuario' and contraseña = '$contraseña' and estado = 'activo'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // La clave no existe, puedes manejar esta situación aquí
        $message = "La clave no existe o los datos son incorrectos.";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $_SESSION['key'] = $row;
            $_SESSION['ipaddress'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
            $user = $row['usuario'];
            $ipaddress = $_SERVER['REMOTE_ADDR'];
            $http =  $_SERVER['HTTP_USER_AGENT'];
            $time = date('Y-m-d H:i:s');
            $query2 = "INSERT INTO logs (usuario,ext,htp,actions,time) VALUES ('$user','$ipaddress','$http','Login in Dashboard', '$time')";
            $result2 = mysqli_query($conn, $query2);
            mysqli_close($conn);
            if (isset($_GET['t']) and $_GET['t'] == 'pagos') {
                header("Location: pagos");
            } elseif (isset($_GET['t']) and $_GET['t'] == 'leads') {
                header("Location: leads");
            } else {
                header("Location: index");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../logo.jpeg" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="flex flex-row" style="height: 100%; overflow:hidden">
        <div class="basis-12/12 md:basis-7/12 bg-gray-50 relative hidden md:block">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <img src="../img/wp.jpg" class="w-full h-full object-cover" alt="">
        </div>
        <div class="basis-12/12 md:basis-5/12 shadow-lg flex flex-col justify-center px-20" b
            style="background-color: #FDFEFE">

            <form method="POST" class="md:px-10 py-2 " id="form_login">

                <div class=" py-3">
                    <label for="usuario" class="block mb-4 text-md font-medium text-slate-700">Usuario</label>
                    <input type="text" autocomplete="off" id="usuario" name="usuario"
                        class="bg-gray-50 border border-gray-300 text-black text-md rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                        placeholder=""" required>
        </div>
        <div class=" py-3">
                    <label for="contraseña" class="block mb-4 text-md font-medium text-slate-700">Contraseña</label>
                    <input type="password" autocomplete="off" id="contraseña" name="contraseña"
                        class="bg-gray-50 border border-gray-300 text-black text-md rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                        placeholder="*****" required>
                </div>
                <p style="padding: 4px; text-align: justify; font-size: 15px;"><?php if (isset($message)) {
                    echo $message;
                } ?></p>

                <button type="submit" value="Login" name="login"
                    class="text-white bg-gray-700 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 mt-4 text-center">Login</button>
            </form>


        </div>

    </div>


</body>

</html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    width: 100%;
    height: 100vh;
    align-items: center;
    justify-content: center;
}

::selection {
    color: #fff;
    background: #5372F0;
}


form .field {
    width: 60%;
    margin-bottom: 25px;
}

form .field.shake {
    animation: shake 0.3s ease-in-out;
}

@keyframes shake {

    0%,
    100% {
        margin-left: 0px;
    }

    20%,
    80% {
        margin-left: -12px;
    }

    40%,
    60% {
        margin-left: 12px;
    }
}

form .field .input-area {
    height: 50px;
    width: 100%;
    position: relative;
}

form input {
    width: 100%;
    height: 100%;
    outline: none;
    padding: 0 45px;
    font-size: 18px;
    background: none;
    border-radius: 5px;
    background-color: #F3F3F3;
    transition: all 0.2s ease;
}

form .field input:focus,
form .field.valid input {
    border-color: #5372F0;
}

form .field.shake input,
form .field.error input {
    border-color: #dc3545;
}

.field .input-area i {
    position: absolute;
    top: 50%;
    font-size: 18px;
    pointer-events: none;
    transform: translateY(-50%);
}

.input-area .icon {
    left: 15px;
    color: #bfbfbf;
    transition: color 0.2s ease;
}

.input-area .error-icon {
    right: 15px;
    color: #dc3545;
}

form input:focus~.icon,
form .field.valid .icon {
    color: #5372F0;
}

form .field.shake input:focus~.icon,
form .field.error input:focus~.icon {
    color: #bfbfbf;
}

form input::placeholder {
    color: #bfbfbf;
    font-size: 17px;
}

form .field .error-txt {
    color: #dc3545;
    text-align: left;
    margin-top: 5px;
}

form .field .error {
    display: none;
}

form .field.shake .error,
form .field.error .error {
    display: block;
}

form .pass-txt {
    text-align: left;
    margin-top: -10px;
}

.wrapper a {
    color: #5372F0;
    text-decoration: none;
}

.wrapper a:hover {
    text-decoration: underline;
}

form input[type="submit"] {
    height: 50px;
    margin-top: 30px;
    width: 60%;
    color: #fff;
    padding: 0;
    border: none;
    background: #2c3b6d;
    cursor: pointer;
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

form input[type="submit"]:hover {
    background: #212F3D;
}
</style>