<?php

    function display_data($order_list_result)
    {
        while($order_row = mysqli_fetch_assoc($order_list_result))
		{
			$verify_o= $order_row['is_confirmed'] ? 'Verified' : 'Verify';
			$verify_a = $order_row['is_confirmed'] ? 'disabled' : '';
			echo '
				<tr>
					<td>' . $order_row['order_id'] . '</td>
					<td>' . $order_row['order_name'] . '</td>
					<td>' . $order_row['order_address'] . '</td>
					<td>' . $order_row['order_district'] . '</td>
                    <td>' . $order_row['order_thana'] . '</td>
                    <td>' . $order_row['order_mobile'] . '</td>
                    <td>' . $order_row['order_total_price'] . '</td>
                    <td>' . $order_row['order_list_books'] . '</td>
					<td align="center"><a class="btn btn-outline-info btn-sm ' . $verify_a . '" href="functions/process_order_confirm.php?id=' . $order_row['order_id'] . '">' . $verify_o . '</a></td>
					<td align="center"><a class="btn btn-outline-danger btn-sm" href="functions/process_order_del.php?id=' . $order_row['order_id'] . '"><i class="fa-solid fa-trash"></i></a></td>
				</tr>
            ';	
		}
    }

?>