document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('managementCourse');
    const form = modal.querySelector('form');

    modal.addEventListener('show.bs.modal', function (e) {
        const button = e.relatedTarget;

        const id = button.getAttribute('data-id');
        const title = button.getAttribute('data-title');
        const description = button.getAttribute('data-description');
        const bannerName = button.getAttribute('data-banner');

        form.querySelector('#courseId').value = id;
        form.querySelector('#tituloInput').value = title;
        form.querySelector('#descricaoInput').value = description;

        const bannerImg = modal.querySelector('.modal-img-top');
        if (bannerName) {
            bannerImg.src = `storage/banner-course/${bannerName}`;
            bannerImg.style.display = 'block'; // Exibe a imagem
        } else {
            bannerImg.style.display = 'none'; // Oculta a imagem se não houver
        }
    });
});
