// Permitir retorno no navegador no formulario apos o erro
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

/* Inicio Dropdown Navbar */
//let notification = document.querySelector(".notification");
let avatar = document.querySelector(".avatar");

dropMenu(avatar);
//dropMenu(notification);

function dropMenu(selector) {
    //console.log(selector);
    selector.addEventListener("click", () => {
        let dropdownMenu = selector.querySelector(".dropdown-menu");
        dropdownMenu.classList.contains("active") ? dropdownMenu.classList.remove("active") : dropdownMenu.classList.add("active");
    });
}
/* Fim Dropdown Navbar */

/* Inicio Sidebar Toggle / bars */
let sidebar = document.querySelector(".sidebar");
let bars = document.querySelector(".bars");

bars.addEventListener("click", () => {
    sidebar.classList.contains("active") ? sidebar.classList.remove("active") : sidebar.classList.add("active");
});

window.matchMedia("(max-width: 768px)").matches ? sidebar.classList.remove("active") : sidebar.classList.add("active");
/* Fim Sidebar Toggle / bars */

/* Inicio botao dropdown do listar */

function actionDropdown(id) {
    closeDropdownAction();
    document.getElementById("actionDropdown" + id).classList.toggle("show-dropdown-action");
}

window.onclick = function(event) {
    if (!event.target.matches(".dropdown-btn-action")) {
        /*document.getElementById("actionDropdown").classList.remove("show-dropdown-action");*/
        closeDropdownAction();
    }
}

function closeDropdownAction() {
    var dropdowns = document.getElementsByClassName("dropdown-action-item");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i]
        if (openDropdown.classList.contains("show-dropdown-action")) {
            openDropdown.classList.remove("show-dropdown-action");
        }
    }
}
/* Fim botao dropdown do listar */

