document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("contactForm");
    if (!form) return;

    const nameField = document.getElementById("name");
    const emailField = document.getElementById("email");
    const messageField = document.getElementById("message");
    const messageCounter = document.getElementById("messageCounter");

    const MAX_MESSAGE_LENGTH = 500;

    // === Live character counter for message ===
    if (messageField && messageCounter) {
        const updateCounter = () => {
            const length = messageField.value.length;
            messageCounter.textContent = `${length} / ${MAX_MESSAGE_LENGTH}`;
        };

        messageField.addEventListener("input", () => {
            if (messageField.value.length > MAX_MESSAGE_LENGTH) {
                messageField.value = messageField.value.slice(0, MAX_MESSAGE_LENGTH);
            }
            updateCounter();
        });

        // Initial call
        updateCounter();
    }

    // === Simple client-side validation ===
    form.addEventListener("submit", (e) => {
        let valid = true;

        // Clear previous error styles
        [nameField, emailField, messageField].forEach((field) => {
            if (field) field.classList.remove("field-error");
        });

        // Name required
        if (nameField && !nameField.value.trim()) {
            nameField.classList.add("field-error");
            valid = false;
        }

        // Email basic validation
        if (emailField) {
            const value = emailField.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!value || !emailRegex.test(value)) {
                emailField.classList.add("field-error");
                valid = false;
            }
        }

        // Message required
        if (messageField && !messageField.value.trim()) {
            messageField.classList.add("field-error");
            valid = false;
        }

        // If invalid, prevent submit & scroll to form
        if (!valid) {
            e.preventDefault();
            form.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    });
});