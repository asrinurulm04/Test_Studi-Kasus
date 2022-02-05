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
      <div class="ibox ">
        <a href="{{route('dasboard')}}" class="btn btn-danger btn-block"><li class="fa fa-times"></li> Kembali</a>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="ibox ">
        <a href="{{route('laporan-pdf',$kode)}}" class="btn btn-primary btn-block" ><li class="fa fa-download"></li> Export Excel</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
          <h3><li class="fa fa-edit"></li> Report Transaksi</h3>
        </div>
        <div class="ibox-content">
          <label>Bismillah APOTEK</label>
          <center> <h2 style="font-size: 22px;font-weight: bold;">Report Transaksi</h2> </center>
  				<center> <h2 style="font-size: 20px;font-weight: bold;">( OBAT )</h2> </center>
  				<center> <lable>Jln. Merdeka Jaya 01 - (021) 12345678 </lable> </center><br>
          <div class="row">
            <div class="col-sm-6">
              <table ALIGN="left">
                <tr><th class="text-right">Kode Transaksi</th> <th>: {{$kode}}</th></tr>
              </table>
            </div>
          </div><br>
          
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Nama Racikan</th>
                    <th>Ketentuan</th>
                    <th>Jumlah Order</th>
                  </tr>
                </thead>
                <tbody>
                  @php $nom = 0; @endphp
                  @foreach($transaksi as $tr)
                  @php ++$nom; @endphp
                  <tr>
                    <td class="text-center">{{$nom}}</td>
                    @if($tr->type=='original')
                    <td>{{$tr->kodeObat->obatalkes_kode}}</td>
                    <td>{{$tr->kodeObat->obatalkes_nama}}</td>
                    <td class="text-center"><span class="label label-primary" style="color:white">Bukan Obat Racikan</span></td>
                    @elseif($tr->type=='racik')
                    <td>
                      <table class="table table-bordered">
                        @foreach($racik as $racik)
                        @if($racik->id_transaksi==$tr->id_transaksi)
                        <tr>
                          <td>{{$racik->kodeObat1->obatalkes_kode}}</td>
                        </tr>
                        @endif
                        @endforeach
                      </table>
                    </td>
                    <td>
                      <table class="table table-bordered">
                        @foreach($racik1 as $racik1)
                        @if($racik1->id_transaksi==$tr->id_transaksi)
                        <tr>
                          <td>{{$racik1->kodeObat1->obatalkes_nama}}</td>
                        </tr>
                        @endif
                        @endforeach
                      </table>
                    </td>
                    <td class="text-center">{{$tr->nama_racikan}}</td>
                    @endif
                    <td>{{$tr->signa->signa_nama}}</td>
                    <td class="text-center">{{$tr->jumlah_order}} Obat</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div><br>
          <div class="row">
            <div class="col-sm-6">
              <table ALIGN="left">
                <?php $date = Date('j-F-Y'); ?>
                <tr><th class="">Tanggal </th> <td>: {{$date}}</td></tr>
                <tr><th class="">Operator </th> <td>: Administrasi</td></tr>
              </table>
              <label for="">Terimakasih Atas Kunjungan Anda! Semoga Lekas Sembuh :)</label>
            </div>
          </div><br>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection