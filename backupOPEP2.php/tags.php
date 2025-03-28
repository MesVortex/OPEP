<?php
include_once('./app/config/db.php');
if(isset($_GET['theme'])) {
    $idtheme = $_GET['theme'];

    $select = $con->prepare("SELECT * FROM theme_tag
    JOIN tag ON tag.tag_id = theme_tag.tag_id
    WHERE theme_tag.theme_id = ?");
    $select->bind_param('i',$idtheme);
    $select->execute();
    $result = $select->get_result();
    while($row = $result->fetch_assoc()) {
        ?>
        <input type="file" id="upload_img" name="article_image[]" onchange="previewImage(event)">
        <input type="text" placeholder="TITLE...." name="article_title[]">
        <input type="text" placeholder="write your text ....." name="article_text[]">
        <button type="button" onclick="removeArticle(this)">DELETE</button>
        <div class="checkboxes d-flex flex-column">
            <?php
            $tag=$con->prepare("SELECT * FROM theme_tag
            JOIN tag ON tag.tag_id = theme_tag.tag_id
            WHERE theme_tag.theme_id = ?
            ");
            $tag->bind_param('i',$idtheme);
            $tag->execute();
            $result = $tag->get_result();
            $number = $_GET['articleCounter'];
            while($row = $result->fetch_assoc()) {
                ?>
                <div>
                <input type="checkbox" value="<?php echo $row['tag_id']?>" name="tags[<?php echo $number?>][]">
                <label for="checkbox"><?php echo $row['tag_name']?></label>
                </div>
                <?php
            }
            
            echo $number;
            ?>

            
        </div>
        <?php
        
    }
}


?>