<?php 
error_reporting(0);
session_start();
include '../config/koneksi.php';

$id_pelanggan = $_SESSION['id_pelanggan'];
$no = 1;
$cart_sql = mysqli_query($conn,"SELECT * FROM master_keranjang_belanja as a
    LEFT JOIN master_produk as b ON a.id_produk = b.id
    WHERE a.id_pelanggan='".$id_pelanggan."'
    ORDER BY a.date_created ASC");
while ($data = mysqli_fetch_array($cart_sql)) {
    ?>
    <tr>
        <td>
            <img src="<?php echo $base_url; ?>upload/<?php echo $data['gambar']; ?>" alt="product-img" title="product-img" class="avatar-lg">
        </td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo "Rp. ".number_format($data['harga']); ?></td>
        <td width="1%" nowrap="">
          <div style="width: 120px;" class="product-cart-touchspin">
            <input data-toggle="touchspin" onchange="updateQty('<?php echo $data['id']; ?>')" type="text" value="<?php echo $data['qty']; ?>" >
        </div>
    </td>
    <td></td>
</tr>
<?php } ?>