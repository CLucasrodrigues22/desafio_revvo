document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('managementCourse');
    const form = modal.querySelector('#courseForm');
    const modalTitle = modal.querySelector('#managementCourseLabel');

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

            form.action = `/updatecourse`; // Altera a ação para atualização com o ID
            form.setAttribute('data-action', 'edit'); // Define data-action como edit
        } else {
            modalTitle.textContent = 'Adicionar Curso';
            form.reset();
            modal.querySelector('.modal-img-top').style.display = 'none';

            form.action = '/storecourse'; // Altera a ação para criação
            form.setAttribute('data-action', 'create'); // Define data-action como create
        }
    });
});
