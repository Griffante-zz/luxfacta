@extends('layouts.master')

@section('title', 'Produto')

@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Produtos
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
            <li>
                Produtos
            </li>
            <li class="active">
                Criar
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row" style="display: none;">
    <div class="col-lg-12">
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal">
            <div class="form-group" data-bind="css: { 'has-error': nome.isModified() && !nome.isValid(), 'has-success': nome.isModified() && nome.isValid() }" >
                <label for="nome" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  id="nome" placeholder="Nome do produto" data-bind="textInput: nome" required="required" />
                </div>
            </div> 
            <div class="form-group" data-bind="css: { 'has-error': preco.isModified() && !preco.isValid(), 'has-success': preco.isModified() && preco.isValid() }">
                <label for="preco" class="col-sm-2 control-label">Preço</label>
                <div class="col-sm-10">
                    <div class="input-group" >
                        <span class="input-group-addon" id="moeda-real">R$</span>
                        <input type="text" class="form-control validationInput" id="preco" data-thousands="." data-decimal="," placeholder="0,00" aria-describedby="moeda-real" data-bind="textInput: preco" />
                    </div>
                </div>
            </div>
            <div class="form-group" data-bind="css: { 'has-error': estoque.isModified() && !estoque.isValid(), 'has-success': estoque.isModified() && estoque.isValid() }">
                <label for="estoque" class="col-sm-2 control-label">Estoque</label>
                <div class="col-sm-10">
                    <input type="number" min="0" step="1" class="form-control" id="estoque" placeholder="0" data-bind="textInput: estoque" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="{{url('produtos')}}" role="button">Cancelar</a>
                    <button type="button" class="btn btn-primary" data-bind="click: salvar">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    String.prototype.replaceAll = function (search, replacement) {
        var target = this;
        return target.split(search).join(replacement);
    };

    ko.validation.rules.required.message = 'Campo obrigatório';

    var viewModel = {
        nome: ko.observable().extend({required: true}),
        preco: ko.observable().extend({required: true}),
        estoque: ko.observable().extend({required: true}),
        salvar: function () {
            if (viewModel.errors().length === 0) {
                var data = ko.toJS(viewModel);
                data.preco = data.preco.replaceAll('.', '');
                data.preco = data.preco.replaceAll(',', '.');
                $.post("{{ url('api/produtos') }}", JSON.stringify(data), function (returnedData) {
                    window.location = "{{ url('produtos') }}";
                });
            } else {
                viewModel.errors.showAllMessages();
            }
        }
    };

    viewModel.errors = ko.validation.group(viewModel);

    ko.applyBindings(viewModel);

    ko.onError = function (error) {
        alert(error);
    };

    $('#preco').maskMoney();

</script>

@endsection
