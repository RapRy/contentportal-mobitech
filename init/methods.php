<?php
    function get_category($mysqli, $category){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT category FROM cms.categories WHERE id = ?");
        $stmt->bind_param('i', $category);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($cat);

        while($stmt->fetch()){
            return $cat;
        }
    }

    function get_subcategory($mysqli, $subcategory){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT sub_category FROM cms.sub_categories WHERE id = ?");
        $stmt->bind_param('i', $subcategory);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($subcat);

        while($stmt->fetch()){
            return $subcat;
        }
    }

    function get_subcategories($mysqli, $category){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, sub_category FROM cms.sub_categories WHERE category_id = ?");
        $stmt->bind_param('i', $category);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $sub_category);

        $payload = [];

        while($stmt->fetch()){
            array_push($payload, ['id' => $id, 'sub_category' => $sub_category]);
        }

        return $payload;
    }

    function get_contents($mysqli, $category, $subcategory){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, content_file_name, icon_file_name, description, content_file_mime FROM cms.portal_content WHERE category_id = ? AND sub_category_id = ? LIMIT 10");
        $stmt->bind_param("ii", $category, $subcategory);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $title, $category_id, $sub_category_id, $content_file_name, $icon_file_name, $description, $content_file_mime);

        $payload = [];

        while($stmt->fetch()){
            array_push($payload, ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'content_file_name' => $content_file_name, 'icon_file_name' => $icon_file_name, 'description' => $description, 'file_mime' => $content_file_mime]);
        }

        return $payload;
    }

    function get_content($mysqli, $content){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, content_file_name, icon_file_name, description, content_file_mime FROM cms.portal_content WHERE id = ?");
        $stmt->bind_param("i", $content);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $title, $category_id, $sub_category_id, $content_file_name, $icon_file_name, $description, $content_file_mime);

        while($stmt->fetch()){
            return ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'content_file_name' => $content_file_name, 'icon_file_name' => $icon_file_name, 'description' => $description, 'file_mime' => $content_file_mime];
        }
    }

    function get_screenshots($mysqli, $content){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT screenshot_file_name FROM cms.portal_content_screenshots WHERE portal_content_id = ?");
        $stmt->bind_param("i", $content);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($screenshot_file_name);

        $screenshots = [];

        while($stmt->fetch()){
            array_push($screenshots, $screenshot_file_name);
        }

        return $screenshots;
    }

    function get_latest_contents($mysqli){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, icon_file_name, content_file_mime, content_file_name FROM cms.portal_content ORDER BY created_at LIMIT 10 ");
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $title, $category_id, $sub_category_id, $icon_file_name, $content_file_mime, $content_file_name);

        $payload = [];

        while($stmt->fetch()){
            array_push($payload, ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'icon_file_name' => $icon_file_name, 'file_mime' => $content_file_mime, 'content_file_name' => $content_file_name]);
        }

        return $payload;
    }

    function get_similar_contents($mysqli, $category, $subcategory, $content_id){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, icon_file_name, content_file_mime, content_file_name FROM cms.portal_content WHERE category_id = ? AND sub_category_id = ? AND id != ? ORDER BY RAND() LIMIT 10");
        $stmt->bind_param("iii", $category, $subcategory, $content_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $title, $category_id, $sub_category_id, $icon_file_name, $content_file_mime, $content_file_name);

        $payload = [];

        while($stmt->fetch()){
            array_push($payload, ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'icon_file_name' => $icon_file_name, 'file_mime' => $content_file_mime, 'content_file_name' => $content_file_name]);
        }

        return $payload;
    }
?>