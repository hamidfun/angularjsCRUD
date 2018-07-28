<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
include_once "connect.php";
if ($_GET['opt'] && !empty($_GET['opt'])) {
  $opt = $_GET['opt'];
  if ($opt == "list") {
    $sql = "select id,title,content from news";
    $select = $db->prepare($sql);
    $row = $select->execute();
    $res = $select->fetchAll();
    $count_row = strval($select->rowCount());
    $out = '';
    foreach ($res as $row) {
      if ($out != "") { $out .=',';}
      $out .= '{"id" : "'.$row->id.'","title" : "'.$row->title.'","content" : "'.$row->content.'"}';
    }
    $ok = "Success";
    $out = '{"ok":"'.$ok.'","results":['.$out.'],"rowCount":'.(int)$count_row.'}';
    echo $out;
  }else if($opt == "insert") {
    if (!$_GET['title'] || empty($_GET['title'])){
      #TODO: error empty title
    }else if (!$_GET['content'] || empty($_GET['content'])){
      #TODO error empty content

    }else {
      $sql = "insert into news values (null,:title,:content)";
      $bind = array(
        ":title" => $_GET['title'],
        ":content" => $_GET['content']
      );
      $insert = $db->prepare($sql);
      if($insert->execute($bind)){
        echo '{"ok" : "Success/Ok/True/Perfect/Nice/Harchi"}';
      }else {
        echo '{"ok" : "False"}';
      }
    }
  }else if ($opt == "delete"){
    if($_GET['ids'] && !empty($_GET['ids'])){
      $ids = $_GET['ids'];
      $sql = "delete from news where id in (".$ids.")";
      $bind = array(':id' => $ids);
      $delete = $db->prepare($sql);
      if($delete->execute()){
          echo '{"ok":"با موفقیت حذف شد"}';
      }else {
        echo '{"ok" : "خطایی رخ داد"}';
      }

    }
  }else if ($opt== "post" ){
    if($_GET['id'] && !empty($_GET['id'])){
      $id = $_GET['id'];
      $sql = "select id,title,content from news where id = :id";
      $bind = array(':id' => $id);
      $select = $db->prepare($sql);
      $row = $select->execute($bind);
      $res = $select->fetchAll();
      $count_row = strval($select->rowCount());
      $out = '';
      //var_dump($res)
      foreach ($res as $row) {
        if ($out != "") { $out .=',';}
        $out .= '{"id" : "'.$row->id.'","title" : "'.$row->title.'","content" : "'.$row->content.'"}';
      }
      $ok = "Success / row count = $count_row ";
      $out = '{"ok":"'.$ok.'","post":['.$out.']}';
      echo $out;
    }else {
      $out = '{"ok":"not send id"}';
      echo $out;
    }
  }else if ($opt == "update"){
    if($_GET['id'] && !empty($_GET['id'])){
      $id = $_GET['id'];
      $title = $_GET['title'];
      $content = $_GET['content'];
      $sql = "update news set title=:title,content=:content where id=:id";
      $bind = array(
        ':title'=> $title,
        ':content' => $content,
        ':id' => $id
      );
      $update = $db->prepare($sql);
      if($update->execute($bind)){
        echo '{"ok":"با ویرایش شد"}';
    }else {
      echo '{"ok" : "خطایی رخ داد"}';
    }

    }
  }
}

?>
