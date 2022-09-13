<?php
require_once 'RemoteConfig.php';


class Countries extends RemoteDataBase
{
    public function GetCountriesData()
    {
        $sql = "SELECT * FROM countries";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CountriesData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $this->CountriesData = $CountriesData;
    }

    public function GetCountriesDataCondition($condition)
    {
        $sql = "SELECT * FROM countries $condition";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CountriesData = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $this->CountriesData = $CountriesData;
    }

    public function AddCountry($CountryName, $ISOCode)
    {
        $sql = "INSERT INTO countries (`Country Name`,`ISO Code`) VALUE ('$CountryName', '$ISOCode')";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();

        echo 'success';
    }

    public function EditCountry($CountryName, $ISOCode, $InitialCountryName)
    {
        $sql = "UPDATE countries SET `Country Name`='$CountryName', `ISO Code`='$ISOCode' WHERE `Country Name` = '$InitialCountryName'";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
    }

    public function DeleteCountry($id)
    {
        $sql = "DELETE FROM countries WHERE id = '$id'";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
    }
}
