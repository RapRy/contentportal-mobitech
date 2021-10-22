<header class="main-header">
    <div class="brand-logo">Brand Logo</div>
    <div class="burger-icon">
        <span></span>
    </div>
    <nav class="nav-mobile-container">
        <i class="material-icons">close</i>
        <div>
            <?php 
                $categories = [
                    ['cat_id' => 2, 'cat_name' => 'Apps'],
                    ['cat_id' => 4, 'cat_name' => 'Tones'],
                    ['cat_id' => 6, 'cat_name' => 'Games Apk'],
                    ['cat_id' => 8, 'cat_name' => 'Wallpapers'],
                    ['cat_id' => 1, 'cat_name' => 'Videos'],
                    ['cat_id' => 9, 'cat_name' => 'HTML5'],
                    // ['cat_id' => 14, 'cat_name' => 'Premium HTML5']
                ];

                $cat_active = isset($_GET['category']) ? (int) $_GET['category'] : $categories[0]['cat_id'];
                $subcat_active = isset($_GET['subcategory']) ? (int) $_GET['subcategory'] : 0;

                foreach($categories as $cat):
            ?>
                <div class="mobile-nav-link-container">
                    <a href="<?php echo "index.php?category={$cat['cat_id']}"; ?>" class="<?php echo $cat_active === $cat['cat_id'] ? "active" : ""; ?>">
                        <span><?php echo $cat['cat_name']; ?></span>
                    </a>
                </div>
            <?php
                endforeach;
            ?>
        </div>
    </nav>
</header>