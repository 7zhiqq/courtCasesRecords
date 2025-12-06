document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".editLawyerBtn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-lawyer-id"); // FIXED
            const modal = document.getElementById("editLawyerModal-" + id);

            modal.style.display = "block";

            // close button
            modal.querySelector(".close").onclick = () => {
                modal.style.display = "none";
            };

            // click outside to close
            window.onclick = (e) => {
                if (e.target === modal) modal.style.display = "none";
            };
        });
    });
});
