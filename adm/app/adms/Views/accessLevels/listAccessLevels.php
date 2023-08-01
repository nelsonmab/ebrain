<?php

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Listar Nível de Acesso</span>
            <div class="top-list-right">
                <?php
                if ($this->data['button']['add_access_levels']) {
                    echo "<a href='" . URLADM . "add-access-levels/index' class='btn-success'>Cadastrar</a> ";
                }
                if ($this->data['button']['sync_pages_levels']) {
                    echo "<a href='" . URLADM . "sync-pages-levels/index' class='btn-warning'>Sincronizar</a>";
                }
                ?>
            </div>
        </div>

        <div class="top-list">
            <form method="POST" action="">
                <div class="row-input-search">
                    <?php
                    $search_name = "";
                    if (isset($valorForm['search_name'])) {
                        $search_name = $valorForm['search_name'];
                    }
                    ?>
                    <div class="column">
                        <label class="title-input-search">Nome: </label>
                        <input type="text" name="search_name" id="search_name" class="input-search" placeholder="Pesquisar pelo nome do nível de acesso" value="<?php echo $search_name; ?>">
                    </div>

                    <div class="column margin-top-search-one">
                        <button type="submit" name="SendSearchAccessLevels" class="btn-info" value="Pesquisar">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>        

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <table class="table-list">
            <thead class="list-head">
                <tr>
                    <th class="list-head-content">ID</th>
                    <th class="list-head-content">Nome</th>
                    <th class="list-head-content table-sm-none">Ordem</th>
                    <th class="list-head-content">Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listAccessLevels'] as $accessLevels) {
                    extract($accessLevels);
                ?>
                    <tr>
                        <td class="list-body-content"><?php echo $id; ?></td>
                        <td class="list-body-content"><?php echo $name; ?></td>
                        <td class="list-body-content table-sm-none"><?php echo $order_levels; ?></td>
                        <td class="list-body-content">
                            <div class="dropdown-action">
                                <button onclick="actionDropdown(<?php echo $id; ?>)" class="dropdown-btn-action">Ações</button>
                                <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                    <?php
                                    if ($this->data['button']['order_access_levels']) {
                                        echo "<a href='" . URLADM . "order-access-levels/index/$id?pag=" . $this->data['pag'] . "'><i class='fa-solid fa-angles-up'></i> Ordem</a>";
                                    }
                                    if ($this->data['button']['list_permission']) {
                                        echo "<a href='" . URLADM . "list-permission/index?level=$id'><i class='fa-solid fa-house-lock'></i> Permissão</a>";
                                    }
                                    if ($this->data['button']['view_access_levels']) {
                                        echo "<a href='" . URLADM . "view-access-levels/index/$id'><i class='fa-solid fa-eye'></i> Visualizar</a>";
                                    }
                                    if ($this->data['button']['edit_access_levels']) {
                                        echo "<a href='" . URLADM . "edit-access-levels/index/$id'><i class='fa-solid fa-pen-to-square'></i> Editar</a>";
                                    }
                                    if ($this->data['button']['delete_access_levels']) {
                                        echo "<a href='" . URLADM . "delete-access-levels/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'><i class='fa-solid fa-trash-can'></i> Apagar</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <?php echo $this->data['pagination']; ?>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->