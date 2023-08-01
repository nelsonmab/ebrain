<?php

namespace App\cpms\Models;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar os usuários do banco de dados
 *
 * @author Nelson Oliveira de Almeida (007.277.322.77) nelsonoliveirank@gmail.com>
 */
class CpmsGeneratePdfListUsers
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
    public function listUsers(): void
    {

        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT usr.id, usr.name AS name_usr, usr.email,
                    sit.name AS name_sit,
                    col.color
                    FROM adms_users AS usr
                    INNER JOIN adms_sits_users AS sit ON sit.id=usr.adms_sits_user_id
                    INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                    INNER JOIN adms_access_levels AS lev ON lev.id=usr.adms_access_level_id 
                    WHERE lev.order_levels >:order_levels
                    ORDER BY usr.id DESC", "order_levels=" . $_SESSION['order_levels']);

        $this->resultBd = $listUsers->getResult();
        if ($this->resultBd) {
            //$this->result = true;
            $this->generatePdf();
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum usuário encontrado!</p>";
            $this->result = false;
        }
    }

    private function generatePdf()
    {
        //var_dump($this->resultBd);
        $data_pdf = "<table>";
        $data_pdf .= "<thead>";
        $data_pdf .= "<th>ID</th>";
        $data_pdf .= "<th>Nome</th>";
        $data_pdf .= "<th>E-mail</th>";
        $data_pdf .= "<th>Situação</th>";
        $data_pdf .= "</thead>";
        foreach ($this->resultBd as $user) {
            extract($user);
            $data_pdf .= "<tbody>";
            $data_pdf .= "<td>$id</td>";
            $data_pdf .= "<td>$name_usr</td>";
            $data_pdf .= "<td>$email</td>";
            $data_pdf .= "<td style='color: $color;'>$name_sit</td>";
            $data_pdf .= "</tbody>";
        }
        $data_pdf .= "</table>";

        //echo $data_pdf;

        $generatePdf= new \App\cpms\Models\helper\CpmsGeneratePdf();
        $generatePdf->generatePdf($data_pdf);

        $this->result = true;
    }
}
