<div class="container">
  <div class="row right">
    <div class="row">
      <a disabled id="deletetrig" style="border: 1px solid #e0e0e0;" data-target="modal2" class="btn modal-trigger waves-effect waves-teal btn-flat right">Hapus semua</a>
    </div>
    <span id="infodata">No. <b>{{ $datadagang->firstItem() }}</b> - <b>{{ $datadagang->lastItem() }}</b> | Total <b id="total">{{ $datadagang->total() }}</b> data</span>
  </div>
</div>

<div id="modal2" class="modal">
  <div class="modal-content">
    <p>Apakah anda yakin ingin menghapus <b>{{ $datadagang->total() }}</b> data?</p>
  </div>
  <div class="modal-footer">
    <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
    <a id="deletebtn" class="modal-close waves-effect waves-green btn-flat">Ya</a>
  </div>
</div>


<div class="row">
  <div class="col s12" style="overflow: auto;">

  <table class="responsive-table highlight">
    <thead>
      <tr>
          <th>Nama barang</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>User</th>
          <th>Waktu input</th>
          <th></th>
      </tr>
    </thead>

    <tbody id="transdata">
      @foreach ($datadagang as $dagang)
      <tr id="data">
        <td>{{ $dagang->namabarang }}</td>
        <td>{{ $dagang->jumlah }}</td>
        <td>Rp. {{ number_format($dagang->biaya) }}</td>
        <td>{{ $dagang->namauser }}</td>
        <td>{{ $dagang->created_at }}</td>
        <td><a data-target="modal{{ $dagang->id }}" id="modalalert" class="btn modal-trigger waves-effect waves-teal btn-flat">Hapus</a></td>
      </tr>

      <!-- Modal Structure -->
        <div id="modal{{ $dagang->id }}" class="modal">
          <div class="modal-content">

            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="/datatransdagang/{{ $dagang->id }}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
          </div>
        </div>
      @endforeach
    </tbody>
  </table>
</div>
</div>
<div class="container">
  <div class="row">
  {{ $datadagang->links('vendor.pagination.materializecss') }}

  </div>

</div>
