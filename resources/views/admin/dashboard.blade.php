@extends('template/t_admin')
@section('title', 'Dashboard')

@section('container')

<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url('account/images/bg-02.jpg'); background-size: cover; background-position: center;">

    <span class="mask bg-gradient-default opacity-7"></span>
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col col-md-10">
                @if ($role == 0)
                <h1 class="display-2 text-white mb-5" style="font-size: 50px">SELAMAT DATANG ADMIN</h1>
                @endif
            </div>
        </div>
    </div>

</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                
                <div class="card-header border-0">
                    <h1 class="mb-0">Tata Cara bla bla bla</h1>
                </div>
                
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <div class="media-body p-4">
                            <span class="name mb-0 text-sm" style="text-align: justify;">

                            </span>
                        </div>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection