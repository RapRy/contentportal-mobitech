<section class="breadcrumbs-container">
    <?php
        if((isset($_GET['category']) && isset($_GET['subcategory']) && isset($_GET['content'])) || (isset($_GET['category']) && isset($_GET['subcategory']) && !isset($_GET['content'])) || isset($_GET['category']) && !isset($_GET['subcategory']) && !isset($_GET['content'])):
            $category = get_category($mysqli, $cat_active);
    ?>
            <div class="crumb-container">
                <a href="index.php?category=<?php echo $cat_active; ?>"><?php echo $category; ?></a>
            </div>
    <?php
        endif;
    ?>

    <?php 
        if(isset($_GET['category']) && isset($_GET['subcategory']) && isset($_GET['content']) || (isset($_GET['category']) && isset($_GET['subcategory']) && !isset($_GET['content']))):
            $subcategory = get_subcategory($mysqli, $subcat_active);
    ?>
                <div class="crumb-container">
                    <a href="index.php?category=<?php echo $cat_active; ?>&subcategory=<?php echo $subcat_active; ?>"><?php echo $subcategory; ?></a>
                </div>
    <?php
        endif;
    ?>

    <?php
        if(isset($_GET['content'])):
            $content_id = (int) $_GET['content'];
            $content = get_content($mysqli, $content_id);
    ?>
            <div class="crumb-container">
                <a href="index.php?category=<?php echo $cat_active; ?>&subcategory=<?php echo $subcat_active; ?>&content=<?php echo $content['id']; ?>"><?php echo $content['title']; ?></a>
            </div>
    <?php
        endif;
    ?>
</section>