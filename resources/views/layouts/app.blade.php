<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? 'Madame Djeli' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* 3D Hover */
        .parallax-card {
            transform-style: preserve-3d;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .parallax-card:hover {
            transform: rotateX(6deg) rotateY(-6deg) scale(1.03);
            box-shadow: 0 20px 40px rgba(0,0,0,.25);
        }

        /* Navbar Scroll */
        .nav-scroll {
            background: linear-gradient(to right, #d5a556, #ebc47c, #d5a556);
            box-shadow: 0 2px 18px rgba(0,0,0,.25);
        }

        /* Hide scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Gold Utilities */
        .text-gold { color: #d5a556; }
        .border-gold { border-color: #d5a556; }

        /* Testimonial Card Hover */
        .testimonial-card {
            transition: all .4s ease;
        }
        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 40px rgba(0,0,0,.12);
            border-color: #d5a556;
        }
    </style>
</head>

<body x-data="{ fade: true }"
      x-init="setTimeout(() => fade = false, 50)"
      x-bind:class="fade ? 'opacity-0' : 'opacity-100'"
      class="transition-all duration-700 ease-out">
    <div class="pointer-events-none fixed inset-0 z-[1] opacity-[0.07] bg-gradient-to-br from-[#d8b567] via-transparent to-[#b88b3c]"></div>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Main Content --}}
    <main class="pt-[80px] min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Lazyload Images -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("img").forEach(img => {
                img.loading = "lazy";
                img.decoding = "async";
            });
        });
    </script>

    <!-- Navbar Scroll -->
    <script>
        document.addEventListener("scroll", () => {
            const nav = document.getElementById("navbar");
            if (!nav) return;

            (window.scrollY > 80)
                ? nav.classList.add("nav-scroll")
                : nav.classList.remove("nav-scroll");
        });
    </script>

    <!-- Mobile Menu Toggle -->
    <script>
        const mobileBtn = document.getElementById("mobileBtn");
        if (mobileBtn) {
            mobileBtn.onclick = () =>
                document.getElementById("mobileMenu").classList.toggle("hidden");
        }
    </script>

    <!-- Footer Fade-in -->
    <script>
        document.addEventListener("scroll", () => {
            const footer = document.getElementById("footer");
            if (!footer) return;

            const rect = footer.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100) {
                footer.classList.remove("opacity-0", "translate-y-10");
            }
        });
    </script>

    <!-- Parallax Scroll -->
    <script>
        document.addEventListener("scroll", () => {
            document.querySelectorAll("[data-parallax]").forEach(layer => {
                const speed = parseFloat(layer.getAttribute("data-parallax"));
                layer.style.transform = `translateY(${window.scrollY * speed}px)`;
            });
        });
    </script>

    <!-- Swiper Core -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Swiper Init -->
    <script>
        new Swiper(".testimonialSlider", {
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            grabCursor: true,
            slidesPerView: 1,
            spaceBetween: 30,
            breakpoints: {
                640: { slidesPerView: 1 },
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 3 }
            }
        });
    </script>

    <!-- Success Popup -->
<div id="successPopup"
    class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-[999] hidden">
    <div class="bg-white text-black p-8 rounded-2xl w-80 text-center animate-fade">
        <div class="text-5xl mb-3">✨</div>
        <h3 class="text-xl font-bold mb-2">Reservation Sent!</h3>
        <p class="text-gray-700 mb-6">Kami telah mengarahkan Anda ke WhatsApp.</p>
        <button onclick="closeSuccessPopup()"
            class="w-full py-2 bg-gold text-black rounded-lg font-semibold border border-gold">
            OK
        </button>
    </div>
</div>

<style>
    .animate-fade {
        animation: fadeIn 0.4s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .shake {
        animation: shake 0.3s ease;
    }
    @keyframes shake {
        0% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        50% { transform: translateX(5px); }
        100% { transform: translateX(0); }
    }
</style>

<script>
function closeSuccessPopup() {
    document.getElementById("successPopup").classList.add("hidden");
}

document.getElementById("waReservationForm").addEventListener("submit", function(e) {
    e.preventDefault();

    // ambil value
    let name = document.getElementById("name").value.trim();
    let people = document.getElementById("people").value.trim();
    let date = document.getElementById("date").value.trim();
    let note = document.getElementById("note").value.trim();

    // error references
    let errName = document.getElementById("errName");
    let errPeople = document.getElementById("errPeople");
    let errDate = document.getElementById("errDate");

    // reset error
    errName.classList.add("hidden");
    errPeople.classList.add("hidden");
    errDate.classList.add("hidden");

    // VALIDATION
    let hasError = false;

    if (name === "") {
        errName.classList.remove("hidden");
        document.getElementById("name").classList.add("shake");
        hasError = true;
    }
    if (people === "" || people <= 0) {
        errPeople.classList.remove("hidden");
        document.getElementById("people").classList.add("shake");
        hasError = true;
    }
    if (date === "") {
        errDate.classList.remove("hidden");
        document.getElementById("date").classList.add("shake");
        hasError = true;
    }

    setTimeout(() => {
        document.getElementById("name").classList.remove("shake");
        document.getElementById("people").classList.remove("shake");
        document.getElementById("date").classList.remove("shake");
    }, 400);

    if (hasError) return;

    // WA FORMAT
    let message =
`✨ *Reservation Request* ✨
———————————————
👤 Name: ${name}
👥 Guests: ${people}
📅 Date: ${date}
📝 Notes: ${note}
———————————————
Sent from *Madame Djeli Website*`;

    let phone = "62895328879093";

    let url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;

    window.open(url, "_blank");

    // Show success popup
    document.getElementById("successPopup").classList.remove("hidden");
});
</script>



</body>
</html>
