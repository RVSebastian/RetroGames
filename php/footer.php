<footer class="text-light" style="padding-top: 0;padding-bottom:12vh;">
    <div class="container text-center">
        <h5 class="mb-4 text-uppercase fw-bold text-white">Mis redes sociales</h5>
        <div class="d-flex justify-content-center gap-4">
            <!-- Tiktok -->
            <a href="https://www.tiktok.com/@megakv" target="_blank" class="text-light" aria-label="TikTok">
                <i class='bx bxl-tiktok fs-1'></i>
            </a>
            <a href="https://www.tiktok.com/@megakv2?_t=ZN-8sD4FNpZm1W&_r=1" target="_blank" class="text-light" aria-label="TikTok 2">
                <i class='bx bxl-tiktok fs-1'></i>
            </a>

            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100089144059117&mibextid=ZbWKwL" target="_blank" class="text-light" aria-label="Facebook">
                <i class='bx bxl-facebook fs-1'></i>
            </a>

            <!-- YouTube Principal -->
            <a href="https://youtube.com/@megakv?si=EkDfWG6Ci4pfU0eh" target="_blank" class="text-light" aria-label="YouTube Principal">
                <i class='bx bxl-youtube fs-1'></i>
            </a>

            <!-- YouTube Secundario -->
            <a href="https://youtube.com/@megakv2?si=MDs_dYLhkY4Kvsrw" target="_blank" class="text-light" aria-label="YouTube Secundario">
                <i class='bx bxl-youtube fs-1'></i>
            </a>
        </div>
        <div class="mt-4">
            <p class="small text-secondary">&copy; 2024 Megakv. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>


<div class="fixed-bottom bg-black pt-3 pb-1 shadow-lg footer-1">
    <ul class="nav justify-content-center">
        <li class="nav-item text-center mx-md-4">
            <i class='bx bxs-home text-center text-white'></i>
            <a class="nav-link active text-white" aria-current="page" href="./index">Home</a>
        </li>
        <li class="nav-item text-center mx-md-4">
            <i class='bx bx-dice-5 text-center text-white'></i>
            <a class="nav-link active text-white" aria-current="page" href="./plataformas">Plataformas</a>
        </li>
        <li class="nav-item text-center mx-md-4">
            <i class='bx bx-search text-center text-white'></i>
            <a class="nav-link text-white" href="./search">Search</a>
        </li>
    </ul>
</div>


<script src="https://unpkg.com/scrollreveal"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
const s = ScrollReveal({
    distance: '300px',
    duration: 3000,
    delay: 0,
    reset: false
});

s.reveal('.down', {
    origin: 'top',
});
s.reveal('.left', {
    origin: 'left'
});
s.reveal('.right', {
    origin: 'right'
});

s.reveal('.bottom', {
    origin: 'bottom'
});



var swiper = new Swiper('.swiper-container', {
    slidesPerView: 3,
    spaceBetween: 15,
    breakpoints: {
        640: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 5,
        },
        1024: {
            slidesPerView: 8,
        },
    },
});
var swiper2 = new Swiper('.swiper-container-relevant', {
    slidesPerView: 2,
    spaceBetween: 15,
    breakpoints: {
        640: {
            slidesPerView: 2,
        },
        768: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 6,
        },
    },
});

if (swiper2) {
    console.log('cargo');
    $('.swiper-wrapper').toggleClass('d-none');
}
</script>

</body>

</html>