// Calcular a forca da senha
function passwordStrength() {
    var password = document.getElementById("password").value;
    var strength = 0;

    if ((password.length >= 6) && (password.length <= 7)) {
        strength += 10;
    } else if (password.length > 7) {
        strength += 25;
    }

    if ((password.length >= 6) && (password.match(/[a-z]+/))) {
        strength += 10;
    }

    if ((password.length >= 7) && (password.match(/[A-Z]+/))) {
        strength += 20;
    }

    if ((password.length >= 8) && (password.match(/[@#$%;*]+/))) {
        strength += 25;
    }

    if (password.match(/([1-9]+)\1{1,}/)) {
        strength -= 25;
    }
    viewStrength(strength);
}

function viewStrength(strength) {
    // Imprimir a força da senha 
    if (strength < 30) {
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-danger'>Senha Fraca</p>";
    } else if ((strength >= 30) && (strength < 50)) {
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-warning'>Senha Média</p>";
    } else if ((strength >= 50) && (strength < 69)) {
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-primary'>Senha Boa</p>";
    } else if (strength >= 70) {
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert-success'>Senha Forte</p>";
    } else {
        document.getElementById("msgViewStrength").innerHTML = "";
    }
}


const formAddUser = document.getElementById("form-add-user");
if (formAddUser) {
    formAddUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        //Receber o valor do campo
        var user = document.querySelector("#user").value;
        // Verificar se o campo esta vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
        // Verificar se o campo esta vazio
        if (adms_sits_user_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo situação!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_access_level_id = document.querySelector("#adms_access_level_id").value;
        // Verificar se o campo esta vazio
        if (adms_access_level_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nível de acesso!</p>";
            return;
        }

        //Receber o valor do campo
        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            return;
        }
        // Verificar se o campo senha não possui números repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha não deve ter número repetido!</p>";
            return;
        }
        // Verificar se o campo senha possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter pelo menos uma letra!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditUser = document.getElementById("form-edit-user");
if (formEditUser) {
    formEditUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        //Receber o valor do campo
        var user = document.querySelector("#user").value;
        // Verificar se o campo esta vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
        // Verificar se o campo esta vazio
        if (adms_sits_user_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo situação!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditUserPass = document.getElementById("form-edit-user-pass");
if (formEditUserPass) {
    formEditUserPass.addEventListener("submit", async(e) => {

        //Receber o valor do campo
        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            return;
        }
        // Verificar se o campo senha não possui números repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha não deve ter número repetido!</p>";
            return;
        }
        // Verificar se o campo senha possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter pelo menos uma letra!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditProfile = document.getElementById("form-edit-profile");
if (formEditProfile) {
    formEditProfile.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        //Receber o valor do campo
        var user = document.querySelector("#user").value;
        // Verificar se o campo esta vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditProfPass = document.getElementById("form-edit-prof-pass");
if (formEditProfPass) {
    formEditProfPass.addEventListener("submit", async(e) => {

        //Receber o valor do campo
        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
        // Verificar se o campo senha possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
            return;
        }
        // Verificar se o campo senha não possui números repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha não deve ter número repetido!</p>";
            return;
        }
        // Verificar se o campo senha possui letras
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter pelo menos uma letra!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditUserImg = document.getElementById("form-edit-user-img");
if (formEditUserImg) {
    formEditUserImg.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo esta vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

const formEditProfImg = document.getElementById("form-edit-prof-img");
if (formEditProfImg) {
    formEditProfImg.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var new_image = document.querySelector("#new_image").value;
        // Verificar se o campo esta vazio
        if (new_image === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem!</p>";
            return;
        } else {
            document.getElementById("msg").innerHTML = "<p></p>";
            return;
        }
    });
}

function inputFileValImg() {
    //Receber o valor do campo
    var new_image = document.querySelector("#new_image");

    var filePath = new_image.value;

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    if (!allowedExtensions.exec(filePath)) {
        new_image.value = '';
        document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário selecionar uma imagem JPG ou PNG!</p>";
        return;
    } else {
        previewImage(new_image);
        document.getElementById("msg").innerHTML = "<p></p>";
        return;
    }
}

function previewImage(new_image) {
    if ((new_image.files) && (new_image.files[0])) {
        // FileReader() - ler o conteúdo dos arquivos
        var reader = new FileReader();
        // onload - disparar um evento quando qualquer elemento tenha sido carregado
        reader.onload = function(e) {
            document.getElementById('preview-img').innerHTML = "<img src='" + e.target.result + "' alt='Imagem' style='width: 100px;'>";
        }
    }

    // readAsDataURL - Retorna os dados do formato blob como uma URL de dados - Blob representa um arquivo
    reader.readAsDataURL(new_image.files[0]);
}

const formEditSitUser = document.getElementById("form-add-sit-user");
if (formEditSitUser) {
    formEditSitUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_color_id = document.querySelector("#adms_color_id").value;
        // Verificar se o campo esta vazio
        if (adms_color_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Cor!</p>";
            return;
        } 
    });
}

const formAddColors = document.getElementById("form-add-color");
if (formAddColors) {
    formAddColors.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var color = document.querySelector("#color").value;
        // Verificar se o campo esta vazio
        if (color === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo cor!</p>";
            return;
        }
    });
}

const formAddConfEmails = document.getElementById("form-add-conf-emails");
if (formAddConfEmails) {
    formAddConfEmails.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title = document.querySelector("#title").value;
        // Verificar se o campo esta vazio
        if (title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo titulo!</p>";
            return;
        }

        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo email!</p>";
            return;
        }

        var host = document.querySelector("#host").value;
        // Verificar se o campo esta vazio
        if (host === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo host!</p>";
            return;
        }

        var username = document.querySelector("#username").value;
        // Verificar se o campo esta vazio
        if (username === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        var smtpsecure = document.querySelector("#smtpsecure").value;
        // Verificar se o campo esta vazio
        if (smtpsecure === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo smtp!</p>";
            return;
        }

        var port = document.querySelector("#port").value;
        // Verificar se o campo esta vazio
        if (port === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo porta!</p>";
            return;
        }
    });
}

const formEditConfEmails = document.getElementById("form-edit-conf-emails");
if (formEditConfEmails) {
    formEditConfEmails.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var title = document.querySelector("#title").value;
        // Verificar se o campo esta vazio
        if (title === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo titulo!</p>";
            return;
        }

        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        var email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo email!</p>";
            return;
        }

        var host = document.querySelector("#host").value;
        // Verificar se o campo esta vazio
        if (host === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo host!</p>";
            return;
        }

        var username = document.querySelector("#username").value;
        // Verificar se o campo esta vazio
        if (username === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        var smtpsecure = document.querySelector("#smtpsecure").value;
        // Verificar se o campo esta vazio
        if (smtpsecure === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo smtp!</p>";
            return;
        }

        var port = document.querySelector("#port").value;
        // Verificar se o campo esta vazio
        if (port === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo porta!</p>";
            return;
        }
    });
}

