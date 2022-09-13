<?php
require_once 'session.php';
session_start();

class lang
{
    public function __construct()
    {
        $Default_languages = 'EN';

        $avaliable_languages = ['EN', 'RO'];

        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if (isset($_GET['lang'])) {
            switch ($_GET['lang']) {
                case $_GET['lang'] == 'EN' or $_GET['lang'] == 'en':
                    $_SESSION['lang'] = 'EN';
                    $_SESSION['curency'] = 'EUR';
                    // header('location:' . $actual_link);
                    break;
                case $_GET['lang'] == 'RO' or $_GET['lang'] == 'ro':
                    $_SESSION['lang'] = 'RO';
                    $_SESSION['curency'] = 'RON';
                    break;
            }
        }

        if (isset($_SESSION['lang'])) {
            switch ($_SESSION['lang']) {
                case 'EN':
                    $words = [
                        'Header' => [
                            'Welcome' => 'Welcome',
                            'Edit Profile Details' => 'Edit Profile Details',
                            'Logout' => 'Logout',
                            'Search Here' => 'search here',
                            'Dashboard' => 'Dashboard',
                            'Catalog' => 'Catalog',
                            'Categories' => 'Categories',
                            'Products' => 'Products',
                            'Sales' => 'Sales',
                            'System' => 'System',
                            'Orders' => 'Orders',
                            'invoices' => 'invoices',
                            'Customers' => 'Customers',
                            'Coupons' => 'Coupons',
                            'Send Mail' => 'Send Mail',
                            'Settings' => 'Settings',
                            'Localization' => 'Localization',
                            'Data' => 'Data',
                            'Logs' => 'Logs',
                            'Messages' => 'Messages',
                            'Users' => 'Users',
                            'User Groups' => 'User Groups',
                            'Store Details' => 'Store Details',
                            'Mail' => 'Mail',
                            'System' => 'System',
                            'Currencies' => 'Currencies',
                            'Countries' => 'Countries',
                            'Backup / Restore' => 'Backup / Restore',
                            'Datasets' => 'Datasets',
                            'Import / Export' => 'Import / Export',
                            'Install/Upgrade History' => 'Install/Upgrade History',
                            'Error Logs' => 'Error Logs',
                            'Scheduled Tasks' => 'Scheduled Tasks',
                            'go back to the store' => 'go back to the store',
                        ],

                        'DashBoard' => [
                            'Latest 10 Orders' => 'Latest 10 Orders',
                            'Status' => 'Status',
                            'Total' => 'Total',
                            'Latest Registrations' => 'Latest Registrations',
                            'Customer Name' => 'Customer Name',
                            'Email' => 'Email',
                            'Action' => 'Action',
                        ],

                        'Categories' => [
                            'id' => 'id',
                            'Category Name' => 'Category Name'
                        ],

                        'Products' => [
                            'Product ID' => 'Product ID',
                            'Product Name' => 'Product Name',
                            'Price' => 'Price',
                            'In Stock' => 'In Stock',
                            'Date' => 'Date',
                            'visibility' => 'visibility',
                        ],

                        'Orders' => [
                            'Order ID' => 'Order ID',
                            'Date' => 'Date',
                            'Status' => 'Status',
                            'Customer' => 'Customer',
                            'Address' => 'Address',
                            'country/region' => 'country/region',
                            'city' => 'city',
                            'Postal Code' => 'Postal Code',
                            'phone number' => 'phone number',
                            'Product Name' => 'Product Name',
                            'Quantity' => 'Quantity',
                            'Delivery cost' => 'Delivery cost',
                            'Sub Total' => 'Sub Total',
                            'Total' => 'Total',
                        ],

                        'Customers' => [
                            'id' => 'id',
                            'First Name' => 'First Name',
                            'Last Name' => 'Last Name',
                            'username' => 'username',
                            'Email' => 'Email',
                            'phone number' => 'phone number',
                            'description' => 'description',
                            'newsletter' => 'newsletter',
                        ],

                        'Coupons' => [
                            'Coupons ID' => 'Coupons ID',
                            'Status' => 'Status',
                            'Coupon Name' => 'Coupon Name',
                            'Discount' => 'Discount',
                            'Date Start' => 'Date Start',
                            'Date End' => 'Date End'
                        ],

                        'SendMail' => [
                            'Send Mail' => 'Send Mail',
                            'To' => 'To',
                            'Manualy selected customers' => 'Manualy selected customers',
                            'All Customers' => 'All Customers',
                            'To customers who ordered selected products' => 'To customers who ordered selected products',
                            'select customers' => 'select customers',
                            'Subject' => 'Subject',
                            'Message body' => 'Message body',
                            'Send' => 'Send'
                        ],

                        'Store Details' => [
                            'Edit Settings' => 'Edit Settings',
                            'Store Name' => 'Store Name',
                            'Store URL' => 'Store URL',
                            'Secure Store URL' => 'Secure Store URL',
                            'Title' => 'Title',
                            'Meta Tag Description' => 'Meta Tag Description',
                            'Meta Keywords' => 'Meta Keywords',
                            'Welcome Message' => 'Welcome Message',
                            'Store Owner' => 'Store Owner',
                            'Address' => 'Address',
                            'E-Mail' => 'E-mail',
                            'Telephone' => 'Telephone',
                            'Country' => 'Country',
                        ],

                        'Mail' => [
                            'Edit Settings' => 'Edit Settings',
                            'Mail Protocol' => 'Mail Protocol',
                            'Mail' => 'Mail',
                            'SMTP' => 'SMTP',
                            'Mail Parameters' => 'Mail Parameters',
                            'SMTP Host' => 'SMTP Host',
                            'SMTP Username' => 'SMTP Username',
                            'SMTP Password' => 'SMTP Password',
                            'SMTP Port' => 'SMTP Port',
                            'SMTP Timeout' => 'SMTP Timeout',
                            'Alert Mail' => 'Alert Mail',
                            'Additional Alert E-Mails' => 'Additional Alert E-Mails',
                        ],

                        'System' => [
                            'Edit Settings' => 'Edit Settings',
                            'Control Panel Session Expiration' => 'Control Panel Session Expiration',
                            'Maintenance Mode' => 'Maintenance Mode',
                            'Cache enabled' => 'Cache enabled',
                            'Resource Library Upload Max File Size, kB' => 'Resource Library Upload Max File Size, kB',
                            'Display Errors' => 'Display Errors',
                            'Log Errors' => 'Log Errors',
                            'Error Log Filename' => 'Error Log Filename',
                            'System Check' => 'System Check',
                        ],

                        'users' => [
                            'id' => 'id',
                            'username' => 'username',
                            'Group' => 'Group',
                            'Email' => 'Email',
                            'Date Added' => 'Date Added',
                        ],

                        'Group' => [
                            'id' => 'id',
                            'User Group Name' => 'User Group Name',
                        ],

                        'currency' => [
                            'Currency Title' => 'Currency Title',
                            'Code' => 'Code',
                            'Value' => 'Value',
                            'Last Updated' => 'Last Updated',
                            'Status' => 'Status',
                        ],

                        'countries' => [
                            'Country Name' => 'Country Name',
                            'ISO Code' => 'ISO Code',
                        ],


                        'Error Logs' => [
                            'Error Log' => 'Error Log',
                            'Clear Log' => 'Clear Log'
                        ],

                        'Messages' => [
                            'Status' => 'Status',
                            'Message Title' => 'Message Title',
                            'Date' => 'Date',
                        ],
                    ];
                    break;
                case 'RO':
                    $words = [
                        'Header' => [
                            'Welcome' => 'Bine ati venit',
                            'Edit Profile Details' => 'Editați detaliile profilului',
                            'Logout' => 'Deconectare',
                            'Search Here' => 'caută aici',
                            'Dashboard' => 'tablou de bord',
                            'Catalog' => 'Catalog',
                            'Categories' => 'Categorii',
                            'Products' => 'Produse',
                            'Sales' => 'Vânzări',
                            'System' => 'Sistem',
                            'Orders' => 'Comenzi',
                            'invoices' => 'facturi',
                            'Customers' => 'Clienți',
                            'Coupons' => 'Cupoane',
                            'Send Mail' => 'Trimite e-mail',
                            'Settings' => 'Setări',
                            'Localization' => 'Localizare',
                            'Data' => 'Date',
                            'Logs' => 'Logs',
                            'Messages' => 'Mesaje',
                            'Users' => 'Utilizatori',
                            'User Groups' => 'Grupuri de utilizatori',
                            'Store Details' => 'Detalii magazin',
                            'Mail' => 'Poștă',
                            'System' => 'Sistem',
                            'Currencies' => 'Monede',
                            'Countries' => 'Țări',
                            'Backup / Restore' => 'Backup / Restaurare',
                            'Datasets' => 'Seturi de date',
                            'Import / Export' => 'Import Export',
                            'Install/Upgrade History' => 'Istoricul instalării/actualizărilor',
                            'Error Logs' => 'Jurnalele de erori',
                            'Scheduled Tasks' => 'Sarcini programate',
                            'go back to the store' => 'intoarce-te la magazin',
                        ],

                        'DashBoard' => [
                            'Latest 10 Orders' => 'Ultimele 10 comenzi',
                            'Status' => 'stare',
                            'Total' => 'Total',
                            'Latest Registrations' => 'Ultimele înregistrări',
                            'Customer Name' => 'Numele clientului',
                            'Email' => 'Email',
                            'Action' => 'Acțiune',
                        ],

                        'Categories' => [
                            'id' => 'id',
                            'Category Name' => 'Nume categorie'
                        ],

                        'Products' => [
                            'Product ID' => 'ID produs',
                            'Product Name' => 'Nume produs',
                            'Price' => 'Preț',
                            'In Stock' => 'În stoc',
                            'Date' => 'Dată',
                            'visibility' => 'vizibilitate',
                        ],

                        'Orders' => [
                            'Order ID' => 'ID de comandă',
                            'Date' => 'Dată',
                            'Status' => 'Stare',
                            'Customer' => 'Client',
                            'Address' => 'Adresă',
                            'country/region' => 'țară/regiune',
                            'city' => 'oraș',
                            'Postal Code' => 'Cod poștal',
                            'phone number' => 'număr de telefon',
                            'Product Name' => 'Nume produs',
                            'Quantity' => 'Cantitate',
                            'Delivery cost' => 'Cost livrare',
                            'Sub Total' => 'Sub Total',
                            'Total' => 'Total',
                        ],

                        'Customers' => [
                            'id' => 'id',
                            'First Name' => 'Nume',
                            'Last Name' => 'Numele de familie',
                            'username' => 'nume de utilizator',
                            'Email' => 'Email',
                            'phone number' => 'număr de telefon',
                            'description' => 'Descriere',
                            'newsletter' => 'buletin informativ',
                        ],

                        'Coupons' => [
                            'Coupons ID' => 'ID cupoane',
                            'Status' => 'stare',
                            'Coupon Name' => 'nume cupon',
                            'Discount' => 'reducere',
                            'Date Start' => 'data începerii',
                            'Date End' => 'data încheierii'
                        ],

                        'SendMail' => [
                            'Send Mail' => 'Trimite e-mail',
                            'To' => 'Către',
                            'Manualy selected customers' => 'Clienți selectați manual',
                            'All Customers' => 'Toți clienții',
                            'To customers who ordered selected products' => 'Către clienții care au comandat produsele selectate',
                            'select customers' => 'Selectați clienți',
                            'Subject' => 'Subiect',
                            'Message body' => 'Corpul mesajului',
                            'Send' => 'Trimite'
                        ],

                        'Store Details' => [

                            'Edit Settings' => 'Editează setările',
                            'Store Name' => 'Numele magazinului',
                            'Store URL' => 'Adresa URL magazin',
                            'Secure Store URL' => 'Adresa URL a magazinului securizat',
                            'Title' => 'Titlu',
                            'Meta Tag Description' => 'Descriere metaetichetă',
                            'Meta Keywords' => 'Cuvinte cheie meta',
                            'Welcome Message' => 'Mesaj de intampinare',
                            'Store Owner' => 'Proprietar magazin',
                            'Address' => 'Adresă',
                            'E-Mail' => 'E-mail',
                            'Telephone' => 'număr de telefon',
                            'Country' => 'Țară',
                        ],

                        'Mail' => [
                            'Edit Settings' => 'Editează setările',
                            'Mail Protocol' => 'Protocol de e-mail',
                            'Mail' => 'Poștă',
                            'Mail Parameters' => 'Parametri de e-mail',
                            'SMTP Host' => 'Gazdă SMTP',
                            'SMTP Username' => 'Nume de utilizator SMTP',
                            'SMTP Password' => 'Parolă SMTP',
                            'SMTP Port' => 'Port SMTP',
                            'SMTP Timeout' => 'Timp de expirare SMTP',
                            'Alert Mail' => 'E-mail de alertă',
                            'Additional Alert E-Mails' => 'E-mailuri suplimentare de alertă',
                        ],

                        'System' => [
                            'Edit Settings' => 'Editează setările',
                            'Control Panel Session Expiration' => 'Expirarea sesiunii din panoul de control',
                            'Maintenance Mode' => 'modul de întreținere',
                            'Cache enabled' => 'Cache-ul activat',
                            'Resource Library Upload Max File Size, kB' => 'Dimensiunea maximă a fișierului de încărcare a bibliotecii de resurse, kB',
                            'Display Errors' => 'Afișează erori',
                            'Log Errors' => 'Erori de jurnal',
                            'Error Log Filename' => 'Nume fișier jurnal de erori',
                            'System Check' => 'Verificarea sistemului',
                        ],

                        'users' => [
                            'id' => 'id',
                            'username' => 'nume de utilizator',
                            'Group' => 'grup',
                            'Email' => 'Email',
                            'Date Added' => 'Data Adăugării',
                        ],

                        'Group' => [
                            'id' => 'id',
                            'User Group Name' => 'Numele grupului de utilizatori',
                        ],

                        'currency' => [
                            'Currency Title' => 'Titlul valutar',
                            'Code' => 'Cod',
                            'Value' => 'Valoare',
                            'Last Updated' => 'Ultima actualizare',
                            'Status' => 'stare',
                        ],

                        'countries' => [
                            'Country Name' => 'Numele tarii',
                            'ISO Code' => 'Cod ISO',
                        ],


                        'Error Logs' => [
                            'Error Log' => 'Jurnal de erori',
                            'Clear Log' => 'Curăță Jurnalul'
                        ],

                        'Messages' => [
                            'Status' => 'stare',
                            'Message Title' => 'Titlul mesajului',
                            'Date' => 'Dată',
                        ],


                    ];
                    break;
                default:
                    break;
            }
        } else {
            $_SESSION['lang'] = 'EN';
            $_SESSION['curency'] = 'EUR';
            header('refresh:0;');
        }

        return $this->words = $words;
    }
}
