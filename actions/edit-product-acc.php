<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$formData = $_POST;
$fileData = $_FILES;

// echo "<pre>";
// print_r($formData);
// echo "</pre>";

// echo "<pre>";
// print_r($fileData);
// echo "</pre>";

// die("Pre try{} catch{}");

try {
  $candle = Candle::filter_by_id($formData["id"]);

  // CATEGORY
  $id_category = $formData["category"];
  if ($formData["category"] === "newCategory") {
    $id_category = Category::insert($formData["newCategory"]);
  }

  // TAGS
  $candle->clearTags();
  if (isset($formData["tags"])) {
    foreach ($formData["tags"] as $id_tag) {
      Candle::addTag($candle->getId(), $id_tag);
    }
  }

  // CHANGE COVER
  $cover = $formData["originalCover"];
  if (!empty($fileData["cover"]["tmp_name"])) {
    Image::delete("../img/candles/$cover");
    $cover = Image::uploadImage('../img/candles/', $fileData["cover"]);
  }

  // DELETE EXTRA IMAGES
  if (isset($formData["deleteExtraImages"])) {
    foreach ($formData["deleteExtraImages"] as $id_img) {
      $img = ExtraImage::filter_by_id($id_img);
      $img->delete();
    }
  }

  // ADD EXTRA IMAGES
  if (!empty($fileData["extra_images"]["name"][0])) {
    for ($i = 0; $i < count($fileData["extra_images"]["name"]); $i++) {
      $file = [
        "name" => $fileData["extra_images"]["name"][$i],
        "full_path" => $fileData["extra_images"]["full_path"][$i],
        "type" => $fileData["extra_images"]["type"][$i],
        "tmp_name" => $fileData["extra_images"]["tmp_name"][$i],
        "error" => $fileData["extra_images"]["error"][$i],
        "size" => $fileData["extra_images"]["size"][$i]
      ];

      $filename = Image::uploadImage('../img/candles/carousel/', $file, "c$i-");

      ExtraImage::insert($filename, $candle->getId());
    }
  }

  $candle->edit(
    $formData["name"],
    $formData["description"],
    $id_category,
    $cover,
    $formData["price"],
    $formData["discount"],
    $formData["cssColor"],
    $formData["material"],
    $formData["duration"],
    $formData["size"],
    $formData["weight"],
    $formData["fragance"]
  );

  Alert::addAlert('success', 'El producto se editó correctamente');
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";

  Alert::addAlert('danger', 'Algo salió mal a la hora de editar este producto');
}

header("Location: ../dashboard.php?section=admin-products");
