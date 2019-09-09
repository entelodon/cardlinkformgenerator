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
  'orderid' => '',
  'orderDesc' => '',
  'orderAmount' => '',
  'currency' => '',
  'billCountry' => '',
  'billState' => '',
  'billZip' => '',
  'billCity' => '',
  'billAddress' => ''
];

var_dump($cardlinkFormGenerator->generate($form));
```
