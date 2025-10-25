<?php
include('db.php');

$dmpipack = str_replace(" ", "", $_POST['dmpipack']);

if (!empty($dmpipack))
{
	$reason_query = mysqli_query($conn,"SELECT reasoncode,reason FROM dbdmpireason WHERE $dmpipack='1'");
	$row = mysqli_num_rows($reason_query);

	?>
	<option value="0"></option>
	<?php
	while ($fetch_reason = mysqli_fetch_array($reason_query))
	{
		?>
		<option value="<?php echo $fetch_reason['reasoncode']; ?>"><?php echo '('.$fetch_reason['reasoncode'].') '.$fetch_reason['reason']; ?></option>
		<?php
	}
}
else
{
	?>
	<option value="0">Please set dmpi packaging.</option>
	<?php
}


$conn->close();
?>