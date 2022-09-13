<?php
require_once 'RemoteConfig.php';

class Convert extends RemoteDataBase
{

       public function GetConvertPrice($amount) // $eur = 4.87
       {
              $sql = "SELECT * FROM currencies WHERE `Currency Title` = 'EURO'";
              $stmt = $this->RemoteConn->prepare($sql);
              $stmt->execute();
              $currenciesData = $stmt->fetch(PDO::FETCH_ASSOC);

              $eur = $currenciesData['Value'];

              switch ($_SESSION['curency']) {


                     case 'RON':
                            $total = $eur * $amount . " RON";
                            break;

                     default:
                            $total = $amount . "&euro;";
                            break;
              }

              return $this->total = $total;
       }

       public function GetCurrencyData()
       {
              $sql = "SELECT * FROM currencies";
              $stmt = $this->RemoteConn->prepare($sql);
              $stmt->execute();
              $currenciesData = $stmt->fetchALL(PDO::FETCH_ASSOC);

              return $this->currenciesData = $currenciesData;
       }

       public function GetCurrencyDataCondition($condition)
       {
              $sql = "SELECT * FROM currencies $condition";
              $stmt = $this->RemoteConn->prepare($sql);
              $stmt->execute();
              $currenciesData = $stmt->fetchALL(PDO::FETCH_ASSOC);

              return $this->currenciesData = $currenciesData;
       }

       public function AddCurency($CurrencyTitle, $Code, $value)
       {
              $sql = "INSERT INTO currencies (`Currency Title`,`Code`,`Value`) VALUE ('$CurrencyTitle', '$Code', '$value')";
              $stmt = $this->RemoteConn->prepare($sql);
              $stmt->execute();

              echo 'success';
       }

       public function DeleteCurrency($id)
       {
              $sql = "DELETE FROM currencies WHERE id = '$id'";
              $stmt = $this->RemoteConn->prepare($sql);
              $stmt->execute();
       }
}
