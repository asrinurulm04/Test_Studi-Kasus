@extends('layouts.app')
@section('content')

@if(session('status'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('status') }}
  </div>
</div>
@elseif(session('error'))
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('error') }}
  </div>
</div>
@endif

<div class="container">
  <div class="row">
    <div class="col-lg-6">
			<a href="{{route('pesan',$kode)}}">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Pesan Obat</span>
          <h5>Pesan Obat</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins"><li class="fa fa-cart-plus"></li> Order Baru</h1>
          <div class="stat-percent font-bold text-success"><i class="fa fa-cart-plus"></i></div>
          <small>Membuat orderan baru</small>
        </div>
      </div>
			</a>
    </div>
    <div class="col-lg-6">
      <a href="{{route('dasboard')}}">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Transaksi Selesai</span>
          <h5>Transaksi Selesai</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins">{{$jumlah}} Transaksi</h1>
          <div class="stat-percent font-bold text-success"><i class="fa fa-shopping-basket"></i></div>
          <small>Total transaksi selesai</small>
        </div>
      </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-7">
      <div class="ibox ">
        <div class="ibox-title">
          <h3><li class="fa fa-edit"></li> Paling Sering Di Order</h3>
        </div>
        <div class="ibox-content" style="min-height:365px">
          <table class="table table-bordered">
            <thead>
              <tr style="font-weight: bold;" class="text-center">
                <th>#</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th>Jumlah Terjual/pcs</th>
              </tr>
            </thead>
            <tbody>
              @php $nom = 0; @endphp
              @foreach($obat as $obat)
              @php ++$nom; @endphp
              <tr>
                <td>{{$nom}}</td>
                <td>{{$obat->obatalkes_kode}}</td>
                <td>{{$obat->obatalkes_nama}}</td>
                <td>{{$obat->stok}}</td>
                <td class="text-center">{{$obat->jumlah_terjual}} Obat</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="ibox ">
        <div class="ibox-title">
          <h3><li class="fa fa-list"></li> List Stok Obat Kosong</h3>
        </div>
        <div class="ibox-content" style="min-height:200px;max-height:200px">
          <table id="example" class="table table-bordered">
            <thead>
              <tr style="font-weight: bold;" class="text-center">
                <th>#</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 0; @endphp
              @foreach($kosong as $kosong)
              @php ++$no; @endphp
              <tr>
                <td>{{$no}}</td>
                <td>{{$kosong->obatalkes_kode}}</td>
                <td>{{$kosong->obatalkes_nama}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <a href="{{route('obat')}}">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">Database Obat</span>
          <h5>Database Obat</h5>
        </div>
        <div class="ibox-content">
          <h1 class="no-margins"><li class="fa fa-database"></li> {{$jumlahObat}}</h1>
          <small>Total Obat</small>
        </div>
      </div>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
          <span class="label label-success float-right">@2022 Februari Asrinurulm</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
