<?php

class Image
{
  /**
   * JAPSDOFIJASDFPOSDJF HACELO DESPUÉS NO TE OLVIDES D: ☢☢☢☢☢☢☢☢
   */
  public static function uploadImage(string $dir, array $fileData, string $mod = ""): string
  {

    $ogName = explode(".", $fileData["name"]);
    $extension = end($ogName);
    $fileName = $mod . time() . ".$extension";

    $fileUpload = move_uploaded_file($fileData["tmp_name"], "$dir/$fileName");

    if (!$fileUpload) {
      throw new Exception("No se pudo subir la imagen", 1);
    } else {
      return $fileName;
    }
  }

  public static function delete($file): bool
  {
    if (file_exists($file)) {
      $result = unlink($file);

      if (!$result) {
        throw new Exception("No se pudo eliminar el archivo", 1);
      } else {
        return true;
      }
    }

    return false;
  }
}