const formEditConfEmailsPass = document.getElementById("form-edit-conf-emails-pass");
if (formEditConfEmailsPass) {
    formEditConfEmailsPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }
    });
}

const formAddAccessLeves = document.getElementById("form-add-access-levels");
if (formAddAccessLeves) {
    formAddAccessLeves.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
    });
}

const formAddSitPages = document.getElementById("form-add-sit-pages");
if (formAddSitPages) {
    formAddSitPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_color_id = document.querySelector("#adms_color_id").value;
        // Verificar se o campo esta vazio
        if (adms_color_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Cor!</p>";
            return;
        } 
    });
}

const formEditSitPages = document.getElementById("form-edit-sit-pages");
if (formEditSitPages) {
    formEditSitPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_color_id = document.querySelector("#adms_color_id").value;
        // Verificar se o campo esta vazio
        if (adms_color_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Cor!</p>";
            return;
        } 
    });
}

const formAddGroupsPages = document.getElementById("form-add-groups-pages");
if (formAddGroupsPages) {
    formAddGroupsPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
    });
}

const formEditGroupsPages = document.getElementById("form-edit-groups-pages");
if (formEditGroupsPages) {
    formEditGroupsPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
    });
}

const formAddTypesPages = document.getElementById("form-add-types-pages");
if (formAddTypesPages) {
    formAddTypesPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var type = document.querySelector("#type").value;
        // Verificar se o campo esta vazio
        if (type === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo tipo!</p>";
            return;
        }

        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
    });
}

const formEditTypesPages = document.getElementById("form-edit-types-pages");
if (formEditTypesPages) {
    formEditTypesPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var type = document.querySelector("#type").value;
        // Verificar se o campo esta vazio
        if (type === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo tipo!</p>";
            return;
        }

        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }
    });
}

const formAddPages = document.getElementById("form-add-pages");
if (formAddPages) {
    formAddPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var controller = document.querySelector("#controller").value;
        // Verificar se o campo esta vazio
        if (controller === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Classe!</p>";
            return;
        }

        //Receber o valor do campo
        var metodo = document.querySelector("#metodo").value;
        // Verificar se o campo esta vazio
        if (metodo === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Método!</p>";
            return;
        }

        //Receber o valor do campo
        var menu_controller = document.querySelector("#menu_controller").value;
        // Verificar se o campo esta vazio
        if (menu_controller === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Classe no menu!</p>";
            return;
        }

        //Receber o valor do campo
        var menu_metodo = document.querySelector("#menu_metodo").value;
        // Verificar se o campo esta vazio
        if (menu_metodo === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Método no menu!</p>";
            return;
        }

        //Receber o valor do campo
        var name_page = document.querySelector("#name_page").value;
        // Verificar se o campo esta vazio
        if (name_page === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Nome da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var publish = document.querySelector("#publish").value;
        // Verificar se o campo esta vazio
        if (publish === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Página Pública!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_sits_pgs_id = document.querySelector("#adms_sits_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_sits_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Situação da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_groups_pgs_id = document.querySelector("#adms_groups_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_groups_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Grupo da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_types_pgs_id = document.querySelector("#adms_types_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_types_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Tipo da Página!</p>";
            return;
        }
    });
}

