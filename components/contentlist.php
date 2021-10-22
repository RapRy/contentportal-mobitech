<section class="content-list-container">
    <div class="content-list">
        <?php
            $contents = get_contents($mysqli, $cat_active, $subcat_active);

            foreach($contents as $content):
                $category = strtolower(get_category($mysqli, $cat_active));
                $subcategory = strtolower(get_subcategory($mysqli, $subcat_active));
                $content_name = str_replace(" ", "+", strtolower($content['title']));
                $icon_name = pathinfo($content['icon_file_name'], PATHINFO_FILENAME);
                $file_name = str_replace(" ", "+", $content['content_file_name']);
        ?>
                <div class="card-container">
                    <div class="card-upper-part">
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$icon_name}.png"; ?>" alt="<?php echo $content['title']; ?>" />
                        <div class="upper-part-details" data-category="<?php echo $category; ?>" data-subcategory="<?php echo $subcategory; ?>"></div>
                    </div>
                    <div class="card-middle-part">
                        <h4><?php echo $content['title']; ?></h4>
                        <div>
                            <p><?php echo $content['description']; ?></p>
                        </div>
                    </div>
                    <div class="card-lower-part">
                        <a href="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}"; ?>">DOWNLOAD</a>
                    </div>
                </div>
        <?php
            endforeach;
        ?>
    </div>
    <button class="show-more-btn" data-catid="<?php echo $cat_active; ?>" data-subid="<?php echo $subcat_active; ?>">Show More</button>

    <template id="skel-card-loader">
        <div class="skel-card-container">
            <div class="skel-card-upper-part">
                <div class="skel-image gradient-anim"></div>
                <div class="skel-upper-part-details"></div>
            </div>
            <div class="skel-card-middle-part">
                <div class="skel-title gradient-anim"></div>
                <div class="skel-description gradient-anim"></div>
                <div class="skel-description gradient-anim"></div>
            </div>
            <div class="skel-card-lower-part">
                <div class="skel-dl-btn gradient-anim"></div>
            </div>
        </div>
    </template>
</section>