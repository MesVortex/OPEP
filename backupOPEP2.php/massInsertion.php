<?php
session_start();
include_once('../config/db.php');

if (!empty($_POST['article_title']) && !empty($_POST['article_text']) && !empty($_POST['article_image']) && !empty($_POST['tags']) && !empty($_POST['theme']) && isset($_POST['counter'])) {
  $titles = $_POST['article_title'];
  $texts = $_POST['article_text'];
  $imgs = $_POST['article_image'];
  $tags = $_POST['tags'];
  $theme = $_POST['theme'];
  $articleCounter = $_POST['counter'];
  $userid = $_SESSION['user_id'];


  $tag = $con->prepare("SELECT * FROM theme_tag
  JOIN tag ON tag.tag_id = theme_tag.tag_id
  WHERE theme_tag.theme_id = ?
  ");
  $tag->bind_param('i',$theme);
  $tag->execute();
  $result = $tag->get_result();
  $count = 0;

  while($row = $result->fetch_assoc()){
    $count++;
  }

  for ($i = 0; $i <= $articleCounter; $i++) {
    if (!empty($titles[$i]) && !empty($texts[$i]) && !empty($imgs[$i])) {
      $query = $con->prepare("INSERT INTO article (article_title, article_img, article_text, theme_ID, article_user) VALUES (?,?,?,?,?)");
      $query->bind_param("sssii", $titles[$i], $imgs[$i], $texts[$i], $theme, $userid);
      $query->execute();

      $lastID_query = $con->query("SELECT article_id FROM `article` ORDER BY article_id DESC LIMIT 1");
      $lastID = $lastID_query->fetch_assoc();
    
      foreach($tags as $tag){
        for($j = 0; $j < $count; $j++){
          if(isset($tags[$i][$j])){
            $insertTag = $con->prepare("INSERT INTO article_tag (article_id, tag_id) VALUES (?, ?)");
            $insertTag->bind_param("ii", $lastID['article_id'], $tags[$i][$j]);
            $insertTag->execute();
          }
        }
      }
    }
  }

  header('location: ../../articles.php?theme='.$theme);

  die();
  
}else{
  echo "m inside else";
}

