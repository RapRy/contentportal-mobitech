<section class="preview-container">
    <?php
        $content_id = (int) $_GET['content'];

        $content = get_content($mysqli, $content_id);
        $contentScreenshots = [];

        $category =strtolower(get_category($mysqli, $content['category_id']));
        $subcategory = strtolower(get_subcategory($mysqli, $content['sub_category_id']));
        $content_name = str_replace(" ", "+", strtolower($content['title']));
        $icon_name = pathinfo($content['icon_file_name'], PATHINFO_FILENAME);
        $file_name = str_replace(" ", "+", $content['content_file_name']);

        if($content['file_mime'] !== "audio/mpeg" || $content['file_mime'] !== "image/jpeg" || $content['file_mime'] !== "video/mp4" || $content['file_mime'] !== "application/octet-stream"){
            $contentScreenshots = get_screenshots($mysqli, $content_id);
        }
    ?>

    <div class="preview">
        <div class="preview-bg">
            <div>
                <?php
                    if($content['file_mime'] === "application/octet-stream" || $content['file_mime'] === "application/vnd.android.package-archive"):
                ?>
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/screenshots/{$contentScreenshots[0]}"; ?>" alt="bg" />
                <?php
                    endif;
                ?>

                <?php 
                    if($content['file_mime'] === ""):
                ?>
                        <img src="./assets/html5-bg.jpg" alt="bg" />
                <?php
                    endif;
                ?>

                <?php 
                    if($content['file_mime'] === "audio/mpeg"):
                ?>
                        <img src="./assets/audio-bg.jpg" alt="bg" />
                <?php
                    endif;
                ?>

                <?php 
                    if($content['file_mime'] === "video/mp4"):
                ?>
                        <img src="./assets/video-bg.jpg" alt="bg" />
                <?php
                    endif;
                ?>

                <?php
                    if($content['file_mime'] === "image/jpeg"):
                ?>
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$content['content_file_name']}"; ?>" alt="bg" />
                <?php
                    endif;
                ?>
            </div>
        </div>
        <div class="preview-details">
            <div class="preview-thumb">
                <?php
                    if($content['file_mime'] === "video/mp4"):
                ?>
                        <video preload="metadata">
                            <source src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}#t=0.5" ?>" type="video/mp4" />
                        </video>
                <?php
                    elseif($content['file_mime'] === "audio/mpeg"):
                ?>
                        <img src="assets/music-thumb.png" alt="<?php echo $content['title']; ?>" />
                <?php
                    elseif($content['file_mime'] === "image/jpeg"):
                ?>
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$content['content_file_name']}"; ?>" alt="<?php echo $content['title']; ?>" />
                <?php
                    else:
                ?>
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$icon_name}.png" ?>" alt="<?php echo $content['title']; ?>" />
                <?php
                    endif;
                ?>
            </div>
            <div class="preview-name">
                <h2><?php echo $content['title']; ?></h2>
                <span><?php echo $category; ?> / <?php echo $subcategory; ?></span>
                <a class="preview-download" href="<?php echo $content['file_mime'] !== "" ? "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}" : "{$content['content_file_name']}" ?>"><?php echo $content['file_mime'] !== "" ? "DOWNLOAD" : "PLAY"; ?></a>
            </div>
            <p><?php echo $content['description']; ?></p>
        </div>
        <div class="preview-add-details">
            <?php
                if($content['file_mime'] === "application/vnd.android.package-archive"):
            ?>
                    <div class="screenshots-container">
                        <?php
                            foreach($contentScreenshots as $screenshots):
                        ?>
                                <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/screenshots/{$screenshots}"; ?>" alt="<?php echo $screenshots; ?>" />
                        <?php
                            endforeach;
                        ?>
                    </div>
            <?php
                elseif($content['file_mime'] === "video/mp4"):
            ?>
                    <div class="video-container">
                        <video preload="metadata" controls controlsList="nodownload">
                            <source src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}" ?>" type="video/mp4" />
                        </video>
                    </div>
            <?php
                elseif($content['file_mime'] === "audio/mpeg"):
            ?>
                    <div class="audio-container">
                        <audio preload="metadata" controls controlsList="nodownload">
                            <source src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$file_name}" ?>" type="audio/mpeg" />
                        </audio>
                    </div>
            <?php
                elseif($content['file_mime'] === "image/jpeg"):
            ?>
                    <div class="wallpaper-container">
                        <img src="<?php echo "{$contentDir}/{$category}/{$subcategory}/{$content_name}/{$content['content_file_name']}"; ?>" alt="<?php echo $content['title']; ?>" />
                    </div>
            <?php
                endif;
            ?>
        </div>
    </div>
</section>