<?php
session_start();
require_once('require/returnlogin.php');
include('db.php');
require_once('require/sessiondestroy.php');
require_once('require/access.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
	<meta http-equiv="pragma" content="no-cache" />
	<title>Report</title>
	<link rel="icon" type="img/png" href="icon/rsdi.png">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<table class="tbl-border">
		<tr>
			<td class="tbl-border-td1 tbl-border-menu">
				<button type="button" class="button-style button-menu"></button>
				<span class="span-text-menu">Menu</span>
				<div class="div-menu-list">
					<button type="button" class="button-style-menu-list" onclick="window.location.href='/dashboard'">Dashboard</button>
					<button type="button" class="button-style-menu-list" onclick="window.location.href='logout.php'">Logout</button>
				</div>
			</td>
			<td class="tbl-border-td1"></td>
			<td class="tbl-border-td1" colspan="2"></td>
		</tr>
		<tr>
			<td class="tbl-border-td2" colspan="4">
				<table class="tbl-report">
					<tr>
						<td class="tbl-report-td1">
							<table class="tbl-report-list">
								<tr>
									<th class="tbl-report-list-th">Report F325</th>
								</tr>
								<tr>
									<td class="tbl-report-list-td">
										<form class="form-report-export" method="POST" action="reportexport.php">
											<table class="tbl-filter">
												<tr>
													<th class="tbl-filter-th tbl-filter-daterange-th" colspan="2">Date range (Email Date):</th>
												</tr>
												<tr>
													<th class="tbl-filter-th tbl-filter-daterange">From:</th>
													<td class="tbl-filter-td tbl-filter-fit">
														<input type="date" class="input-withBorder-style input-daterange-from" name="inputfrom" value="<?php echo date('Y-m-d',strtotime('first day of this month')); ?>" required="required">
													</td>
												</tr>
												<tr>
													<th class="tbl-filter-th tbl-filter-daterange">To:</th>
													<td class="tbl-filter-td tbl-filter-fit">
														<input type="date" class="input-withBorder-style input-daterange-from" name="inputto" value="<?php echo date('Y-m-d',strtotime('last day of this month')); ?>" required="required">
													</td>
												</tr>
												<tr>
													<th class="tbl-filter-daterange-th" colspan="2"></th>
												</tr>
												<tr>
													<th class="tbl-filter-th tbl-filter-selection">Status:</th>
													<td class="tbl-filter-td tbl-filter-fit">
														<input type="text" class="input-withBorder-style input-status" onclick="Status();" readonly="readonly">
														<div class="div-selection div-status-selection">
															<table class="tbl-selection">
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-all-status" onchange="CheckAllStatus();" value="ALL"> All
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="PRINTED"> PRINTED
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="OPEN"> OPEN
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="SCHEDULED"> SCHEDULED
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="CLEARED"> CLEARED
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="OKFORDEDUCT"> OKFORDEDUCT
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="DEDUCTED"> DEDUCTED
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="DISPOSED"> DISPOSED
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-status" name="inputselectionstatus[]" onchange="UncheckedAll();" value="CANCELLED"> CANCELLED
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
												<tr>
													<th class="tbl-filter-th tbl-filter-selection">Location:</th>
													<td class="tbl-filter-td">
														<select class="select-withBorder" name="select_location">
															<option value="">ALL</option>
															<?php
															$loc_query = "SELECT * FROM dblocation WHERE active='1' ";
															// location
															$location = "location='' ";

															for ($loc = 1; $loc <= 10; $loc++)
															{ 
																// get location
																$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$loc' ");
																$fetch_location = mysqli_fetch_array($location_query);

																if ($_SESSION['loc'.$fetch_location['id']] == '1'){$location .= "OR location='".$fetch_location['location']."' ";}
															}

															$loc_query .= "AND (".$location.") ";
															$loc_query .= "ORDER BY location"; 

															$loc_allow_query = mysqli_query($conn,$loc_query);

															while ($fetch_allow_loc = mysqli_fetch_array($loc_allow_query))
															{
																?>
																<option value="<?php echo $fetch_allow_loc['location']; ?>"><?php echo $fetch_allow_loc['location']; ?></option>
																<?php
															}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<th class="tbl-filter-th tbl-filter-selection">Column:</th>
													<td class="tbl-filter-td">
														<input type="text" class="input-withBorder-style input-column" onclick="Column();" readonly="readonly">
														<div class="div-selection-column">
															<table class="tbl-selection">
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325number" name="inputf325number" value="f325number"> F325 #
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputarnumber" value="arnumber"> AR Number
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputdrivername" value="drivername"> Driver Name
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputprocess" value="process"> Process
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-mdccode" name="inputmdccode" value="mdccode"> MDC Code
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputarreason" value="arreason"> AR Reason
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputdatesched" value="datesched"> Date Schedule
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputcategory" value="category"> Category
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-branchname" name="inputbrcode" value="brcode"> Branch Name
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputdatecleared" value="datecleared"> Date Cleared
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputdmpiclass" value="dmpiclass"> DMPI Class
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputpreparedby" value="preparedby"> Prepared By
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-unitcost" name="inputunitcost" value="unitcost"> Unit Cost
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputdmpireason" value="dmpireason"> DMPI Reason
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputissuedby" value="issuedby"> Issued By
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-costextended" name="inputcostextended" value="costextended"> Cost Extended
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputreasoncode" value="reasoncode"> Reason Code
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputemaildate" value="emaildate"> Email Date
																	</td>
																	
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputprintremarks" value="printremarks"> Print Remarks
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-quantity" name="inputquantity" value="quantity"> Quantity
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputf325date" value="f325date"> F325 Date
																	</td>
																	
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputlogisticremarks" value="logisticremarks"> Logistic Remarks
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputrcvdqty" value="rcvdqty"> Received Qty
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-company" name="inputvendor" value="vendor"> Company
																	</td>
																	
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputclearingremarks" value="clearingremarks"> Clearing Remarks
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputexpiration" value="expiration"> Expiration
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputtmnumber" value="tmnumber"> TM #
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputcluster" value="cluster"> Cluster
																	</td>
																</tr>
																<tr>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column input-f325-status" name="inputstatus" value="status"> Status
																	</td>
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputplatenumber" value="platenumber"> Plate #
																	</td>
																	
																	<td class="tbl-selection-td tbl-selection-column-td">
																		<input type="checkbox" class="input-checkbox-style input-selection-column" name="inputlocation" value="location"> Location
																	</td>
																</tr>
															</table>
														</div>
													</td>
												</tr>
												<tr>
													<td class="tbl-filter-td tbl-filter-button" colspan="2">
														<button class="button-export-style">Export</button>
													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
						</td>
						<td class="tbl-report-td2">
							<table class="tbl-report-list">
								<tr>
									<th class="tbl-report-list-th">Report Pull-Out</th>
								</tr>
								<tr>
									<td class="tbl-report-list-td">
										<form class="form-report-export" method="POST" action="reportpulloutexport.php">
											<table class="tbl-filter">
												<tr>
													<th class="tbl-filter-th">Location</th>
													<td class="tbl-filter-td">
														<select class="select-withBorder" name="select_location">
															<option value="ALL">ALL</option>
															<?php
															$loc_query = "SELECT * FROM dblocation WHERE active='1' ";
															// location
															$location = "location='' ";

															for ($loc = 1; $loc <= 10; $loc++)
															{ 
																// get location
																$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$loc' ");
																$fetch_location = mysqli_fetch_array($location_query);

																if ($_SESSION['loc'.$fetch_location['id']] == '1'){$location .= "OR location='".$fetch_location['location']."' ";}
															}

															$loc_query .= "AND (".$location.") ";
															$loc_query .= "ORDER BY location"; 

															$loc_allow_query = mysqli_query($conn,$loc_query);

															while ($fetch_allow_loc = mysqli_fetch_array($loc_allow_query))
															{
																?>
																<option value="<?php echo $fetch_allow_loc['location']; ?>"><?php echo $fetch_allow_loc['location']; ?></option>
																<?php
															}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td class="tbl-filter-td tbl-filter-button" colspan="2">
														<button class="button-export-style">Export</button>
													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								<tr>
									<th class="tbl-report-list-th">Report For Pull-Out</th>
								</tr>
								<tr>
									<td class="tbl-report-list-td">
										<form class="form-report-export" method="POST" action="reportforpulloutexport.php">
											<table class="tbl-filter">
												<tr>
													<th class="tbl-filter-th">Location</th>
													<td class="tbl-filter-td">
														<select class="select-withBorder" name="select_location">
															<option value="ALL">ALL</option>
															<?php
															$loc_query = "SELECT * FROM dblocation WHERE active='1' ";
															// location
															$location = "location='' ";

															for ($loc = 1; $loc <= 10; $loc++)
															{ 
																// get location
																$location_query = mysqli_query($conn,"SELECT * FROM dblocation WHERE id='$loc' ");
																$fetch_location = mysqli_fetch_array($location_query);

																if ($_SESSION['loc'.$fetch_location['id']] == '1'){$location .= "OR location='".$fetch_location['location']."' ";}
															}

															$loc_query .= "AND (".$location.") ";
															$loc_query .= "ORDER BY location"; 

															$loc_allow_query = mysqli_query($conn,$loc_query);

															while ($fetch_allow_loc = mysqli_fetch_array($loc_allow_query))
															{
																?>
																<option value="<?php echo $fetch_allow_loc['location']; ?>"><?php echo $fetch_allow_loc['location']; ?></option>
																<?php
															}
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td class="tbl-filter-td tbl-filter-button" colspan="2">
														<button class="button-export-style">Export</button>
													</td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
						</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td class="tbl-border-td3" colspan="4">
				<span class="span-username">
					Connected remotely to <b style="color: #ed9121;font-style: italic;">Ramosco_Server</b> as: <b>
					<?php
					if (isset($_SESSION['fname']))
					{
						echo $_SESSION['fname'];
					}
					else
					{
						echo "Please Login.";
					}
					?></b>
				</span>
			</td>
		</tr>
	</table>

	<!-- notify alert -->
	<span class="span-notify-alert"></span>
</body>
</html>
<?php $conn->close(); ?>