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

    
    const modal = document.getElementById("productModal");
    const modalImage = document.getElementById("modalProductImage");
    const modalTitle = document.getElementById("productModalTitle");
    const modalPrice = document.getElementById("modalProductPrice");
    const modalDescription = document.getElementById("modalProductDescription");

    if (!modal || !modalImage || !modalTitle || !modalPrice || !modalDescription) {
        return;
    }

    const openModal = (card) => {
        const name = card.dataset.name || "";
        const price = card.dataset.price || "";
        const description = card.dataset.description || "";
        const image = card.dataset.image || "";

        modalTitle.textContent = name;
        modalPrice.textContent = price;
        modalDescription.textContent = description;
        modalImage.src = image;
        modalImage.alt = name;

        modal.classList.add("is-visible");
        modal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    };

    const closeModal = () => {
        modal.classList.remove("is-visible");
        modal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    };

    
    document.querySelectorAll(".product-card").forEach((card) => {
        card.addEventListener("click", () => openModal(card));
    });

    
    modal.addEventListener("click", (e) => {
        const target = e.target;
        if (target.matches("[data-modal-close]")) {
            closeModal();
        }
    });

    
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.classList.contains("is-visible")) {
            closeModal();
        }
    });
});
