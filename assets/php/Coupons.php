<?php
require_once 'RemoteConfig.php';

class Coupons extends RemoteDataBase
{

    public function AddCoupon(
        $CouponName,
        $Discount,
        $DateStart,
        $DateEnd
    ) {
        $sql = "INSERT INTO coupons (`Coupon Name`,`Discount`,`Date Start`,`Date End`) VALUE 
        ('$CouponName', '$Discount','$DateStart','$DateEnd')";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();


        echo 'success';
    }

    public function DelteCoupon($CouponId)
    {
        $sql = "DELETE FROM coupons WHERE id = '$CouponId'";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
    }

    public function GetDataCoupons()
    {
        $sql = "SELECT * FROM Coupons";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CouponData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CouponData = $CouponData;
    }

    public function GetDataCouponsCondition($condition)
    {
        $sql = "SELECT * FROM Coupons $condition";
        $stmt = $this->RemoteConn->prepare($sql);
        $stmt->execute();
        $CouponData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->CouponData = $CouponData;
    }
}
