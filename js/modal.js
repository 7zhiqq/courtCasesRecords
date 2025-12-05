document.addEventListener('DOMContentLoaded', function() {
    const modals = [
        { modalId: 'addCaseModal', btnId: 'addCaseBtn' },
        { modalId: 'addDocsModal', btnId: 'addDocsBtn' },
        { modalId: 'addPartyModal', btnId: 'addPartyBtn'}
    ];

    modals.forEach(item => {
        const modal = document.getElementById(item.modalId);
        // Use querySelectorAll so multiple buttons with the same id/class are handled
        const btns = Array.from(document.querySelectorAll(`#${item.btnId}`));
        const closeBtn = modal ? modal.querySelector('.close') : null;

        if (btns.length && modal) {
            // Open modal for all matching buttons
            btns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.classList.add('active');
                });
            });
        }

        if (closeBtn) {
            // Close modal 
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
            });
        }

        // Close modal when clicking outside the modal content
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        }
    });
});

