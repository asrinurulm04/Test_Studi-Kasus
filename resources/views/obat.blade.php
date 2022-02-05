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
    <div class="col-lg-12">
      <div class="ibox ">
        <a href="{{route('dasboard')}}" class="btn btn-danger btn-block"><li class="fa fa-times"></li> Kembali</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox ">
        <div class="ibox-title">
          <h3><li class="fa fa-list"></li> List Obat</h3>
        </div>
        <div class="ibox-content">
          <table id="example" class="table table-bordered">
            <thead>
              <tr style="font-weight: bold;" class="text-center">
                <th>#</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Stok</th>
                <th></th>
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
                <td class="text-center"><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit{{$obat->	obatalkes_id }}" type="button"><li class="fa fa-edit"></li><b></b></button></td>
              </tr>
              
              <!-- Edit Stok -->
              <div class="modal" id="edit{{$obat->obatalkes_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title" id="exampleModalLabel">Edit Stok
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> </h3>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal form-label-left" method="POST" action="{{route('editStok',$obat->obatalkes_id)}}">
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Nama Obat</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" value="{{$obat->obatalkes_nama}}" name="nama" id="nama">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label text-bold col-md-3 col-sm-3 col-xs-12">Stok</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="number" class="form-control" value="{{$obat->stok}}" name="stok" id="stok" required>
                        </div>
                      </div><br>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
                        {{ csrf_field() }}
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Selesai -->
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('s')
<script>
	$(document).ready(function() {
    $('#example').DataTable();
  } );
</script>
@endsection