<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Print Pricetag</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/custom_theme/css/print.css')?>">
  </head>
  <body  onload=print()>
    <?php
    $page = 1;?>
    <page size="A4">
      <table>
        <?php
        $row = 1;
        $col = 1;
        foreach ($printPriceTag as  $value) {
          if ($col<4) {
            echo $value;
          } else {
            echo "</tr>";
            echo "<tr>";
            echo $value;
            $col = 1;
          }
        $col++;}?>
      </table>
    </page>
  </body>
</html>
