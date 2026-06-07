/**
 * Fungsi untuk membuka atau menutup Modal Backdrop Tambah Data
 * @param {string} modalId 
 */
function toggleModal(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'flex';
    } else {
        modal.style.display = 'none';
    }
}