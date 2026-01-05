<?php

    function display_data($count, $category_result)
    {
        while($category_row = mysqli_fetch_assoc($category_result))
        {
            echo '
                <tr class="odd gradeX">
                    <td>' . $count . '</td>
                    <td>' . $category_row['category_name'] . '</td>
                    <td><a class="btn btn-outline-danger btn-sm" href="functions/process_category_del.php?id=' . $category_row['category_id'] . '"><i class="fa-solid fa-trash"></i></a></td>
                </tr>';
            $count++;
        }
    }

?>