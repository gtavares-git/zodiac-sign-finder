<?php include('layouts/header.php'); ?>

<div class="container mt-5">

  <h1 class="text-center mb-4">Descubra seu Signo 🔮</h1>

  <div class="card p-4 shadow">

    <form method="POST" action="show_zodiac_sign.php">

      <div class="mb-3">
        <label class="form-label">Data de Nascimento</label>
        <input 
  type="date" 
  name="data_nascimento" 
  class="form-control"
  required
  max="<?php echo date('Y-m-d'); ?>"
>
      </div>

      <button type="submit" class="btn btn-primary w-100">
        Descobrir Signo
      </button>

    </form>

  </div>

</div>

</body>
</html>