function toggleModal(modalID) {
  document.getElementById(modalID).classList.toggle("hidden");
  document.getElementById(modalID).classList.toggle("flex");
}

function closeModal() {
  document.getElementById("confirmationModal").classList.add("hidden");
  document.getElementById("confirmationModal").classList.remove("flex");
}

function deleteItem() {
  // Logic untuk menghapus item di sini
  console.log("Item deleted");
  closeModal();
}
