document.addEventListener("DOMContentLoaded", () => {

    const scrollers = document.querySelectorAll(".product-scroller");

    scrollers.forEach((scroller) => {
        const track = scroller.querySelector(".product-track");
        const leftBtn = scroller.querySelector(".scroll-btn-left");
        const rightBtn = scroller.querySelector(".scroll-btn-right");

        if (!track) return;

        const scrollAmount = () => {

            const card = track.querySelector(".product-card");
            return card ? card.offsetWidth + 16 : 260;
        };

        leftBtn?.addEventListener("click", () => {
            track.scrollBy({
                left: -scrollAmount(),
                behavior: "smooth",
            });
        });

        rightBtn?.addEventListener("click", () => {
            track.scrollBy({
                left: scrollAmount(),
                behavior: "smooth",
            });
        });
    });
});
