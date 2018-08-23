<div class="container">
  <div class="row right">
  <span id="infodata">No. <b>{{ $transview->firstItem() }}</b> - <b>{{ $transview->lastItem() }}</b> | Total <b>{{ $transview->total() }}</b> data</span>
  </div>
</div>

<div class="row">
  <div class="col s12">

  <table class="responsive-table highlight">
    <thead>
      <tr>
          <th>Nama Transaksi</th>
          <th>Biaya Transaksi</th>
          <th>Nama Member</th>
          <th>User</th>
          <th>Waktu Transaksi</th>
          <th></th>
          <th></th>
      </tr>
    </thead>

    <tbody id="transdata">
      @foreach ($transview as $transaksi)
      <tr>
        <td>{{ $transaksi->namatransaksi }}</td>
        <td>Rp. {{ number_format($transaksi->biaya) }}</td>
        <td>{{ $transaksi->namamember }}</td>
        <td>{{ $transaksi->namauser }}</td>
        <td>{{ $transaksi->created_at }}</td>
        <td><a href="datatransaksi/id{{ $transaksi->idtransaksi }}/edit" class="btn waves-effect waves-light btn-small grey darken-2">Edit</a></td>
        <td><a data-target="modal{{ $transaksi->idtransaksi }}" id="modalalert" class="btn waves-effect waves-light btn-small grey darken-2">Hapus</a></td>

      </tr>
      <!-- Modal Structure -->
        <div id="modal{{ $transaksi->idtransaksi }}" class="modal">
          <div class="modal-content">
            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="/datatransaksi/id{{$transaksi->idtransaksi}}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
          </div>
        </div>

      @endforeach
    </tbody>
  </table>
</div>
</div>
<div class="container">
  <div class="row">
  {{ $transview->links('vendor.pagination.materializecss') }}

  </div>

</div>
