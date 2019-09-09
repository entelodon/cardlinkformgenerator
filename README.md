# cardlinkformgenerator
Demo:
```php
$cardlinkFormGenerator = new CardlinkFormGenerator(
    'https://localhost/confirm',
    'https://localhost/cancel',
    'YOUR_MERCHANT_ID',
    '2',
    'YOUR_CARDLINK_SECRET'
);
$form = [
    'orderid' => 'ORDER_ID',
    'orderDesc' => 'ORDER_DESC',
    'orderAmount' => '100',
    'currency' => 'EUR',
    'billCountry' => 'ATHENS',
    'billState' => 'ATHENS',
    'billZip' => '000000',
    'billCity' => 'ATHENS',
    'billAddress' => 'Somewhere in Athens'
];

var_dump($cardlinkFormGenerator->generate($form));
```
