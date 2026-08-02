@extends('admin.layouts.app')

@section('title', 'Jenis Perguruan Tinggi')

@section('content')
<!-- Title -->
<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Jenis Perguruan Tinggi</h5>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            <li class="active"><span>Jenis Perguruan Tinggi</span></li>
        </ol>
    </div>
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Jenis Perguruan Tinggi</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jenis Perguruan Tinggi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jenisPts as $index => $jenisPt)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jenisPt->nama_jenis_pt }}</td>
                                            <td>{{ $jenisPt->status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        </tr>
                                    @endforeach
                                    @if($jenisPts->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
