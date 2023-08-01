<?php

namespace App\adms\Models;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar os usuários do banco de dados
 *
 * @author Celke
 */
class AdmsListUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchNameValue;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmailValue;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * @return bool Retorna a paginação
     */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    /**
     * Metodo faz a pesquisa dos usuários na tabela adms_users e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * @param integer|null $page
     * @return void
     */
    public function listUsers(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                                FROM adms_users usr
                                INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                                WHERE lev.order_levels >:order_levels", "order_levels=" . $_SESSION['order_levels']);
        $this->resultPg = $pagination->getResult();

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id 
                    WHERE lev.order_levels >:order_levels
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "order_levels=" . $_SESSION['order_levels'] . "&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa dos usuarios na tabela adms_users e lista as informacoes na view
     * Recebe o paramentro "page" para que seja feita a paginacao do resultado
     * Recebe o paramentro "search_name" para que seja feita a pesquisa pelo nome do usuario
     * Recebe o paramentro "search_email" para que seja feita a pesquisa pelo email do usuario
     * @param integer|null $page
     * @param string|null $search_name
     * @param string|null $search_email
     * @return void
     */
    public function listSearchUsers(int $page = null, string|null $search_name, string|null $search_email): void
    {
        $this->page = (int) $page ? $page : 1;

        $this->searchName = trim($search_name);
        $this->searchEmail = trim($search_email);

        $this->searchNameValue = "%" . $this->searchName . "%";
        $this->searchEmailValue = "%" . $this->searchEmail . "%";

        if ((!empty($this->searchName)) and (!empty($this->searchEmail))) {
            $this->searchUsersNameEmail();
        } elseif ((!empty($this->searchName)) and (empty($this->searchEmail))) {
            $this->searchUsersName();
        } elseif ((empty($this->searchName)) and (!empty($this->searchEmail))) {
            $this->searchUsersEmail();
        } else {
            $this->searchUsersNameEmail();
        }
    }

    /**
     * Metodo pesquisar pelo nome e e-mail
     * @return void
     */
    public function searchUsersNameEmail(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                                FROM adms_users usr
                                INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                                WHERE (lev.order_levels >:order_levels)
                                AND ((usr.name LIKE :search_name) 
                                OR (usr.email LIKE :search_email))
                                ", "order_levels=" . $_SESSION['order_levels'] . "&search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}");
        $this->resultPg = $pagination->getResult();

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id 
                    WHERE (lev.order_levels >:order_levels)
                    AND ((usr.name LIKE :search_name) 
                    OR (usr.email LIKE :search_email))
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "order_levels=" . $_SESSION['order_levels'] . "&search_name={$this->searchNameValue}&search_email={$this->searchEmailValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo pesquisar pelo nome
     * @return void
     */
    public function searchUsersName(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                                FROM adms_users usr
                                INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                                WHERE (lev.order_levels >:order_levels)
                                AND (usr.name LIKE :search_name)
                                ", "order_levels=" . $_SESSION['order_levels'] . "&search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id 
                    WHERE (lev.order_levels >:order_levels)
                    AND (usr.name LIKE :search_name)
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "order_levels=" . $_SESSION['order_levels'] . "&search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo pesquisar pelo e-mail
     * @return void
     */
    public function searchUsersEmail(): void
    {
        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-users/index', "?search_name={$this->searchName}&search_email={$this->searchEmail}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result 
                                FROM adms_users usr
                                INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id
                                WHERE (lev.order_levels >:order_levels)
                                AND (usr.email LIKE :search_email)
                                ", "order_levels=" . $_SESSION['order_levels'] . "&search_email={$this->searchEmailValue}");
        $this->resultPg = $pagination->getResult();

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email, usr.adms_sits_user_id,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id 
                    WHERE (lev.order_levels >:order_levels)
                    AND (usr.email LIKE :search_email)
                    ORDER BY usr.id DESC
                    LIMIT :limit OFFSET :offset", "order_levels=" . $_SESSION['order_levels'] . "&search_email={$this->searchEmailValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }
}
