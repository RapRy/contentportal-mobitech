<section class="latest-contents-home-container">
    <h4>Latest Contents</h4>
    <div class="latest-contents-home">
        <?php
            $latestContents = get_latest_contents($mysqli);

            foreach($latestContents as $content):
                $category = strtolower(get_category($mysqli, $content['category_id']));
                $subcategory = strtolower(get_subcategory($mysqli, $content['sub_category_id']));
                $content_name = str_replace(" ", "+", strtolower($content['title']));
                $icon_name = pathinfo($content['icon_file_name'], PATHINFO_FILENAME);
        ?>
                <a href="index.php?category=<?php echo $content['category_id']; ?>&subcategory=<?php echo $content['sub_category_id']; ?>&content=<?php echo $content['id']; ?>" alt="<?php echo $content['title']; ?>">
                    <div class="small-content-container">
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
                        <p><?php echo $content['title']; ?></p>
                    </div>
                </a>
        <?php
            endforeach;
        ?>
    </div>
</section>