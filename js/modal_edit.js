const editBtn = document.querySelectorAll(".btn-edit");
const editModal = document.getElementById("editCaseModal");
const closeBtn = editModal.querySelector(".close");

editBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    editModal.style.display = "block";
  });
});

closeBtn.addEventListener("click", () => {
  editModal.style.display = "none";
});

window.addEventListener("click", (e) => {
  if (e.target == editModal) {
    editModal.style.display = "none";
  }
});
