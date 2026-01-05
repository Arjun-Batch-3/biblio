<?php
    include("includes/header.php");
    include("../includes/connection.php");
	include("functions/process_order_view_data.php");
	

	$order_list_query = "SELECT * FROM `order_table`";
	$order_list_result = mysqli_query($connection_database, $order_list_query);
?>
        <main class="container px-md-4 min-vh-100">
			<h2 class="title mt-5 pt-5">Order</h2>

			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Order ID</th>
							<th scope="col">Name</th>
							<th scope="col">Address</th>
							<th scope="col">District</th>
							<th scope="col">Thana</th>
							<th scope="col">Phone</th>
                            <th scope="col">Total price</th>
                            <th scope="col">Order</th>
                            <th scope="col">Verify</th>
                            <th scope="col">Delete</th>
						</tr>
					</thead>

					<?php
						display_data($order_list_result);
					?> 

				</table>
			</div>
		</main>


		</div>
<?php
include("includes/footer.php");
?>