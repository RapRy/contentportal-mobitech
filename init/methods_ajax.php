<?php
    require('./connect.php');

    function get_contents($mysqli, $category, $subcategory, $offset){
        $stmt = $mysqli->stmt_init();
        $stmt->prepare("SELECT id, title, category_id, sub_category_id, content_file_name, icon_file_name, description FROM cms.portal_content WHERE category_id = ? AND sub_category_id = ? LIMIT $offset, 10");
        $stmt->bind_param("ii", $category, $subcategory);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows() > 0){

            $stmt->bind_result($id, $title, $category_id, $sub_category_id, $content_file_name, $icon_file_name, $description);
    
            $payload = [];
            $catName = "";
            $subName = "";

            $stmtCat = $mysqli->stmt_init();
            $stmtCat->prepare("SELECT category FROM cms.categories WHERE id = ?");
            $stmtCat->bind_param('i', $category);
            $stmtCat->execute();
            $stmtCat->store_result();
            $stmtCat->num_rows();

            $stmtCat->bind_result($cat);

            while($stmtCat->fetch()){
                $catName = $cat;
            }

            $stmtSub = $mysqli->stmt_init();
            $stmtSub->prepare("SELECT sub_category FROM cms.sub_categories WHERE id = ?");
            $stmtSub->bind_param('i', $subcategory);
            $stmtSub->execute();
            $stmtSub->store_result();
            $stmtSub->num_rows();

            $stmtSub->bind_result($subcat);

            while($stmtSub->fetch()){
                $subName = $subcat;
            }
    
            while($stmt->fetch()){
                array_push($payload, ['id' => $id, 'title' => $title, 'category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'content_file_name' => $content_file_name, 'icon_file_name' => $icon_file_name, 'description' => $description, 'category' => $catName, 'subcategory' => $subName]);
            }

            $stmtCount = $mysqli->stmt_init();
            $stmtCount->prepare("SELECT id FROM cms.portal_content WHERE category_id = ? AND sub_category_id = ?");
            $stmtCount->bind_param("ii", $category, $subcategory);
            $stmtCount->execute();
            $stmtCount->store_result();

            $isFull = (count($payload) + ($offset + 1)) >= $stmtCount->num_rows() ? true : false;
    
            echo json_encode(['contents' => $payload, 'is_full' => $isFull]);
        }

    }

    if(isset($_POST['offset'])){
        $offset = (int) $_POST['offset'];
        $category = (int) $_POST['category'];
        $subcategory = (int) $_POST['subcategory'];

        get_contents($mysqli, $category, $subcategory, $offset);
    }
?>