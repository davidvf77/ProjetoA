var metas = [];


//Registro e Login

function register() {

    document.getElementById("acao").value = "register";
    document.getElementById("formLogin").action = "/register";

    document.getElementById('divBtns').classList.add('invisible');
    document.getElementById('divEntrar').classList.remove('invisible');
    document.getElementById('confSenha').classList.remove('invisible');

}

function login() {

    document.getElementById("acao").value = "login";
    document.getElementById("formLogin").action = "/login";


    var divBtns = document.getElementById('divBtns');
    var divEntrar = document.getElementById('divEntrar');

    document.getElementById("confSenhaInput").required = false;

    divBtns.classList.add('invisible');
    divEntrar.classList.remove('invisible');

}

// Centralização da TextArea

function centralizarCaixa(elemento) {
    const wrapper = document.getElementById("divCaixaMetasWrapper");
    const offset = elemento.offsetLeft - (wrapper.offsetWidth / 2) + (elemento.offsetWidth / 2);
    wrapper.scrollTo({ left: offset, behavior: 'smooth' });
}

// Escolha do prazo de conclusão

function tempoEspecifico() {
        const select = document.getElementById('q1');
        const dataInicioInput = document.getElementById('data-inicio');
        const dataFimInput = document.getElementById('data-fim');
        const divTempo = document.getElementById('tempo-especifico');

        const hoje = new Date();
        const pad = n => n.toString().padStart(2, '0');
        const dataHoje = `${hoje.getFullYear()}-${pad(hoje.getMonth() + 1)}-${pad(hoje.getDate())}`;
        dataInicioInput.value = dataHoje;

        let dataFim = new Date(hoje); 

        switch (select.value) {
            case 'dia':
                dataFim.setDate(dataFim.getDate() + 1);
                break;
            case 'semana':
                dataFim.setDate(dataFim.getDate() + 7);
                break;
            case 'mes':
                dataFim.setMonth(dataFim.getMonth() + 1);
                break;
            case 'ano':
                dataFim.setFullYear(dataFim.getFullYear() + 1);
                break;
            case 'outro':
                divTempo.classList.remove('invisible');
                return;
        }

        divTempo.classList.add('invisible');

        const dataFimFormatada = `${dataFim.getFullYear()}-${pad(dataFim.getMonth() + 1)}-${pad(dataFim.getDate())}`;
        dataFimInput.value = dataFimFormatada;
    }

document.addEventListener("DOMContentLoaded", function () {
    tempoEspecifico(); 
});



// Botão de adição de Meta

function addMeta() {
    const caixas = document.querySelectorAll(".caixaMetas");
    const ultima = caixas[caixas.length - 1];

    if (ultima && ultima.value.trim() === "") {
        ultima.focus();
        return;
    }

    if (ultima) metas.push(1);

  document.querySelectorAll(".btn-img").forEach(btn => btn.remove());

    const index = caixas.length + 1; 

    setTimeout(() => {
        const novaTextArea = document.createElement("textarea");
        novaTextArea.classList.add("caixaMetas", "form-control", "gradient-background-light");
        novaTextArea.setAttribute("id", `meta${index}`);
        novaTextArea.setAttribute("placeholder", `Meta ${index}`);

        const novoBotao = document.createElement("img");
        novoBotao.classList.add("ms-4", "btn-img");
        novoBotao.setAttribute("src", imgAddMetaUrl);
        novoBotao.setAttribute("alt", "Adicionar");
        novoBotao.setAttribute("onclick", "addMeta()");

        const novaDiv = document.createElement("div");
        novaDiv.classList.add("d-flex", "flex-row", "align-items-center", "position-relative", "caixa-meta-stack");
        novaDiv.appendChild(novaTextArea);
        novaDiv.appendChild(novoBotao);

        const wrapper = document.getElementById("divCaixaMetasWrapper");
        wrapper.appendChild(novaDiv);

        novaTextArea.focus();
        centralizarCaixa(novaDiv);
    }, 100); 
}


// Salvar ou Editar Metas

document.addEventListener("DOMContentLoaded", function () {
    const form2 = document.getElementById("form2");
    if (form2) {
        form2.addEventListener("submit", function (e) {
            const textareas = document.querySelectorAll(".caixaMetas");
            const metas = [];

            let encontrouMetaSalvaVazia = false;
            let temMetaPreenchida = false;

            textareas.forEach(t => {
                const texto = t.value.trim();
                const ehSalva = t.dataset.salva === "1";

                if (texto !== "") {
                    metas.push(texto);
                    temMetaPreenchida = true;
                } else if (ehSalva) {
                    encontrouMetaSalvaVazia = true;
                    t.classList.add("border", "border-danger");
                }
            });

            if (!temMetaPreenchida) {
                alert("Digite ao menos uma meta antes de continuar.");
                e.preventDefault();
                return;
            }

            if (encontrouMetaSalvaVazia) {
                alert("Você não pode apagar metas que já foram salvas. Preencha ou as remova.");
                e.preventDefault();
                return;
            }

            document.getElementById("metas_json").value = JSON.stringify(metas);
        });
    }
});

//Botões de confirmação





