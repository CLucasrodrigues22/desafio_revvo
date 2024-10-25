// Modal para gerenciamento de curso
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

// Modal para gerenciamento de conta
document.getElementById('passwordConfirmInput').addEventListener('input', function () {
    const password = document.getElementById('passwordInput').value;
    const confirmPassword = this.value;
    const alert = document.getElementById('passwordAlert');

    if (password && confirmPassword && password !== confirmPassword) {
        alert.style.display = 'block';
    } else {
        alert.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const modalTitle = document.getElementById('exampleModalLabel');
    const form = document.getElementById('authenticationForm');
    const passwordField = document.getElementById('passwordField');
    const confirmPasswordField = document.getElementById('passwordConfirmField');
    const nameField = document.getElementById('nameField');
    const avatarField = document.getElementById('avatarField');
    const avatarImg = document.getElementById('avatarImg');

    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            const action = trigger.getAttribute('data-action');
            form.setAttribute('data-action', action);

            // Limpar campos antes de configurar
            form.reset();
            avatarImg.style.display = 'none'; // Ocultar imagem de avatar
            passwordField.style.display = 'block'; // Mostrar o campo de senha
            confirmPasswordField.style.display = 'block'; // Mostrar o campo de confirmação

            if (action === 'view') {
                modalTitle.innerText = 'Dados do usuário';
                form.setAttribute('action', '/updateuser');

                // Preencher campos com dados do usuário
                document.getElementById('nameInput').value = trigger.getAttribute('data-name');
                document.getElementById('emailInput').value = trigger.getAttribute('data-email');

                // Exibir imagem de avatar, se disponível
                const avatar = trigger.getAttribute('data-avatar');
                if (avatar) {
                    avatarImg.src = `/storage/user-avatar/${avatar}`;
                    avatarImg.style.display = 'block';
                }

                // Mostrar campos de senha e confirmaçao, mas sem required
                nameField.style.display = 'block'; // Mostrar o campo de nome
                avatarField.style.display = 'block'; // Mostrar o campo de avatar
                passwordField.style.display = 'none';
                confirmPasswordField.style.display = 'none';

            } else {
                // Se for ação de login
                if (action === 'login') {
                    modalTitle.innerText = 'Login';
                    form.setAttribute('action', '/auth');

                    // Ocultar campos de nome e avatar para login
                    nameField.style.display = 'none';
                    avatarField.style.display = 'none';

                    // Limpar campos e restaurar configuraçao
                    passwordField.required = true; // Tornar obrigatório em login
                    confirmPasswordField.required = false; // Não obrigatório em login
                    confirmPasswordField.style.display = 'none'; // Ocultar o campo de confirmaçao
                } else {
                    // Se for ação de criar conta
                    modalTitle.innerText = 'Criar Conta';
                    form.setAttribute('action', '/newaccount');

                    // Mostrar campos de nome e avatar para criaçao de conta
                    nameField.style.display = 'block'; // Mostrar o campo de nome
                    avatarField.style.display = 'block'; // Mostrar o campo de avatar

                    // Limpar campos e restaurar configuração
                    passwordField.required = true; // Tornar obrigatorio em nova conta
                    confirmPasswordField.required = true; // Também obrigatório
                }
            }
        });
    });
});

