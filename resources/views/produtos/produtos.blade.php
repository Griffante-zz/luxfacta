@extends('layouts.master')

@section('title', 'Produtos')

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
            <li class="active">
                Produtos
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
        <a class="btn btn-primary" href="{{url('produtos/criar')}}" role="button">Criar novo</a>
    </div>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <form class="form-inline">
                <div class="form-group">
                    <label for="exampleInputName2">Disponibilidade</label>
                    <select class="form-control" data-bind="options: options, selectedOptions: currentFilter"></select>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th><a href="#" data-bind="click: sortByNome">Nome <i class="fa fa-chevron-up" data-bind="visible: showNomeUp"></i><i class="fa fa-chevron-down" data-bind="visible: showNomeDown"></i></a></th>
                    <th class="text-right"><a href="#" data-bind="click: sortByPreco">Preço (R$) <i class="fa fa-chevron-up" data-bind="visible: showPrecoUp"></i><i class="fa fa-chevron-down" data-bind="visible: showPrecoDown"></i></a></th>
                    <th class="text-right"><a href="#" data-bind="click: sortByEstoque">Estoque <i class="fa fa-chevron-up" data-bind="visible: showEstoqueUp"></i><i class="fa fa-chevron-down" data-bind="visible: showEstoqueDown"></i></a></th>
                    <th></th>
                </tr>
            </thead>

            <tbody data-bind="foreach: filterProducts">
                <tr>
                    <td data-bind="text: nome"></td>
                    <td class="text-right" data-bind="text: formatCurrency(preco)"></td>
                    <td class="text-right" data-bind="text: estoque"></td>
                    <td class="text-center">
                        <div class="btn-group hidden-xs" role="group" aria-label="...">
                            <button type="button" class="btn btn-default" data-bind="click: $parent.decrementa"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-default" data-bind="click: $parent.incrementa"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="btn-group-vertical visible-xs" role="group" aria-label="...">
                            <button type="button" class="btn btn-default" data-bind="click: $parent.incrementa"><i class="fa fa-plus"></i></button>
                            <button type="button" class="btn btn-default" data-bind="click: $parent.decrementa"><i class="fa fa-minus"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</div>

<script type="text/javascript">
    jQuery.each(["put", "delete"], function (i, method) {
        jQuery[ method ] = function (url, data, callback, type) {
            if (jQuery.isFunction(data)) {
                type = type || callback;
                callback = data;
                data = undefined;
            }

            return jQuery.ajax({
                url: url,
                type: method,
                dataType: type,
                data: data,
                success: callback
            });
        };
    });
</script>

<script type="text/javascript">

    function formatCurrency(value) {
        var tmp = value+'';
        tmp = tmp.replace(".", "");
        tmp = tmp.replace(",", "");
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
    }
    
    var ViewModel = function (items) {
        var self = this;
        
        this.showNomeUp = ko.observable(false);
        this.showNomeDown = ko.observable(true);
        this.showPrecoUp = ko.observable(false);
        this.showPrecoDown = ko.observable(false);
        this.showEstoqueUp = ko.observable(false);
        this.showEstoqueDown = ko.observable(false);
        
        this.options = ko.observableArray(['Selecionar...', 'Disponível', 'Indisponível']);
        
        this.currentFilter = ko.observable();
        
        this.produtos = function (items) {
            ko.utils.arrayForEach( items, function(item)
            {
                item.estoque = ko.observable(item.estoque);
            });
            
            
            return items;
        };

        this.items = ko.observableArray(this.produtos(items));
        
        this.filterProducts = ko.computed(function() {
            var cfilter = self.currentFilter();
            
            if(!cfilter) {
                return self.items(); 
            } else {
                
                return ko.utils.arrayFilter(self.items(), function(prod) {
                    if (cfilter[0] === 'Disponível') {
                        return prod.estoque() > 0;
                    }
                    else if (cfilter[0] === 'Indisponível') {
                        return prod.estoque() == 0;
                    }
                    else {
                        return self.items(); 
                    }
                });
            }
        });

        this.sortByNome = function () {
            if (this.showNomeDown()) {
                this.hideAll();
                this.showNomeUp(true);

                this.items.sort(function (a, b) {
                    return a.nome > b.nome ? -1 : 1;
                });
            } else {
                this.hideAll();
                this.showNomeDown(true);

                this.items.sort(function (a, b) {
                    return a.nome < b.nome ? -1 : 1;
                });
            }
        };

        this.sortByPreco = function () {
            if (this.showPrecoDown()) {
                this.hideAll();
                this.showPrecoUp(true);
                
                this.items.sort(function (a, b) {
                    return parseFloat(a.preco) > parseFloat(b.preco) ? -1 : 1;
                });
            }
            else {
                this.hideAll();
                this.showPrecoDown(true);
                
                this.items.sort(function (a, b) {
                    return parseFloat(a.preco) < parseFloat(b.preco) ? -1 : 1;
                });
            }
            
        };

        this.sortByEstoque = function () {
            if (this.showEstoqueDown()) {
                this.hideAll();
                this.showEstoqueUp(true);
                
                this.items.sort(function (a, b) {
                    return a.estoque() > b.estoque() ? -1 : 1;
                });
            }
            else {
                this.hideAll();
                this.showEstoqueDown(true);
                
                this.items.sort(function (a, b) {
                    return a.estoque() < b.estoque() ? -1 : 1;
                });
            }
            
        };
        
        this.hideAll = function() {
            this.showNomeUp(false);
            this.showNomeDown(false);
            this.showPrecoUp(false);
            this.showPrecoDown(false);
            this.showEstoqueUp(false);
            this.showEstoqueDown(false);
        };
                
        this.incrementa = function (produto) {
            var estoque = produto.estoque();
            estoque++;
            
            self.updateEstoque(produto.id, estoque);
            
            produto.estoque(estoque);
            
        };
        
        this.decrementa = function (produto) {
            if (produto.estoque() === 0) {
                return false;
            }
            
            var estoque = produto.estoque();
            estoque--;
            
            self.updateEstoque(produto.id, estoque);
            
            produto.estoque(estoque);
        };
        
        this.updateEstoque = function (id, estoque) {
            $.put("api/produtos/"+id, {estoque: estoque}, function (response) {
//                console.log(response);
            });
        };
        
        
    };



    $.getJSON("{{ url('api/produtos') }}", function (data) {
        ko.applyBindings(new ViewModel(data));
    });


</script>


@endsection
