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

<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-title">
        <h3><li class="fa fa-edit"></li> Form Pembelian Obat</h3>
      </div>
      <form class="form-horizontal form-label-left" method="POST" action="{{ route('addObat') }}">
      <div class="ibox-content">
        <div class="form-group  row">
          <label class="col-sm-2 col-form-label">Nama Penginput</label>
          <div class="col-sm-9">
            <input type="text" id="date" value="{{ Auth::user()->name }}" name="date" class="form-control" readonly>
          </div>
        </div>
        <div class="form-group  row">
          <?php $date = Date('j-F-Y'); ?>
          <label class="col-sm-2 col-form-label">Tanggal Pembelian</label>
          <div class="col-sm-9">
            <input type="text" id="date" value="{{ $date }}" name="date" class="form-control" readonly>
          </div>
        </div>
        <input type="hidden" value="{{$kode}}" name="kode" id="kode">
        <div class="form-group  row">
          <label class="col-sm-2 col-form-label">Type Obat</label>
          <div class="col-sm-9">
            <input type="radio" name="data" oninput="plus()" id="radio_plus"> Obat Non Racikan
            <input type="radio" name="data" oninput="minus()" id="radio_minus"> Obat Racikan
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label"></label>
          <div class="col-sm-9"id="obat"></div>
        </div>
        <div class="x_panel">
          <center><div class="card-block col-md-12 col-sm-offset-5 col-md-offset-5">
            <a href="{{route('batalkanOrder',$kode)}}" onclick="return confirm('Yakin Kembali dan membatalkan orderan??')" class="btn btn-danger btn-sm"><li class="fa fa-times"></li> Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm"><li class="fa fa-check"></li> Submit</button>
            {{ csrf_field() }}
          </div>
        </div></center>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">
      <div class="ibox-title">
        <h3><li class="fa fa-edit"></li> Detail Order Obat (Draf)</h3>
      </div>
      <div class="ibox-content">
        <table id="example" class="table table-bordered">
          <thead>
            <tr style="font-weight: bold;" class="text-center">
              <th>#</th>
              <th>Kode Obat</th>
              <th>Nama Obat</th>
              <th>Nama Racikan</th>
              <th>Ketentuan Obat</th>
              <th>Jumlah Order</th>
              <th></th>
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
              <td class="text-center"><a href="{{route('destroy',$tr->id_transaksi)}}" class="btn btn-danger btn-sm" type="button"><li class="fa fa-trash"></li></a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="ibox ">
      <a href="{{route('selesaikanOrder',$kode)}}" class="btn btn-primary btn-block" onclick="return confirm('Yakin Dengan Orderan Anda??')"><li class="fa fa-shopping-cart"></li> Selesaikan Orderan</a>
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
<script>
  // Informasi Obat
  var idObat = []
  <?php foreach($obat as $key => $value) { ?>
     if(!idObat){
      idObat += [ { '<?php echo $key; ?>' : '<?php echo $value->obatalkes_id; ?>', } ];
    } else { idObat.push({ '<?php echo $key; ?>' : '<?php echo $value->obatalkes_id; ?>', }) }
  <?php } ?>

  var obat = []
  <?php foreach($obat as $key => $value) { ?>
    if(!obat){
      obat += [ { '<?php echo $key; ?>' : '<?php echo $value->obatalkes_nama; ?>', } ];
    } else { obat.push({ '<?php echo $key; ?>' : '<?php echo $value->obatalkes_nama; ?>', }) }
  <?php } ?>

  var pilih = '';
    for(var i = 0; i < Object.keys(obat).length; i++){
    pilih += '<option value="'+idObat[i][i]+'">'+obat[i][i]+'</option>';
  }
  // Informasi Obat 2
  var idObat1 = []
  <?php foreach($obat1 as $key => $value) { ?>
     if(!idObat1){
      idObat1 += [ { '<?php echo $key; ?>' : '<?php echo $value->obatalkes_id; ?>', } ];
    } else { idObat1.push({ '<?php echo $key; ?>' : '<?php echo $value->obatalkes_id; ?>', }) }
  <?php } ?>

  var obat1 = []
  <?php foreach($obat1 as $key => $value) { ?>
    if(!obat1){
      obat1 += [ { '<?php echo $key; ?>' : '<?php echo $value->obatalkes_nama; ?>', } ];
    } else { obat1.push({ '<?php echo $key; ?>' : '<?php echo $value->obatalkes_nama; ?>', }) }
  <?php } ?>

  var pilih2 = '';
    for(var i = 0; i < Object.keys(obat1).length; i++){
    pilih2 += '<option value="'+idObat1[i][i]+'">'+obat1[i][i]+'</option>';
  }
  // Informasi Signa
  var idSigna = []
  <?php foreach($signa as $key => $value) { ?>
     if(!idSigna){
      idSigna += [ { '<?php echo $key; ?>' : '<?php echo $value->signa_id; ?>', } ];
    } else { idSigna.push({ '<?php echo $key; ?>' : '<?php echo $value->signa_id; ?>', }) }
  <?php } ?>

  var signa = []
  <?php foreach($signa as $key => $value) { ?>
    if(!signa){
      signa += [ { '<?php echo $key; ?>' : '<?php echo $value->signa_nama; ?>', } ];
    } else { signa.push({ '<?php echo $key; ?>' : '<?php echo $value->signa_nama; ?>', }) }
  <?php } ?>

  var pilih1 = '';
    for(var i = 0; i < Object.keys(signa).length; i++){
    pilih1 += '<option value="'+idSigna[i][i]+'">'+signa[i][i]+'</option>';
  }
    
  function plus(){
    var plus = document.getElementById('radio_plus')
    if(plus.checked == true){
      document.getElementById('obat').innerHTML =
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Pilih Obat</label>'+
          '<input type="hidden" class="form-control" value="original" name="type" id="type" readonly>'+
          '<div class="col-sm-4">'+
            '<select name="pilih_obat" required class="form-control" id="pilih_obat">'+
              '<option value="">'+pilih+'</option>'+
            '</select>'+
          '</div>'+
          '<label class="col-sm-1 col-form-label">Stok Obat</label>'+
          '<div class="col-sm-4" id="stok_obat">'+
            '<input type="number" class="form-control" name="stok_obat" id="stok_obat" readonly>'+
          '</div>'+
        '</div>'+
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Ketentuan Obat (Signa)</label>'+
          '<div class="col-sm-9">'+
            '<select name="signa" required class="form-control" id="signa">'+
              '<option value="">'+pilih1+'</option>'+
            '</select>'+
          '</div>'+
        '</div>'+
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Jumlah Obat</label>'+
          '<div class="col-sm-9" id="jumlah">'+
          '</div>'+
          '<label style="color:red"><small> Catatan * : Jumlah Obat yang di order tidak bisa lebih dari stok tersedia</small></label>'+
        '</div>'

        $('#pilih_obat').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
                url: '{{URL::to('stok')}}/'+myId,
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },

            success:function(data){
                $('#stok_obat').empty();
                $.each(data, function(key, value){
                  $('#stok_obat').append('<input type="number" value="'+ value +'" class="form-control" name="stok" id="stok" readonly>');
                });
                $('#jumlah').empty();
                $.each(data, function(key, value){
                  $('#jumlah').append('<input type="number" class="form-control" name="jumlah_obat" max="'+ value +'" min="1" id="jumlah_obat" required>');
                });
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
            }
          });
          }else{
            $('#stok_obat').empty();
          }
        });
    }
  }

  function minus(){
    var minus = document.getElementById('radio_minus')
    if(minus.checked == true){
      document.getElementById('obat').innerHTML =
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Nama Racikan Obat</label>'+
          '<div class="col-sm-9">'+
            '<input type="text" class="form-control" required name="nama" id="nama">'+
            '<input type="hidden" class="form-control" value="racik" name="type" id="type" readonly>'+
          '</div>'+
        '</div>'+
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Ketentuan Obat (Signa)</label>'+
          '<div class="col-sm-9">'+
            '<select name="signa" required class="form-control" id="signa">'+
              '<option value="">->Select One<-</option>'+
              '<option value="">'+pilih1+'</option>'+
            '</select>'+
          '</div>'+
        '</div>'+
        '<div class="form-group  row">'+
          '<label class="col-sm-2 col-form-label">Jumlah Order Obat</label>'+
          '<div class="col-sm-9">'+
            '<input type="number" class="form-control" min="1" name="jumlah_obat" id="jumlah_obat">'+
            '<label style="color:red"><small> Catatan * : Jika Jumlah Obat Racikan yang diorder adalah 1 maka jumlah obat dari masing-masing racikan akan di x1, jika jumlah order obat racikan 2 maka jumlah obat yang digunakan dari masing-masing racikan akan x2, dst</small></label>'+
          '</div>'+
        '</div>'+
        '<div class="form-group  row">'+
          '<table id="example" class="table table-bordered" id="table">'+
            '<thead>'+
              '<tr style="font-weight: bold;" class="text-center">'+
                '<th>Nama Obat</th>'+
                '<th>Stok Tersedia</th>'+
                '<th>Jumlah</th>'+
                '<th></th>'+
              '</tr>'+
            '</thead>'+
            '<tbody>'+
              '<tr id="addr1">'+
                '<td>'+
                  '<select name="pilih_obat[]" class="form-control" id="pilih_obat">'+
                    '<option value="">->Select One<-</option>'+
                    '<option value="">'+pilih2+'</option>'+
                  '</select>'+
                '</td>'+
                '<td id="stok_obat"></td>'+
                '<td id="jumlah"></td>'+
                '<td><button class="tr_clone_add btn btn-info btn-sm" id="add_row" type="button"><li class="fa fa-plus"></li></button></td>'+
              '</tr>'+
              '<tr id="addr2"></tr>'+
            '</tbody>'+
          '</table>'+
        '</div>'
 

        var i = 2;
        $("#add_row").click(function() {
          $('#addr' + i).html("</select></td><td><select name='pilih_obat[]' class='form-control items' id='pilih_obat"+i+"'>"+
            '<option value="">->Select One<-</option>'+pilih2+
            "</select></td><td id='stok_obat"+i+"'></td><td id='jumlah"+i+"'>"+
            "<td></td>");

            var b = i;
            console.log
            $('#pilih_obat' + b).on('change', function(){
              var myId = $(this).val();
                if(myId){
                  $.ajax({
                    url: '{{URL::to('stok')}}/'+myId,
                    type: "GET",
                    dataType: "json",
                    beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data){
                  $('#stok_obat' + b).empty();
                  $.each(data, function(key, value){
                    $('#stok_obat' + b).append('<input type="number" value="'+ value +'" class="form-control" name="stok" id="stok" readonly>');
                  });
                  $('#jumlah' + b).empty();
                  $.each(data, function(key, value){
                    $('#jumlah' + b).append('<input type="number" class="form-control" max="'+ value +'" value="1" readonly required>');
                  });
                },
                complete: function(){
                  $('#loader').css("visibility","hidden");
              }
            });
            }else{
              $('#stok_obat' + b).empty();
            }
          });

          $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
          i++;
        });

        
        $('#pilih_obat').on('change', function(){
          var myId = $(this).val();
            if(myId){
              $.ajax({
                url: '{{URL::to('stok')}}/'+myId,
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                $('#loader').css("visibility", "visible");
            },

            success:function(data){
                $('#stok_obat').empty();
                $.each(data, function(key, value){
                  $('#stok_obat').append('<input type="number" value="'+ value +'" class="form-control" name="stok" id="stok" readonly>');
                });
                $('#jumlah').empty();
                $.each(data, function(key, value){
                  $('#jumlah').append('<input type="number" class="form-control" max="'+ value +'" value="1" readonly required>');
                });
              },
              complete: function(){
                $('#loader').css("visibility","hidden");
            }
          });
          }else{
            $('#stok_obat').empty();
          }
        });

      }
     
  }

</script>
@endsection