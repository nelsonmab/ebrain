<?php
if (!defined('E8R4IN')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
  <div class="row">
    <h2>Adicionar novo formulário</h2>
    <form action="processar_formulario.php" method="POST">
      <label for="numero_ipl">Número IPL:</label>
      <input type="text" name="numero_ipl" id="numero_ipl" required>

      <label for="numero_processo">Número do processo:</label>
      <input type="text" name="numero_processo" id="numero_processo" required>

      <label for="tipo_processo">Tipo do processo:</label>
      <input type="text" name="tipo_processo" id="tipo_processo" required>

      <label for="data_rec_pje">Data de recebimento pelo PJE:</label>
      <input type="date" name="data_rec_pje" id="data_rec_pje" required>

      <label for="data_dist_dpc">Data de distribuição no DPC:</label>
      <input type="date" name="data_dist_dpc" id="data_dist_dpc" required>

      <label for="data_lim_pje">Data limite para distribuição pelo PJE:</label>
      <input type="date" name="data_lim_pje" id="data_lim_pje" required>

      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" required>

      <label for="observacoes">Observações:</label>
      <textarea name="observacoes" id="observacoes" rows="5"></textarea>

      <button type="submit">Enviar</button>
    </form>
  </div>
</div>
 
<!-- Fim do conteudo do administrativo -->
