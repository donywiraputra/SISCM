<div class="container">
  <div class="row right">
  <span id="infodata">No. <b>{{ $databarang->firstItem() }}</b> - <b>{{ $databarang->lastItem() }}</b> | Total <b>{{ $databarang->total() }}</b> data</span>
  </div>
</div>

<div class="row">
  <div class="col s12" style="overflow: auto;">

  <table class="responsive-table highlight">
    <thead>
      <tr>
          <th>Nama barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>User</th>
          <th>Waktu input</th>
          <th></th>
          <th></th>
      </tr>
    </thead>

    <tbody id="transdata">
      @foreach ($databarang as $barang)
      <tr id="data">
        <td>{{ $barang->namabarang }}</td>
        <td>Rp. {{ number_format($barang->harga, 2) }}</td>
        <td>{{ $barang->stok }}</td>
        <td id="created">{{ $barang->namauser }}</td>
        <td id="exp">{{ $barang->created_at }}</td>
        <td><a href="#!" class="btn waves-effect waves-teal btn-flat">Edit</a></td>
        <td><a data-target="modal" id="modalalert" class="btn modal-trigger waves-effect waves-teal btn-flat">Hapus</a></td>

      </tr>

      <!-- Modal Structure -->
        <div id="modal" class="modal">
          <div class="modal-content">

            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ya</a>
          </div>
        </div>
      @endforeach
    </tbody>
  </table>
</div>
</div>
<div class="container">
  <div class="row">
  {{ $databarang->links('vendor.pagination.materializecss') }}

  </div>

</div>
