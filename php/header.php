<style>
:root {
    --main: #1C2833;
    --second: #283747;
}

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    list-style: none;
    text-decoration: none !important;

}

header {
    position: fixed;
    right: 0;
    top: 0;
    z-index: 100000;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 5px 9%;
}

.logo {
    font-size: 20px;
    font-weight: 700;
    padding-left: 6%;
    color: white;
    text-decoration: none;
}


.navlist,
.navlist2 {
    display: flex;
    z-index: 1000;
}

.navlist a,
.navlist2 a {
    color: white;
    margin-right: 60px;
    margin-bottom: 10px;
    font-size: 17px;
    font-weight: 500;
    border-bottom: 2px solid transparent;
    transition: all .55s ease;
}

#menu-icon {
    color: black;
    font-size: 35px;
    z-index: 10001%;
    cursor: pointer;
    display: none;
}

.bg-info {
    background: linear-gradient(to right, var(--main), var(--second)) !important;
}

.rounded-10 {
    border-radius: 150px 150px 0px 0px;
}

.info {
    height: 100%;
    width: 100%;
    min-height: 100vh;
    background: linear-gradient(to right, var(--main), var(--second));
    /* o este to right, #87CEEB, #00BFFF */
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    align-items: center;
    gap: 2rem;
}

.info-img img {
    width: 80%;
    height: auto;
    margin-top: -10px;
}

section {
    padding: 0 8%;
}

section .container-fluid {
    padding: 0 8%;
    padding-top: 13vh !important;
}

.info-text h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 50px;
    line-height: 1;
    color: white;
    margin: 0 0 45px;

}

.shadow-2 {
    box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}

.shadow-3 {
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.st-2 {
    color: black !important;
}

.info-text a {
    display: inline-block;
    color: white;
    background: #000000;
    border: 1px solid transparent;
    padding: 12px 30px;
    line-height: 1.4;
    font-size: 14px;
    font-weight: 500;
    border-radius: 30px;
    text-transform: uppercase;
    transition: all .55s ease;

}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #181818 !important;
    color: white;
    overflow-x: hidden;
    background-color: #000000;
    background-image: url("https://www.transparenttextures.com/patterns/concrete-wall.png");
}

.img-placa {
    margin-left: auto;
    margin-right: auto;
    margin-top: 16% !important;
    display: block;
    /* Esto es importante para que el margin:auto funcione */
}

.info-text a:hover {
    background: transparent;
    border: 1px solid white;
    transform: translate(8px);
}

.icons {
    position: absolute;
    top: 70%;
    padding: 0 9%;
    transform: translateY(-50%);
    right: 0px;
}

.icons i {
    display: block;
    margin: 26px 0;
    font-size: 24px;
    color: black;
    transition: all .50s ease;
}

.icons i:hover {
    color: white;
    transform: translateX(8px);
}

.st {
    padding-top: 6%;
}

@media (min-width : 800px) {
    .footer-1 {
        display: none !important;
    }
}

@media (max-width : 1535px) {
    .navlist a {
        margin-right: 50px;
    }

    header {
        padding: 0px 2%;
        transition: .2s;
    }

    .icons {
        padding: 0 3%;
        transition: .2s;
    }
}

@media (max-width : 1460px) {
    selection {
        padding: 0 12%;
        transition: .2s;
    }

}

@media (max-width : 1340px) {
    .info-img {
        width: 100%;
        height: auto;
    }

    .info-text h1 {
        font-size: 40px;
        margin: 0 0 30px;
    }

}

@media (max-width : 1195px) {
    selection {
        padding: 0 3%;
        transition: .2s;
    }

    .info-text {
        padding-top: 115px;
    }

    .info-text p {
        line-height: 1.8 !important;
    }

    .info-text h1,
    .info-text2 h1 {
        font-size: 32px !important;
        padding: 5px;
    }

    .info-img {
        text-align: center;
    }

    .info-img img {
        width: 560px;
        height: auto;
    }

    .info {
        height: 100%;
        gap: 1rem;
        grid-template-columns: 1fr;
    }
}

@media (max-width : 990px) {



    .info-text p {
        line-height: 1.8 !important;
    }

    .st {
        padding-top: 0px;
    }

    #menu-icon {
        display: block;
    }

    .navlist {
        position: absolute;
        top: -600% !important;
        right: 0;
        width: 100%;
        height: 243px;
        background: rgb(248, 249, 250);
        display: flex;
        align-items: left;
        flex-direction: column;
        padding: 20px 40px;
    }

    .navlist2 {
        position: absolute;
        top: -350%;
        right: 0;
        width: 100%;
        height: 243px;
        background: rgb(248, 249, 250);
        display: flex;
        align-items: left;
        flex-direction: column;
        padding: 20px 40px;
    }

    .navlist a,
    .navlist2 a {
        margin-left: 0;
        display: none;
        margin: 0px 0;

    }

    .navlist.open {
        top: 67 !important;
        transition-duration: 0.5s;
    }

    .logo {
        padding-left: 2%;
    }
}

