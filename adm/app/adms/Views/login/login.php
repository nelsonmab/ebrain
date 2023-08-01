<?php

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>

<div class="container-login">
    <div class="wrapper-login">

        <div class="title">
        <img src="<?php echo URLADM; ?>app/adms/assets/image/logo/logologin.png" alt="Ebrain" class="logo">
    
            <span>Área de Acesso</span>
        </div>

        <div class="msg-alert">
                <?php
                if (isset($_SESSION['msg'])) {
                    echo "<span id='msg'> " . $_SESSION['msg'] . "</span>";
                    unset($_SESSION['msg']);
                } else {
                    echo "<span id='msg'></span>";
                }
                ?>
                
            </div>

        <form method="POST" action="" id="form-login" class="form-login">            

            <?php
            $user = "";
            if (isset($valorForm['user'])) {
                $user = $valorForm['user'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user; ?>" required>
            </div>

            <?php
            $password = "";
            if (isset($valorForm['password'])) {
                $password = $valorForm['password'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a senha" autocomplete="on" value="<?php echo $password; ?>" required>
            </div>

            <div class="row button">
                <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>

            <div class="signup-link">
                <a href="<?php echo URLADM; ?>new-user/index">Cadastrar</a> - <a href="<?php echo URLADM; ?>recover-password/index">Esqueceu a senha?</a>
            </div>
            
            <div class="signup-link">
                <a href="https://ebrainpcpa.000webhostapp.com">Voltar a Pagina Principal</a> 
            </div>

        </form>

       Versão 1.0<br>
       
       
     
    </div>
</div>