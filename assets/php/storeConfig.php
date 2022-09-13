<?Php
require_once 'RemoteConfig.php';

class StoreConfig extends RemoteDataBase
{
    public function GetDataConfig()
    {
        $sql = "SELECT * FROM `store config`";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->DataConfig = $data;
    }
}

$StoreConfig = new StoreConfig;