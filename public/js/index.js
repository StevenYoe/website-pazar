document.addEventListener("DOMContentLoaded", function () {
    const popupModal = document.getElementById('popupModal');
    const closeModal = document.getElementById('closeModal');

    // Tampilkan modal saat halaman dimuat
    popupModal.classList.remove('hidden');

    // Sembunyikan modal saat tombol close diklik
    closeModal.addEventListener("click", function () {
        popupModal.classList.add('hidden');
    });
});