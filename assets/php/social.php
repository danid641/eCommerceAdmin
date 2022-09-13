<?php
require_once 'RemoteConfig.php';

class Social extends RemoteDataBase
{

    public function GetDataSocial()
    {
        $sql = "SELECT * FROM social";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->SocialData = $data;
    }

    public function EditSocialMediaLink($facebook, $twitter, $youtube, $instagram, $tiktok)
    {
        $sql = "UPDATE social SET `facebook`='$facebook', `twitter`='$twitter', `youtube`='$youtube',`instagram`='$instagram',`TikTok`='$tiktok'";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
    }
}
