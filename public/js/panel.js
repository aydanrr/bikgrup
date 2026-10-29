/**
 * BİKGRUP - xpanel Yönetim Paneli JS Motoru
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Canlı Renk Seçici Takibi
    const colorInputs = document.querySelectorAll('.theme-color-input');
    colorInputs.forEach(input => {
        const textInput = document.querySelector(`input[data-color-sync="${input.name}"]`);
        
        input.addEventListener('input', (e) => {
            if (textInput) {
                textInput.value = e.target.value;
            }
        });

        if (textInput) {
            textInput.addEventListener('input', (e) => {
                if (/^#[0-9A-F]{6}$/i.test(e.target.value)) {
                    input.value = e.target.value;
                }
            });
        }
    });

    // 2. Silme İşlemleri Onayı
    const deleteButtons = document.querySelectorAll('[data-confirm-delete]');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const message = btn.getAttribute('data-confirm-delete') || 'Bu kaydı silmek istediğinize emin misiniz?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
});

/**
 * Modal Açma / Kapatma
 */
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
    }
}
