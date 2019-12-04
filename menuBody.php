<?php
    $categories = get_categories();

    foreach($categories as $category){
        $items = get_menu_by_category($category);

        // check if there needs to be separate large/small prices
        $differentSizes = false;
        foreach($items as $item){
            if ($item[3] > 0){
                $differentSizes = true;
            }
        }
?>
    <button class="accordion"> <?= $category ?> </button>
    <div class="panel">
        <table>
            <tr>
                <th>Name</th>
<?php
                if($differentSizes) {
?>
                <th>Large Price</th>
                <th>Small Price</th>
<?php
                } else {
?>
                <th>Price</th>
<?php
                }
?>
            </tr>
<?php
            foreach($items as $item){
?>
            <tr>
                <td><?= $item[1] ?></td>
                <td><?= $item[2] ?></td>
<?php
                if($differentSizes){
?>
                <td><?= $item[3] ?></td>
<?php
                }
?>
            </tr>
<?php
            }
?>
        </table>
    </div>
<?php
    }
?>
