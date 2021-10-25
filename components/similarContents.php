<section class="similar-contents-home-container">
    <h4>Similar Contents</h4>
    <div class="similar-contents-home">
        <?php
            $cat = (int) $_GET['category'];
            $sub = (int) $_GET['subcategory'];
            $content_id = (int) $_GET['content'];
            $similarContents = get_similar_contents($mysqli, $cat, $sub, $content_id);

            foreach($similarContents as $content):
                $category = strtolower(get_category($mysqli, $cat));
                $subcategory = strtolower(get_subcategory($mysqli, $sub));
                $content_name = str_replace(" ", "+", strtolower($content['title']));
                $icon_name = pathinfo($content['icon_file_name'], PATHINFO_FILENAME);
        ?>
                <a href="index.php?category=<?php echo $cat; ?>&subcategory=<?php echo $sub; ?>&content=<?php echo $content['id']; ?>" alt="<?php echo $content['title']; ?>">
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