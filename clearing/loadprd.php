<?php
include('db.php');

$search = $_POST['search'];
$vcode = $_POST['vcode'];

$search_query = mysqli_query($conn,"SELECT mdccode,itemcode,description,category,dmpipack FROM dbproduct WHERE (mdccode LIKE '%$search%' OR description LIKE '%$search%') AND vendor='$vcode' ORDER BY mdccode LIMIT 8");
$row = mysqli_num_rows($search_query);

if ($row >= 1)
{
	while ($fetch_search = mysqli_fetch_array($search_query))
	{
		?>
		<tr class="tbl-prd-tr" mdccode="<?php echo $fetch_search['mdccode']; ?>" itemcode="<?php echo $fetch_search['itemcode']; ?>" description="<?php echo $fetch_search['description']; ?>" category="<?php echo $fetch_search['category']; ?>" dmpipack="<?php echo $fetch_search['dmpipack']; ?>">
			<td class="tbl-prd-td1"><?php echo $fetch_search['mdccode']; ?></td>
			<td class="tbl-prd-td2"><?php echo $fetch_search['description']; ?></td>
		</tr>
		<?php
	}
}
else
{
	?>
	<tr>
		<td style="text-align: center;" colspan="2">No Found Result.</td>
	</tr>
	<?php
}

$conn->close();
?>