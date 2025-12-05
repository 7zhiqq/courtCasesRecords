document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".editPartyBtn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.getAttribute("data-party-id");
      const modal = document.getElementById("editPartyModal-" + id);

      modal.style.display = "block";

      modal.querySelector(".close").onclick = () => {
        modal.style.display = "none";
      };

      window.onclick = (e) => {
        if (e.target === modal) modal.style.display = "none";
      };
    });
  });
});
