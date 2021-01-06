<?php include_once 'header.php'; ?>

<script>

var model = null;

function ViewModel() 
{
    var self = this;
    self.students = ko.observableArray([]);
    self.url = ko.observable('update-student.php?id=');
}

$(document).ready(function(){
    model = new ViewModel();
    ko.applyBindings(model);

    $.ajax({
        url: 'src/Service/students.php',
        type: 'GET',
        dataType: 'json',
        success: function(response){
            model.students(response.students);
        },
        error: function(er){
            console.log(er);
        }
    });
});

</script>

<?php
    $msg = isset($_GET['msg'])? $_GET['msg'] : null;
    if(!empty($msg) && $msg == "SUCC_UPDATE"):?>
        <p class="alert-success msg-alert">Registro de estudante atualizado com sucesso!</p>
<?php endif;?>

<table class="table table-bordered table-striped mt-3">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Dt. Nascimento</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody data-bind="foreach: students">
            <td data-bind="text: id"></td>
            <td data-bind="text: name"></td>
            <td data-bind="text: birth_date"></td>
            <td>
                <a data-bind="attr: { href : $root.url() + $data.id }" class="btn btn-warning">Editar</a>
            </td>
    </tbody>
</table>

<?php include_once 'footer.php'; ?>