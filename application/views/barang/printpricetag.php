<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $barang->barang_nama;?></title>
    <style media="screen">

      body {
        width: 100%;
        font-size: 12px;
        margin: 40px;
      }

      .center,
      td.center
      {
        text-align: center;
        min-height: 200px;
      }

      td {
        height: 100px!important;
      }

      .price
      {
        font-size: 40px;
      }

      @media print{
        body {
          /*width: 100%;*/
          font-size: 12px!important;
          margin: 40px;
        }

        tr, td {
          text-align: center;
        }
        td {
          height: 100px;
        }


      }

    </style>
  </head>
  <body  onload=print()>
    <table width="100%">
      <?php
      $col = 1;
      echo "<tr>";
      // for ($i=0; $i < 3; $i++) {
        for ($j=0; $j < 10; $j++) {
          if ($col<4) {
            echo "
            <td style='text-align: center;font-size: 12px;'>
            $barang->barang_nama
              <table style='width: 100%;'>
                <tr>
                  <td>
                    Rp.
                  </td>
                </tr>
                <tr style='background-color: #f6ff47;'>
                  <td style='font-size: 30px;' colspan='2'>
                  <b>$barang->harga_jual_pajak</b>
                  </td>
                </tr>
                <tr>
                  <td>
                  $barang->barang_kode
                  </td>
                  <td>
                  $barang->barang_nomor
                  </td>
                <tr>
                <tr>
                <td></td>
                <td>$tanggal</td>
                </tr>
              </table>
              </td>";
          } else {
            echo "</tr>";
            echo "<tr>";
            $col = 0;
          }

          $col++;
        // }
      } ?>
    </table>
  </body>
</html>
