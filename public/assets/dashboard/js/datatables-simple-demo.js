window.addEventListener("DOMContentLoaded", (event) => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    // Inisialisasi DataTable untuk tabel dengan id "datatablesSimple"
    const datatablesSimple = document.getElementById("datatablesSimple");
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    // Inisialisasi DataTable untuk tabel dengan id "datatablesModal"
    const datatablesModal = document.getElementById("datatablesModal");
    if (datatablesModal) {
        new simpleDatatables.DataTable(datatablesModal);
    }
});
