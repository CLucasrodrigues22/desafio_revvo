document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('managementCourse');
    const form = modal.querySelector('#courseForm');
    const modalTitle = modal.querySelector('#managementCourseLabel');
    const deleteButton = modal.querySelector('#deleteCourseBtn');

    modal.addEventListener('show.bs.modal', function (e) {
        const button = e.relatedTarget;

        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const bannerName = button.getAttribute('data-banner');

        if (id) {
            modalTitle.textContent = 'Detalhes do Curso';
            form.querySelector('#courseId').value = id;
            form.querySelector('#tituloInput').value = title;
            form.querySelector('#descricaoInput').value = description;

            const bannerImg = modal.querySelector('.modal-img-top');
            bannerImg.src = `storage/banner-course/${bannerName}`;
            bannerImg.style.display = 'block';

            form.action = `/updatecourse?id=${id}`;
            form.setAttribute('data-action', 'edit'); // Define data-action como edit

            deleteButton.style.display = 'block'; // Exibe o botão de deletar
        } else {
            modalTitle.textContent = 'Adicionar Curso';
            form.reset();
            modal.querySelector('.modal-img-top').style.display = 'none';

            form.action = '/storecourse'; // Altera a ação para criação
            form.setAttribute('data-action', 'create'); // Define data-action como create

            deleteButton.style.display = 'none'; // Oculta o botão de deletar
        }
    });

    if (form.dataset.action === 'edit') {
        const courseId = document.getElementById('courseId').value;
        // Supondo que você já preencheu os dados do curso corretamente
        document.getElementById('deleteCourseBtn').style.display = 'block';
    }

    // Adicionar evento de clique no botão de deletar
    deleteButton.addEventListener('click', function() {
        const courseId = form.querySelector('#courseId').value;
        if (courseId) {
            if (confirm('Tem certeza que deseja deletar este curso?')) {
                window.location.href = `/deletecourse?id=${courseId}`;
            }
        }
    });


});
