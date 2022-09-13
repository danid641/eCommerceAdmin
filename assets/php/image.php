<?Php
require_once 'RemoteConfig.php';

class Image extends RemoteDataBase
{

    public function AddImage($FileName, $full_path, $type, $tmp_name, $error, $size, $imgId)
    {
        $imgData = addslashes(file_get_contents($tmp_name));
        $imageProperties = getimageSize($tmp_name);

        $sql = "INSERT INTO `image` (`imageId`,`imageType`,`imageData`) VALUE ('$imgId', '{$imageProperties['mime']}','{$imgData}')";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
    }
}
