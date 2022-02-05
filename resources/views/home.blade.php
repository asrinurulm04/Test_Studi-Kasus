@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-4">
			<a href="{{route('pesan')}}">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Pesan Obat</span>
          <h5>Pesan Obat</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
        </div>
      </div>
			</a>
    </div>
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Transaksi Berjalan (Draf)</span>
          <h5>Transaksi Berjalan (Draf)</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Transaksi Selesai</span>
          <h5>Transaksi Selesai</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
