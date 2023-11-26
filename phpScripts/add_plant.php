<?php

if(!empty($_POST['plantName']) && !empty($_POST['user_id']) && ($_POST['category_id'] !== 'Select Plant Category')){
  echo $_POST['category_id'];
}else{
  echo "I'm inside else";
}