@media (max-width : 680px) {

    .image-container-detail {
        height: 180px !important;
    }

    .image-container {
        height: 150px !important;
    }

    .image-container-relevant {
        height: 220px !important;
    }

    .footer-1 {
        display: block;
    }

    .video-container {
        width: 100%;
        height: 40vh !important;
    }

    p {
        text-align: justify !important;
        font-size: 16px !important;
    }

    .img-placa {
        width: 260px !important;
        margin-top: 3px !important;
    }

    .info-text p {
        line-height: 1.7 !important;
    }

    .info-img {
        width: 100%;
        height: auto;
    }
}

.btn-success {
    background-color: #28B463;
    border: 0;
    border-radius: 40px !important;
}

label {
    font-family: 'Poppins', sans-serif;
    font-size: 18px;
    line-height: 1;
    color: black;
    margin: 0 0 45px;
}



.floating-button {
    bottom: 40px;
    right: 40px;
    position: fixed;
    z-index: 1000;
    font-size: 30px !important;
}

.video-container {
    width: 100%;
    height: 55vh;
    overflow: hidden;
    box-shadow: inset 0px -48px 85px -15px black;
}

.video-container video {
    width: 100%;
    height: 100%;
    object-fit: fill;
    opacity: 0.7;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    /* Cambia el valor alpha según lo oscuro que desees */
}

.titulo-card {
    font-size: 19px !important;
}


.swiper-container {
    margin-top: 20px;
    padding: 20px;
    position: relative;
    z-index: 1;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.swiper-slide .image-container,
    {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.5s;
}

.swiper-slide .image-container:hover,
.swiper-slide .image-container-relevant:hover {
    transform: scale(1.05);
    transition: transform 0.6s;
}
}

/* Efecto de vidrio */
.swiper-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    backdrop-filter: blur(10px);
    z-index: -1;
}

/* Efecto de humo */
.swiper-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;

    opacity: 0.05;
    z-index: -2;
}

.image-container {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    /* Ajusta el radio para dar forma a la imagen */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra para la imagen */
}

.image-container-detail {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
    /* Ajusta el radio para dar forma a la imagen */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra para la imagen */
}

.image-container-relevant {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
    /* Ajusta el radio para dar forma a la imagen */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra para la imagen */
}

.image-container-detail img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}

.image-container-relevant img {
    width: 100%;
    height: 100%;
    object-fit: fill;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: fill;
    /* Ajuste de la imagen dentro del contenedor */
}
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- SEO OPEN -->
    <title>MegaKVRoms</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Obtén Games confiables y servicios de seguros en los Estados Unidos. Explora nuestras opciones asequibles y eficientes para asegurar tu vehículo.">
    <meta name="keywords"
        content="Games, Games en línea, smog, seguros, inspecciones de autos, títulos de autos, historial de verificación de smog">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <link rel="canonical" href="https://serviplatexpressusa.com">
    <link rel="alternate" hreflang="en" href="https://serviplatexpressusa.com/english">
    <link rel="alternate" hreflang="es" href="https://serviplatexpressusa.com">
    <meta name="title" content="Games">
    <meta name="language" content="Español">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Games">
    <meta property="og:locale" content="es">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Games">
    <meta property="og:description"
        content="Games cerca de mi, te facilitamos el proceso de obtención de Games de manera fácil y rápida.">
    <meta property="og:image" content="https://serviplatexpressusa.com/img/track.png">
    <meta property="og:image:secure_url" content="https://serviplatexpressusa.com/img/track.png">
    <meta property="og:url" content="https://serviplatexpressusa.com/">
    <meta property="og:site_name" content="Games">
    <meta property="og:type" content="article" />
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="article:published_time" content="2023-02-16T01:19:34+00:00">
    <meta property="article:modified_time" content="2024-01-10T22:18:53+00:00">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Games">
    <meta name="twitter:description"
        content="¿Necesitas Games para tu vehículo? En nuestra página, te facilitamos el proceso de obtención de Games del DMV de manera fácil y rápida.">
    <meta name="twitter:image"
        content="https://Placastemporalesdmv.com/wp-content/uploads/2023/09/cropped-Sin-titulo-3-1.png">
    <meta name="twitter:label1" content="Escrito por">
    <meta name="twitter:data1" content="serviplatexpressusa.com">
    <meta name="twitter:label2" content="Tiempo de lectura">
    <meta name="twitter:data2" content="3 minutos">
    <link rel="icon" href="./img/logo.png" />
    <link rel="icon" href="https://serviplatexpressusa.com/img/track.png" sizes="32x32">
    <link rel="icon" href="https://serviplatexpressusa.com/img/track.png" sizes="192x192">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <meta name="google-site-verification" content="oEzchOAbUOTxZwgusyuGkg25Xzptb8XOKkDR2-ObyrY" />
    <!-- SEO CLOSED -->

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-1">

    <header class="shadow-2 bg-black st-2">
        <a href="./index" class="logo"><img src="./img/logo.png" style="width: 65px; height: 65px;" alt="">MegaKVRoms
            <ul class="navlist2 bg-black">
                <li><a href="./index">Home</a></li>
                <li><a href="./plataformas">Plataformas</a></li>
                <li><a href="./search">Search</a></li>
            </ul>
    </header>



    <a href="https://wa.me/+0" target="_blank"
        class="btn btn-success shadow px-4 py-3 px-md-3 py-md-3 shadow  floating-button d-none">
        <i class='bx bxl-whatsapp'></i>
    </a>