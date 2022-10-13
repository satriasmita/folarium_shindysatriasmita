@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page header section  -->
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <h1>Hei ! Selamat Datang {{Auth::user()->name}}</h1>
            </div>

        </div>
    </div>
</div>
@endsection