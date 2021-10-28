<?php
    $contents = get_contents($mysqli, $cat_active, $subcat_active);

    if(count($contents) > 0):
?>
<section class="content-list-container">
    <div class="content-list">
        <?php
            foreach($contents as $content):
                $category = strtolower(get_category($mysqli, $cat_active));
                $subcategory = strtolower(get_subcategory($mysqli, $subcat_active));
                $content_name = str_replace(" ", "+", strtolower($content['title']));
                $icon_name = pathinfo($content['icon_file_name'], PATHINFO_FILENAME);
                $file_name = str_replace(" ", "+", $content['content_file_name']);
        ?>
                <div class="card-container">
                    <a href="index.php?category=<?php echo $cat_active; ?>&subcategory=<?php echo $subcat_active; ?>&content=<?php echo $content['id']; ?>">
                        <div class="card-upper-part">
                            <?php
                                if($content['file_mime'] === "audio/mpeg"):
                            ?>
                                    <img src="assets/music-thumb.png" alt="<?php echo $content['title']; ?>" />
                            <?php
                                elseif($content['file_mime'] === "video/mp4"):
                            ?>
                                    <video preload="metadata">
                                        <source src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}#t=0.5" ?>" type="video/mp4" />
                                    </video>
                            <?php
                                elseif($content['file_mime'] === "image/jpeg"):
                            ?>
                                    <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$content['content_file_name']}"; ?>" alt="<?php echo $content['title']; ?>" />
                            <?php
                                else:
                            ?>
                                <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$icon_name}.png"; ?>" alt="<?php echo $content['title']; ?>" />
                            <?php
                                endif;
                            ?>
                            <div class="upper-part-details" data-category="<?php echo $category; ?>" data-subcategory="<?php echo $subcategory; ?>"></div>
                        </div>
                        <div class="card-middle-part">
                            <h4><?php echo $content['title']; ?></h4>
                            <div>
                                <p><?php echo $content['description']; ?></p>
                            </div>
                        </div>
                    </a>
                    <div class="card-lower-part">
                    <a href="<?php echo $content['file_mime'] !== "" ? "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}" : "{$content['content_file_name']}" ?>"><?php echo $content['file_mime'] !== "" ? "DOWNLOAD" : "PLAY"; ?></a>
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
<?php
    else:
        include('./components/empty.php');
    endif;
?>
