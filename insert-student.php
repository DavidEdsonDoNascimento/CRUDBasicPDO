<?php include_once 'header.php'; ?>
<?php if(!empty($_GET['error'])):?>
<p class="alert-warning">Erro na tentativa de salvar estudante.</p>
<?php endif;?>

<form action="src/Service/insert-student.php" method="post">
    <div class="row">
        <div class="col-sm-6">
            <label for="name">Nome: </label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="col-sm-6">
            <label for="name">Data de Nascimento: </label>
            <input type="text" name="birth_date" id="birth_date" class="form-control">
        </div>
    </div>
    <input type="submit" class="btn btn-primary mt-3" value="Gravar">
</form>

<?php include_once 'footer.php'; ?>