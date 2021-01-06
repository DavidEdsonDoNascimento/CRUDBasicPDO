<?php include_once 'header.php'; ?>

<script>
var model = null;

function ViewModel() {
    var self = this;
    self.id = ko.observable(0);
    self.msg = ko.observable('');
    self.student = ko.observable({});    
}

$(document).ready(function(){
    
    model = new ViewModel();
    ko.applyBindings(model);
    
    var id = getParamsUrl().id;
    //var msg = getParamsUrl().error;
    model.id(id);
    model.msg('msg');

    $.ajax({
        url: 'src/Service/search-student.php',
        type: 'GET',
        dataType: 'json',
        data: { id : id },
        success: function(response){
            model.student(response.student);
        },
        error: function(er){
            console.log(er);
        }
    });
});

function getParamsUrl(){
    var query = location.search.slice(1);
    var partes = query.split('&');
    var data = {};
    
    partes.forEach(function (parte) {
        var chaveValor = parte.split('=');
        var chave = chaveValor[0];
        var valor = chaveValor[1];
        data[chave] = valor;
    });
    return data;
}

</script>

<?php if(!empty($_GET['error'])):?>
<p class="alert-danger msg-alert">Erro na tentativa de editar estudante.</p>
<?php endif;?>

<form action="src/Service/update-student.php" method="post">
    <input type="hidden" name="id" id="id" data-bind="value: model.id">
    <div class="row">
        <div class="col-sm-6">
            <label for="name">Nome: </label>
            <input type="text" name="name" id="name" class="form-control" data-bind="textInput: model.student().name">
        </div>
        <div class="col-sm-6">
            <label for="name">Data de Nascimento: </label>
            <input type="text" name="birth_date" id="birth_date" class="form-control" data-bind="value: model.student().birth_date">
        </div>
    </div>
    <input type="submit" class="btn btn-primary mt-3" value="Gravar">
</form>

<?php include_once 'footer.php'; ?>