const formEditPages = document.getElementById("form-edit-pages");
if (formEditPages) {
    formEditPages.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        var controller = document.querySelector("#controller").value;
        // Verificar se o campo esta vazio
        if (controller === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Classe!</p>";
            return;
        }

        //Receber o valor do campo
        var metodo = document.querySelector("#metodo").value;
        // Verificar se o campo esta vazio
        if (metodo === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Método!</p>";
            return;
        }

        //Receber o valor do campo
        var menu_controller = document.querySelector("#menu_controller").value;
        // Verificar se o campo esta vazio
        if (menu_controller === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Classe no menu!</p>";
            return;
        }

        //Receber o valor do campo
        var menu_metodo = document.querySelector("#menu_metodo").value;
        // Verificar se o campo esta vazio
        if (menu_metodo === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Método no menu!</p>";
            return;
        }

        //Receber o valor do campo
        var name_page = document.querySelector("#name_page").value;
        // Verificar se o campo esta vazio
        if (name_page === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Nome da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var publish = document.querySelector("#publish").value;
        // Verificar se o campo esta vazio
        if (publish === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Página Pública!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_sits_pgs_id = document.querySelector("#adms_sits_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_sits_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Situação da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_groups_pgs_id = document.querySelector("#adms_groups_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_groups_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Grupo da Página!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_types_pgs_id = document.querySelector("#adms_types_pgs_id").value;
        // Verificar se o campo esta vazio
        if (adms_types_pgs_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo Tipo da Página!</p>";
            return;
        }
    });
}

const formEditLavelForm = document.getElementById("form-edit-level-form");
if (formEditLavelForm) {
    formEditLavelForm.addEventListener("submit", async(e) => {       

        //Receber o valor do campo
        var adms_sits_user_id = document.querySelector("#adms_sits_user_id").value;
        // Verificar se o campo esta vazio
        if (adms_sits_user_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo situação!</p>";
            return;
        }

        //Receber o valor do campo
        var adms_access_level_id = document.querySelector("#adms_access_level_id").value;
        // Verificar se o campo esta vazio
        if (adms_access_level_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nível de acesso!</p>";
            return;
        }
    });
}

const formAddItemMenu = document.getElementById("form-add-item-menu");
if (formAddItemMenu) {
    formAddItemMenu.addEventListener("submit", async(e) => {       

        //Receber o valor do campo
        var name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        var icon = document.querySelector("#icon").value;
        // Verificar se o campo esta vazio
        if (icon === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo ícone!</p>";
            return;
        }
    });
}

const formEditPageMenu = document.getElementById("form-edit-page-menu");
if (formEditPageMenu) {
    formEditPageMenu.addEventListener("submit", async(e) => {       

        //Receber o valor do campo
        var adms_items_menu_id = document.querySelector("#adms_items_menu_id").value;
        // Verificar se o campo esta vazio
        if (adms_items_menu_id === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo item de menu!</p>";
            return;
        }
    });
}

/* Inicio dropdown sidebar */

var dropdownSidebar = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdownSidebar.length; i++) {
    dropdownSidebar[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}
/* Inicio dropdown sidebar ativo */

var sidebarNav = document.getElementsByClassName("sidebar-nav");

for(var i = 0; i < sidebarNav.length; i++){
    if(sidebarNav[i].classList.contains("active")){
        document.querySelector(".btn-" + sidebarNav[i].classList[1]).classList.add("active");
        document.querySelector(".cont-" + sidebarNav[i].classList[1]).classList.add("active");
    }
}

/* Fim dropdown sidebar ativo */

/* Fim dropdown sidebar */