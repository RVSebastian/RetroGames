<?php 
include'./includes/cn.php'; // incluimos la base de datos
date_default_timezone_set('America/Bogota'); // detectamos la hora
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
$Hora=date('h:i:s '); // y se la damos a una variable
$time = date('Y-m-d H:i:s');
$current_url = $_SERVER['REQUEST_URI'];

setlocale(LC_ALL, 'es_CO');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // inicimoas la session nuevamente
if (!isset($_SESSION["key"]) or !isset($_SESSION['key'])){ 
    header("Location: login");
}
include'./includes/php/validador.php'; // añadimos las validaciones de session


$url = $_SERVER['REQUEST_URI'];

// Encuentra la posición de "/dashboard/"
$pos = strpos($url, "/dashboard/");

if ($pos !== false) {
    $nombreDocumento = substr($url, $pos + strlen("/dashboard/"));
    if (empty($nombreDocumento)) {
        $nombreDocumento = "dashboard";
    }
    $user = $_SESSION['key']['usuario'];
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $http =  $_SERVER['HTTP_USER_AGENT'];
    if ($ipaddress != '::1' or $user != '' or $ipaddress != ':1' or empty($user) or $user != 'VARGAZS') {
        $query2 = "INSERT INTO logs (usuario,ext,htp,actions,time) VALUES ('$user','$ipaddress','$http','Entering the $nombreDocumento module', '$time')";
        $result2 = mysqli_query($conn, $query2);
    }

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr" >

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" href="../logo.jpeg" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

</head>

<body>
    <div class="sidebar">
        <ul class="nav-links ">
            <li class="lg:mt-5">
                <a href="./">
                    <i class='bx bxs-dashboard'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
 
            <!--
            <li>
                <a href="
                <?php if ($_SESSION["key"]['permisos'] >= 8) {
                    echo "./historial";
                }else{ echo "#";}
                ?>
                ">
                    <i class='bx bx-shield-quarter'></i>
                    <span class="links_name">Historial</span>
                </a>
            </li>
            <li>
                <a href="
                <?php if ($_SESSION["key"]['permisos'] >= 10) {
                    echo "./usuarios";
                }else{ echo "#";}
                ?>
                ">
                    <i class='bx bx-user-plus'></i>
                    <span class="links_name">Usuarios</span>
                </a>
            </li>

            -->

            <li class="log_out">
                <form method="POST">
                    <button type="submit" style="background-color: white !important; color: black !important;"
                        name='logout'>
                        <i class='bx bx-log-out'></i>
                        <span class="links_name">Salir</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <section class="home-section" style="background: #f2f2f3 !important;">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>

            </div>

           

        </nav>

        <style>
        .Activo {
            background-color: #27AE60;
        }

        .Atendido {
            background-color: #F4D03F;
        }

        .Rechazado,
        .bloqueado {
            background-color: #C0392B;
        }

        .z-40 {
            z-index: 120;
        }

        /* Googlefont Poppins CDN Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            position: fixed;
            height: 100%;
            width: 230px;
            background: rgb(255, 255, 255);
            transition: all 0.3s ease;
        }

        .sidebar i {
            font-size: 26px;
            font-weight: 700;
            color: #000000 !important;
            min-width: 60px;
            text-align: center
        }

        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 16px;
            font-weight: 500;
        }

        .sidebar .nav-links {
            margin-top: 4px;
        }

        .sidebar .nav-links li {
            position: relative;
            list-style: none;
            height: 50px;
        }

        .sidebar .nav-links li a {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
        }

        .sidebar .nav-links li a.active {
            background: #081D45;
        }

        .sidebar .nav-links li a:hover {
            background: #ececec;
        }

        

        .sidebar .nav-links li i {
            min-width: 60px;
            text-align: center;
            font-size: 16px;
            color: black;
        }

        .sidebar .nav-links li a .links_name {
            color: black;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
        }

        .sidebar .nav-links .log_out {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .home-section {
            position: relative;
            background: rgb(243, 244, 246) !important;
            min-height: 100vh;
            width: calc(100% - 230px);
            left: 230px;
            transition: all 0.5s ease;
        }

        .sidebar.active~.home-section {
            width: calc(100% - 60px);
            left: 60px;
        }

        .home-section nav {
            display: flex;
            justify-content: space-between;
            height: 70px;
            background: #131313;
            color: white;
            display: flex;
            align-items: center;
            position: fixed;
            width: calc(100% - 230px);
            left: 230px;
            z-index: 100;
            padding: 0 50px;
            box-shadow: 9px 0px 16px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }

        .sidebar.active~.home-section nav {
            left: 60px;
            width: calc(100% - 60px);
        }

        .home-section nav .sidebar-button {
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: 500;
        }

        nav .sidebar-button i {
            font-size: 26px;
            margin-right: 10px;
        }

        .home-section .home-content {
            position: relative;
            padding-top: 100px;
        }


        /* Responsive Media Query */
        @media (max-width: 1230px) {
            .sidebar {
                width: 60px;
            }

            .sidebar.active {
                width: 220px;
            }

            .home-section {
                width: calc(100% - 60px);
                left: 60px;
            }

            .sidebar.active~.home-section {
                /* width: calc(100% - 220px); */
                overflow: hidden;
                left: 220px;
            }

            .home-section nav {
                width: calc(100% - 60px);
                left: 60px;
            }

            .sidebar.active~.home-section nav {
                width: calc(100% - 220px);
                left: 220px;
            }
        }

        @media (max-width: 1150px) {
            .home-content .sales-boxes {
                flex-direction: column;
            }

            .home-content .sales-boxes .box {
                width: 100%;
                overflow-x: scroll;
                margin-bottom: 30px;
            }

            .home-content .sales-boxes .top-sales {
                margin: 0;
            }
        }

        @media (max-width: 1000px) {
            .overview-boxes .box {
                width: calc(100% / 2 - 15px);
                margin-bottom: 15px;
            }
        }

        @media (max-width: 700px) {

            nav .sidebar-button .dashboard,
            nav .profile-details .admin_name,
            nav .profile-details i {
                display: none;
            }

            .home-section nav .profile-details {
                height: 50px;
                min-width: 40px;
            }

            .home-content .sales-boxes .sales-details {
                width: 560px;
            }
        }

        @media (max-width: 550px) {
            .overview-boxes .box {
                width: 100%;
                margin-bottom: 15px;
            }

            .sidebar.active~.home-section nav .profile-details {
                display: none;
            }
        }

        @media (max-width: 400px) {
            .sidebar {
                width: 0;
            }

            .sidebar.active {
                width: 60px;
            }

            .home-section {
                width: 100%;
                left: 0;
            }

            .sidebar.active~.home-section {
                left: 60px;
                width: calc(100% - 60px);
            }

            .home-section nav {
                width: 100%;
                left: 0;
            }

            .sidebar.active~.home-section nav {
                left: 60px;
                width: calc(100% - 60px);
            }
        }
        </style>