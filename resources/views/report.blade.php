
<style>
@media (min-width: 992px) {
  .container {
    max-width: 960px;
  }
}

.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.text-center {
  text-align: center !important;
}
</style>

<div class="container">
  <div class="row">
    <div >
      <div class="ibox ">
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
                    <th>Obat</th>
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
                    <td>{{$tr->kodeObat->obatalkes_nama}}</td>
                    @elseif($tr->type=='racik')
                    <td>{{$tr->nama_racikan}}
                    </td>
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
                <tr><th class=""> </th> <td>Terimakasih Atas Kunjungan Anda! Semoga Lekas Sembuh :)</td></tr>
              </table>
            </div>
          </div><br>
        </div>
      </div>
    </div>
  </div>
</div>