<div class="container">
  <div class="row right">
  <span id="infodata">No. <b>{{ $datadagang->firstItem() }}</b> - <b>{{ $datadagang->lastItem() }}</b> | Total <b>{{ $datadagang->total() }}</b> data</span>
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
      @foreach ($datadagang as $dagang)
      <tr id="data">
        <td>{{ $dagang->namabarang }}</td>
        <td>Rp. {{ number_format($barang->harga) }}</td>
        <td id="stok">{{ $barang->stok }}</td>
        <td id="created">{{ $barang->namauser }}</td>
        <td>{{ $barang->updated_at }}</td>
        <td><a href="/databarang/id{{ $barang->id }}/edit" class="btn waves-effect waves-teal btn-flat">Edit</a></td>
        <td><a data-target="modal{{ $barang->id }}" id="modalalert" class="btn modal-trigger waves-effect waves-teal btn-flat">Hapus</a></td>

      </tr>

      <!-- Modal Structure -->
        <div id="modal{{ $barang->id }}" class="modal">
          <div class="modal-content">

            <p>Apakah anda yakin ingin menghapus data <b>{{ $barang->namabarang }}</b>?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="/databarang/id{{ $barang->id }}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
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
