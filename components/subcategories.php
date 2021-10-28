<nav class="subcategories-container">
    <i class="material-icons subcat-next">chevron_left</i>
    <div class="subcategories-list">
        <div class="subcategories">
            <?php
                require('./init/methods.php');

                $subcategories = get_subcategories($mysqli, $cat_active);

                if($subcat_active === 0){
                    $subcat_active = $subcategories[0]['id'];
                }

                foreach($subcategories as $subcategory):
            ?>
                    <a class="<?php echo $subcat_active === $subcategory['id'] ? "active" : ""; ?>" href="<?php echo "index.php?category={$cat_active}&subcategory={$subcategory['id']}"; ?>"><?php echo $subcategory['sub_category']; ?></a>
            <?php
                endforeach;
            ?>
        </div>
    </div>
    <i class="material-icons subcat-prev">chevron_right</i>
</nav>