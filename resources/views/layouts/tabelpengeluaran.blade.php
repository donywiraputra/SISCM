<div class="container">
  <div class="row right">
    <div class="row">
      <a href="catatpengeluaran" style="border: 1px solid #e0e0e0;" class="btn waves-effect waves-teal btn-flat right">Catat pengeluaran</a>
    </div>
  <span class="right" id="infodata">No. <b>{{ $pengeluaran->firstItem() }}</b> - <b>{{ $pengeluaran->lastItem() }}</b> | Total <b>{{ $pengeluaran->total() }}</b> data</span>
  </div>
</div>

<div class="row">
  <div class="col s12">

  <table class="responsive-table highlight">
    <thead>
      <tr>
          <th>Keterangan</th>
          <th>Jumlah</th>
          <th>User</th>
          <th>Waktu</th>
          <th></th>
          <th></th>
      </tr>
    </thead>

    <tbody id="transdata">
      @foreach ($pengeluaran as $data)
      <tr>
        <td>{{ $data->keterangan }}</td>
        <td>Rp. {{ number_format($data->jumlah) }}</td>
        <td>{{ $data->namauser }}</td>
        <td>{{ $data->created_at }}</td>
        <td><a href="/pengeluaran/{{ $data->id }}/edit" class="btn waves-effect waves-light btn-small grey darken-2">Edit</a></td>
        <td><a data-target="modal{{ $data->id }}" id="modalalert" class="modal-trigger btn waves-effect waves-light btn-small grey darken-2">Hapus</a></td>

      </tr>
      <!-- Modal Structure -->
        <div id="modal{{ $data->id }}" class="modal">
          <div class="modal-content">
            <p>Apakah anda yakin ingin menghapus data <b>{{ $data->keterangan }}</b>?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="/pengeluaran/{{ $data->id }}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
          </div>
        </div>

      @endforeach
    </tbody>
  </table>
</div>
</div>
<div class="container">
  <div class="row">
  {{ $pengeluaran->links('vendor.pagination.materializecss') }}

  </div>

</div>
