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
            <tr class="item">
                <td class="itemName"><?= $item[1] ?></td>
                <!-- Attempting to make optional buttons that'll only appear
                     on the orderOnline page-->
                <?php if($onlineOrderMenu == true) {
                ?>
                <td><input type="button" class="itemPrice large" value=<?= $item[2] ?>></td>
                    <?php
                } else { //Else make a normal price text display
                ?>
                <td><?= $item[2] ?></td>
                <?php
                }
                if($differentSizes){
                    if($onlineOrderMenu == true) { //attempt to make a button for online ordering
                ?>
                        <td><input type="button" class="itemPrice small" value=<?= $item[3] ?>></td>
                <?php
                    } else {
?>                      <!-- otherwise just make a normal small price display -->
                <td><?= $item[3] ?></td>
<?php
                    }
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
