<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('layouts/header.php');

// proteção contra acesso direto
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit();
}

$signoEncontrado = null;

$data_nascimento = $_POST['data_nascimento'];

$data = new DateTime($data_nascimento);
$diaMes = $data->format('d/m');

$signos = simplexml_load_file("signos.xml");

foreach ($signos->signo as $signo) {

    $inicio = DateTime::createFromFormat('d/m', (string)$signo->dataInicio);
    $fim = DateTime::createFromFormat('d/m', (string)$signo->dataFim);
    $dataUser = DateTime::createFromFormat('d/m', $diaMes);

    // proteção contra erro silencioso
    if (!$inicio || !$fim || !$dataUser) {
        continue;
    }

    // ajuste para signos que cruzam o ano (Capricórnio)
    if ($inicio > $fim) {
        if ($dataUser >= $inicio || $dataUser <= $fim) {
            $signoEncontrado = $signo;
        }
    } else {
        if ($dataUser >= $inicio && $dataUser <= $fim) {
            $signoEncontrado = $signo;
        }
    }
}
?>

<div class="container mt-5">
  <div class="card p-4 shadow text-center bg-dark text-white">

    <?php if ($signoEncontrado): ?>

      <h2><?php echo $signoEncontrado->signoNome; ?> 🔮</h2>

      <p class="mt-3">
        <?php echo $signoEncontrado->descricao; ?>
      </p>

    <?php else: ?>

      <p>Signo não encontrado.</p>

    <?php endif; ?>

    <a href="index.php" class="btn btn-light mt-3">Voltar</a>

  </div>
</div>

</body>
</html>