document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".editJudgeBtn").forEach((btn) => {
        btn.addEventListener("click", () => {
            const id = btn.getAttribute("data-judge-id"); // FIXED
            const modal = document.getElementById("editJudgeModal-" + id);

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
