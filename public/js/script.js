document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const name = this.getAttribute('data-name');
            if (!confirm('Yakin ingin menghapus booking atas nama ' + name + '?')) {
                e.preventDefault();
            }
        });
    });
});
