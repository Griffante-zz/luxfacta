@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-gift fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        @inject('produto', 'App\Produto')
                        <div class="huge">{{ count($produto::where('estoque', '>', 0)->get()) }}</div>
                        <div>produtos disponíveis</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('produtos') }}">
                <div class="panel-footer">
                    <span class="pull-left">Ver detalhes</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection
