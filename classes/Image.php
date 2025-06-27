<?php

class Image
{
  /**
   * Uploads an image file to the specified directory with an optional filename modifier.
   *
   * @param string $dir       The target directory where the image will be saved.
   * @param array  $fileData  The uploaded file data (e.g., from $_FILES).
   * @param string $mod       Optional modifier to prepend to the filename.
   *
   * @throws Exception If the image upload fails.
   *
   * @return string The new filename of the uploaded image.
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

  /**
   * Deletes a file from the filesystem if it exists.
   *
   * @param string $file The path to the file to delete.
   *
   * @throws Exception If the file exists but cannot be deleted.
   *
   * @return bool Returns true if the file was deleted, false if the file does not exist.
   */
  public static function delete(string $file): bool
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
