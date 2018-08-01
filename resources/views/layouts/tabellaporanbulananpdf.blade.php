
<html>
  <head>
    <title></title>
    <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    </style>
  </head>
  <body>
    <div class="row">
      <h2 style="text-align:center;">Laporan Perbulan</h2>
    <div class="col s12">
      @foreach ($tes as $key => $value)

      <p class="center" style="padding: 5px; background-color: #f5f5f5 ; "><b>{{ $key }}</b></p>
      <table>

            <thead>
              <tr>
                  <th>Keterangan</th>
                  <th>Debit</th>
                  <th>Kredit</th>

              </tr>
            </thead>

            <tbody>
              @foreach ($value as $k => $v)
              <tr>
                <td>{{date('d F Y', strtotime($v['tanggal']))}} <b>|</b> {{ $v['keterangan'] }}</td>
                @if (empty($v['debit']))
                  <td> - </td>
                @else
                  <td>Rp. {{ number_format((float)$v['debit']) }}</td>
                @endif

                @if (empty($v['kredit']))
                  <td> - </td>
                @else
                  <td>Rp. {{ number_format((float)$v['kredit']) }}</td>
                @endif
              </tr>
              @endforeach
              <tr style="background-color: #e0f7fa;">
                <td><b>Jumlah</b></td>
                <td>Rp. {{ number_format((float)array_sum(array_column($value, 'debit'))) }}</td>
                <td>Rp. {{ number_format((float)array_sum(array_column($value, 'kredit'))) }}</td>
              </tr>
              <tr style="background-color: #b9f6ca ;">
                <td><b>Total</b></td>
                <td></td>
                <td>Rp. {{ number_format((float)array_sum(array_column($value, 'debit')) - array_sum(array_column($value, 'kredit'))) }}</td>
              </tr>
            </tbody>

          </table>
          <br>
     @endforeach
    </div>
    </div>
  </body>
</html>
