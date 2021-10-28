<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./init/head.php'); ?>
</head>
<body>
    <div class="main-container">
        <?php 
            include('./components/header.php');
            ?>
        <div class="main-grid">
            <?php
                include('./components/subcategories.php');
                include('./components/breadcrumbs.php');

                if(!isset($_GET['content'])){
                    include('./components/contentlist.php');
                    include('./components/latestContents.php');
                }else{
                    include('./components/preview.php');
                    include('./components/latestContents.php');
                    include('./components/similarContents.php');
                }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./script/main.js"></script>
</body>
</html>