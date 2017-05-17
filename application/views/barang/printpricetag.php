<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $barang->barang_nama;?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/custom_theme/css/print.css')?>">
  </head>
  <body  onload=print()>
    <page size="A4">
      <table>
        <?php
        $col = 1;
        echo "<tr>";
        // for ($i=0; $i < 3; $i++) {
        for ($j=0; $j < $printqty; $j++) {
          // echo $j;
          if ($col<4) {
            echo "
            <td class='title'>
            $barang->barang_nama
            <table>
            <tr>
            <td class='rupiah'>
            Rp.
            </td>
            </tr>
            <tr>
            <td class='price' colspan='2'>
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
            <td class='tanggal'>$tanggal</td>
            </tr>
            </table>
            </td>";
          } else {
            echo "</tr>";
            echo "<tr>";
            echo "
            <td class='title'>
            $barang->barang_nama
            <table>
            <tr>
            <td class='rupiah'>
            Rp.
            </td>
            </tr>
            <tr>
            <td class='price' colspan='2'>
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
                <td class='tanggal'>$tanggal</td>
              </tr>
            </table>
          </td>";
          $col = 1;
        }

        $col++;
        // }
      } ?>
    </table>
    </page>
  </body>
</html>
