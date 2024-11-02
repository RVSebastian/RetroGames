<div class="fixed-bottom bg-black pt-3 pb-1 shadow-lg footer-1">
    <ul class="nav justify-content-center">
        <li class="nav-item text-center mx-md-4">
            <i class='bx bxs-home text-center text-white'></i>
            <a class="nav-link active text-white" aria-current="page" href="./index">Home</a>
        </li>
        <li class="nav-item text-center mx-md-4">
            <i class='bx bxs-game text-center text-white'></i>
            <a class="nav-link text-white" href="./games">Games</a>
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