<div class="container">
  <div class="row right">
  <span id="infodata">No. <b>{{ $memberview->firstItem() }}</b> - <b>{{ $memberview->lastItem() }}</b> | Total <b>{{ $memberview->total() }}</b> data</span>
  </div>
</div>

<div class="row">
  <div class="col s12" style="overflow: auto;">

  <table class="responsive-table highlight">
    <thead>
      <tr>
          <th>Nama Member</th>
          <th>Nama Lengkap</th>
          <th>Kategori</th>
          <th>Waktu Daftar</th>
          <th>Exp</th>
          <th></th>
          <th></th>
      </tr>
    </thead>

    <tbody id="transdata">
      @foreach ($memberview as $member)
      <tr id="data">
        <td>{{ $member->namamember }}</td>
        <td>{{ $member->namalengkap }}</td>
        <td>{{ $member->katmember }}</td>
        <td id="created">{{ $member->created_at }}</td>
        <td id="exp">{{ $member->expired_date }}</td>
        <td><a href="/datamember/{{ $member->idmember }}/detail" class="btn waves-effect waves-teal btn-flat">Edit</a></td>
        <td><a data-target="modal{{ $member->idmember }}" id="modalalert" class="btn modal-trigger waves-effect waves-teal btn-flat">Hapus</a></td>

      </tr>

      <!-- Modal Structure -->
        <div id="modal{{ $member->idmember }}" class="modal">
          <div class="modal-content">

            <p>Apakah anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
            <a href="/datamember/{{ $member->idmember }}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
          </div>
        </div>
      @endforeach
    </tbody>
  </table>
</div>
</div>
<div class="container">
  <div class="row">
  {{ $memberview->links('vendor.pagination.materializecss') }}

  </div>

</div>
