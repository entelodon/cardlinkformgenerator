<?php


class CardlinkFormGenerator
{
    private static $scheme = [
        //NAME => isRequired
        //GENERAL:
        'version' => true,
        'mid' => true,

        'lang' => false,
        'deviceCategory' => false,
        'orderid' => true,
        'orderDesc' => true,
        'orderAmount' => true,

        'currency' => true,

        //Payer
        'payerEmail' => false,
        'payerPhone' => false,

        //Bill
        'billCountry' => true,
        'billState' => true,
        'billZip' => true,
        'billCity' => true,
        'billAddress' => true,

        //Optional Description
        'weight' => false,
        'dimensions' => false,
        'shipCountry' => false,
        'shipState' => false,
        'shipZip' => false,
        'shipCity' => false,
        'shipAddress' => false,
        'addFraudScore' => false,
        'maxPayRetries' => false,
        'reject3dsU' => false,
        'payMethod' => false,
        'trType' => false,
        'extInstallmentoffset' => false,
        'extInstallmentperiod' => false,
        'extRecurringfrequency' => false,
        'extRecurringenddate' => false,
        'blockScore' => false,
        'cssUrl' => false,

        //Callback
        'confirmUrl' => true,
        'cancelUrl' => true,

        //Bonus
        'var1' => false,
        'var2' => false,
        'var3' => false,
        'var4' => false,
        'var5' => false,
        'var6' => false,
        'var7' => false,
        'var8' => false,
        'var9' => false,

        //Safety
        'digest' => true
    ];
    private $secret;
    private $confirmUrl;
    private $cancelUrl;
    private $version;
    private $mid;

    /**
     * CardlinkFormGenerator constructor.
     * @param string $confirmUrl
     * @param string $cancelUrl
     * @param string $mid
     * @param string $secret
     */
    public function __construct(string $confirmUrl, string $cancelUrl, string $mid, string $version, string $secret = 'Cardlink1')
    {
        $this->confirmUrl = $confirmUrl;
        $this->cancelUrl = $cancelUrl;
        $this->secret = $secret;
        $this->version = $version;
        $this->mid = $mid;
    }

    /**
     * @param array $userForm
     * @return array
     * @throws Exception
     */
    public function generate(array $userForm)
    {
        $result = [];
        foreach (self::$scheme as $key => $isRequired) {
            $givenValue = $userForm[$key] ?? null;

            switch ($key) {
                case 'digest':
                    $result[$key] = $this->calculateDigest($result);
                    break;
                case 'version':
                case 'mid':
                case 'confirmUrl':
                case 'cancelUrl':
                    $result[$key] = $this->$key;
                    break;
                default:
                    if ($givenValue == null && $isRequired) {
                        throw new Exception('Field ' . $key . ' is required!');
                    } elseif ($givenValue !== null) {
                        $result[$key] = $givenValue;
                    }
            }
        }

        return $result;
    }

    /**
     * @param array $data
     * @return string
     */
    private function calculateDigest(array $data)
    {
        $dataString = implode('', $data);
        $dataString .= $this->secret;
        return base64_encode(hash("sha256", utf8_encode($dataString), true));
    }
}
