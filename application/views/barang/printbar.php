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
    
  </body>
</html>
