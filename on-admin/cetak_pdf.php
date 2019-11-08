<?php
$nama_dokumen='Laporan Penjualan K-GEAR GAMING'; 
define('_MPDF_PATH','config/MPDF60/'); 
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); 
ob_start();


?>
<table border='0' align='LEFT'>
<tr>
<th>
<img src="dist/img/cloud.png"  alt="" width="200" height="140" />
</th>
<th width="900px">
<h1>  LAPORAN PENJUALAN  <br> K-GEAR GAMING</h1> </br>

</th>
</tr>
</table>
<hr style="height:3px;" />



<?php

error_reporting(0);
include "config/koneksi.php";
include "config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>

<p style="text-align:left;"> Periode (Tanggal <?php echo tgl_indo($tglpenjualanaw)?> S/D  <?php echo tgl_indo($tglpenjualanak) ?>) </p>

<table cellspacing="5" cellpadding="5" border="1">
                        
                          <tr>
                            <th>No</th>
                            <th>No Penjualan</th>
                            <th width="20%">Tanggal Penjualan</th>
                            <th width="20%">Nama Produk</th>
                            <th width="20%">Stok Produk</th>
                            <th>Jumlah Item Terjual</th>
                            <th>Harga Produk</th>
                            <th>Total Penjualan</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $tampil=mysql_query("SELECT * FROM penjualan r
                        JOIN produk p ON ( r.id_produk = p.id_produk) where
                        tglpenjualan BETWEEN  '$_POST[tglpenjualanaw]' AND  '$_POST[tglpenjualanak]'
                        ORDER BY nopenjualan ASC");
                        $no = 1;
                          while ($r=mysql_fetch_array($tampil)){
                        ?>
                            <tr>
                            <td><?php echo "$no"?></td>
                            <td><?php echo "$r[nopenjualan]"?></td>

                            <?php 
                            $tglpenjualan=tgl_indo($r['tglpenjualan']);?>
                            
                            <td align="center"><?php echo "$tglpenjualan"?></td>
                            <td align="center"><?php echo "$r[nama_produk]"?></td>
                            <td align="center"><?php echo "$r[stokproduk]"?></td>
                            <td align="center"><?php echo "$r[itemterjual]"?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                            <td align="center"><?php echo "Rp.". number_format("$r[total_penjualan]",'0','.','.')?></td>
                            </tr>

                        <?php
                        $no++;
                        }
                        ?>

                        <tr>
                        <td align = "center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>
                        <?php
                        
                        $liatHarga=mysql_fetch_array(mysql_query("SELECT sum(total_penjualan) as total_penjualan, 
                        sum(harga) as harga_produk, sum(itemterjual) as itemterjual  FROM penjualan r  
                        join produk p on (r.id_produk=p.id_produk)
                        where 
                        tglpenjualan BETWEEN '$_POST[tglpenjualanaw]' 
                        AND  '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC"));
                        ?>

                      <td align = "center"><span style="font-weight:bold"><?php echo "". number_format("$liatHarga[itemterjual]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[harga_produk]",'0','.','.')?></td>
                        <td><span style="font-weight:bold"><?php echo "Rp.". number_format("$liatHarga[total_penjualan]",'0','.','.')?></td>
                        </tr>
                        </tbody>
                      </table>
                      
                      <br> <br>
                      <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 460px;"> TEGAL, <?php echo "$tanggal"?>
                      <br><br></p>
                     <p style="margin: 50px 8px 5px 510px;"> MANAGER </p>

<?php

$html = ob_get_contents(); 
ob_end_clean();

$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>