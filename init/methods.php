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
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, content_file_name, icon_file_name, description FROM cms.portal_content WHERE category_id = ? AND sub_category_id = ? LIMIT 10");
        $stmt->bind_param("ii", $category, $subcategory);
        $stmt->execute();
        $stmt->store_result();
        $stmt->num_rows();

        $stmt->bind_result($id, $title, $category_id, $sub_category_id, $content_file_name, $icon_file_name, $description);

        $payload = [];

        while($stmt->fetch()){
            array_push($payload, ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'content_file_name' => $content_file_name, 'icon_file_name' => $icon_file_name, 'description' => $description]);
        }

        return $payload;
    }
?>