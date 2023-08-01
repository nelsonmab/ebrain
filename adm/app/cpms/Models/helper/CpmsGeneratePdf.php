<?php

namespace App\cpms\Models\helper;

use Dompdf\Dompdf;

if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para gerar PDF
 *
 * @author Nelson Oliveira de Almeida (007.277.322.77) nelsonoliveirank@gmail.com>
 */
class CpmsGeneratePdf
{
    /** @var string|null $data Receber as informações para o PDF */
    private string|null $data;

    /**
     * Metodo recebe o conteúdo para o PDF
     * @param string|null $data
     * @return void
     */
    public function generatePdf(string|null $data): void
    {
        $dompdf = new Dompdf();

        $dompdf->loadHtml($data);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream();
    }
}
