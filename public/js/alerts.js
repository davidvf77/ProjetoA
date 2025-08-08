document.addEventListener("DOMContentLoaded", function() {
    if (window.sessionError) {
        alert(window.sessionError);

        if (window.sessionForm === 'registrar') {
            document.getElementById('acao').value = 'registrar';
            document.getElementById('formLogin').action = '/registrar';

            document.getElementById('divBtns').classList.add('invisible');
            document.getElementById('divEntrar').classList.remove('invisible');
            document.getElementById('confSenha').classList.remove('invisible');
            document.getElementById("confSenhaInput").required = true;

        } else {
            document.getElementById('acao').value = 'logar';
            document.getElementById('formLogin').action = '/logar';

            document.getElementById('divBtns').classList.add('invisible');
            document.getElementById('divEntrar').classList.remove('invisible');
            document.getElementById('confSenha').classList.add('invisible');
            document.getElementById("confSenhaInput").required = false;
        }
    }
});

function confirmarExclusao() {
    return confirm('Tem certeza que deseja excluir esta meta?');
}

function confirmarConclusao() {
    return confirm('Tem certeza que deseja marcar como concluída esta meta?');
}