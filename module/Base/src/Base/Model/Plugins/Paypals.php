<?php

namespace Base\Model\Plugins;
use Zend\Session\Container;
class Paypals {

    /**
     * 	Public Vars
     */
    static $environment = 'live';
    //static $environment = 'sandbox';

    function PPHttpPost($methodName_, $nvpStr_) {

        $environment = self::$environment;
        /*
         * Set up your API credentials, PayPal end point, and API version.
         */

	/*
	 * PayPal API details - Visa & Mastercard.
	 */
	define('API_USERNAME', 'info_api1.hedokamasutra.com');
	define('API_PASSWORD', '7RNYZDXCPZX3426P');
	define('API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AE81M0aBqO-vQ.oFMt-OGxqbjSZb');
       $API_UserName = urlencode(API_USERNAME); // set your API username
       $API_Password = urlencode(API_PASSWORD); // set your API password
       $API_Signature = urlencode(API_SIGNATURE); // set your API Signature

        /*
         * Sandbox credentials (For testing purpose only)
         */
       //  $API_UserName = urlencode("ajinkyacanada_api1.yopmail.com"); // set your api username
       // $API_Password = urlencode("1404275476"); // set your api password
       // $API_Signature = urlencode("AFcWxV21C7fd0v3bYYYRCpSSRl31AoBK..oupyyf685LO4UxKZWI3J2H"); 

        $API_Endpoint = "https://api-3t.paypal.com/nvp";
        if ("sandbox" === $environment || "beta-sandbox" === $environment) {
            $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
        }
        $version = urlencode('51.0');

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.
        $nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);


        // Get response from the server.
        $httpResponse = curl_exec($ch);
        $httpResponse = urldecode($httpResponse);
//        echo $httpResponse;die;

        if (!$httpResponse) {
            exit("$methodName_ failed: " . curl_error($ch) . '(' . curl_errno($ch) . ')');
        }

        // Extract the response details.
        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }

        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }

        return $httpParsedResponseAr;
    }

    function PPDoDirectPayment($data,$isResevation = null) {
      //d($data);
     
        $paymentType = urlencode('Sale');    // 'Authorization' or 'Sale'
        if(!empty($data['billName'])){
            $firstName = urlencode($data['billName']);
        }else{
           $firstName = urlencode($data['travellerName']); 
        }
       // $lastName = urlencode($data['last_name']);
        $creditCardType = urlencode($data['typeOfCard']);
        $creditCardNumber = urlencode($data['cardNumber']);
        $expDateMonth = $data['cardMonth'];
        
      
         $expDateYear = urlencode($data['cardYear']);
         $cvv2Number = urlencode($data['cvvNumber']);
         $address1 = urlencode($data['streetname']);
        
      if(!empty($data['billName'])){
         $city = urlencode($data['billCity']);
         $state = urlencode($data['billState']);
         
        // $country = urlencode('US'); 
         $country = urlencode($data['billCountry']);    // US or other valid country code
      }else{
         $city = urlencode($data['travellerCity']);
         $state = urlencode($data['travellerState']);
         $country = urlencode($data['country']); 
      }
      $zip = urlencode($data['travellerZip']);
         $pay_amt=$data['depositAmount'];
  
         $amount = urlencode($pay_amt);
         if($isResevation == 1){
             $amount = urlencode((int)$pay_amt + (int)$data['merchantFee']);
         }

         $currencyID = urlencode($data['currencytype']); 
          
        if (empty($currencyID)) {
           $currencyID = 'USD';
        }
//d($data);
        // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
        // Add request-specific fields to the request string.
          $nvpStr = "&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber" .
                "&EXPDATE=$expDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName" .
                "&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";

       //d($nvpStr);
        // Execute the API operation; see the PPHttpPost function above.
        $httpParsedResponseAr = self::PPHttpPost('DoDirectPayment', $nvpStr);

        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $return['status'] = TRUE;
            $return['message'] = 'Direct Payment Completed Successfully.';
            $return['ACK'] = $httpParsedResponseAr;
            
           // d($return);
            return $return;
        } else {
            $return['status'] = FALSE;
            $return['message'] = 'Direct Payment Failed!';
            $return['ACK'] = $httpParsedResponseAr;
            // d($return);
            return $return;
        }
    }
    
    

    function PPSetExpressCheckout($payment_amount, $currency, $returnURL = null, $cancelURL = null,$referenceNumber=null) {
        $environment = self::$environment;
        $paymentAmount = urlencode($payment_amount);
        $currencyID = urlencode($currency);       // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
        $paymentType = urlencode('Sale');    // or 'Sale' or 'Order'
        $referenceNumber = urlencode($referenceNumber);
       
//      Add request-specific fields to the request string.
        $nvpStr = "&Amt=$paymentAmount&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID&NUMBER=$referenceNumber";
	
//      Execute the API operation; see the PPHttpPost function above.
        $httpParsedResponseAr = self::PPHttpPost('SetExpressCheckout', $nvpStr);
	//d($httpParsedResponseAr);
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            // Redirect to paypal.com.
            $token = urldecode($httpParsedResponseAr["TOKEN"]);

            $payPalURL = " https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=$token&useraction=commit";
            if ("sandbox" === $environment || "beta-sandbox" === $environment) {
                $payPalURL = " https://www.$environment.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=$token&useraction=commit";

            }
            
       //     d($httpParsedResponseAr);
            header("Location: $payPalURL");
            exit;
        } else {
            $response['status'] = 0;
            $response['message'] = 'Set ExpressCheckout Failed!';
            $response['ACK'] = $httpParsedResponseAr;
            return $response;
        }
    }

    

    function PPGetExpressCheckoutDetails($request) {
        /**
         * This example assumes that this is the return URL in the SetExpressCheckout API call.
         * The PayPal website redirects the user to this page with a token.
         */
//      Obtain the token from PayPal.
        if (!array_key_exists('token', $request)) {
            exit('Token is not received.');
        }
	//d($request);
//      Set request-specific fields.
        $token = urlencode(htmlspecialchars($request['token']));
	//echo $request['token']."<br>";
	//echo $token;
//      Add request-specific fields to the request string.
        $nvpStr = "&TOKEN=$token";

//      Execute the API operation; see the PPHttpPost function above.
        $httpParsedResponseAr = self::PPHttpPost('GetExpressCheckoutDetails', $nvpStr);
	//echo "<pre>"; print_r($httpParsedResponseAr);
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            // Extract the response details.
            $payerID = $httpParsedResponseAr['PAYERID'];
            $street1 = $httpParsedResponseAr["SHIPTOSTREET"];
            if (array_key_exists("SHIPTOSTREET2", $httpParsedResponseAr)) {
                $street2 = $httpParsedResponseAr["SHIPTOSTREET2"];
            }
            $city_name = $httpParsedResponseAr["SHIPTOCITY"];
            $state_province = $httpParsedResponseAr["SHIPTOSTATE"];
            $postal_code = $httpParsedResponseAr["SHIPTOZIP"];
            $country_code = $httpParsedResponseAr["SHIPTOCOUNTRYCODE"];
		//d($token);
            $resposne = self::PPDoExpressCheckout($httpParsedResponseAr, $token);
		//d($resposne);
            return $resposne;
            //exit('Get Express Checkout Details Completed Successfully: ' . print_r($httpParsedResponseAr, true));
        } else {
            $response['message'] = 'GetExpressCheckoutDetails failed!';
            $response['ACK'] = $httpParsedResponseAr;
            return $response;
        }
    }

    function PPDoExpressCheckout($httpParsedResponseAr, $token) {
        /**
         * This example assumes that a token was obtained from the SetExpressCheckout API call.
         * This example also assumes that a payerID was obtained from the SetExpressCheckout API call
         * or from the GetExpressCheckoutDetails API call.
         */
       // d($httpParsedResponseAr);
        $reservation = new Container('Reservations');
        
        //d($reservation->reservations);
        $payerID = $httpParsedResponseAr['PAYERID'];
        $street1 = $httpParsedResponseAr["SHIPTOSTREET"];
        if (array_key_exists("SHIPTOSTREET2", $httpParsedResponseAr)) {
            $street2 = $httpParsedResponseAr["SHIPTOSTREET2"];
        }
        $city_name = $httpParsedResponseAr["SHIPTOCITY"];
        $state_province = $httpParsedResponseAr["SHIPTOSTATE"];
        $postal_code = $httpParsedResponseAr["SHIPTOZIP"];
        $country_code = $httpParsedResponseAr["SHIPTOCOUNTRYCODE"];

//      Set request-specific fields.
        $payerID = urlencode($payerID);
        $token = urlencode($token);
        $paymentType = urlencode("Sale");   // or 'Sale' or 'Order'
        //$currency_code = $this->Session->read('currency_info');
	//d($reservation);
        $paymentAmount = $reservation->reservation;//$reservation->reservation->getDepositAmoun();
        //$referenceNumber = $reservation->reservation->getReferenceNumber();
        $currency_code = 'USD';

        $currencyID = urlencode($currency_code);      // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
        // $this->Session->delete('amount');
//      Add request-specific fields to the request string.
        $nvpStr = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";
//      Execute the API operation; see the PPHttpPost function above.
        $httpParsedResponseAr = self::PPHttpPost('DoExpressCheckoutPayment', $nvpStr);

        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            $response['message'] = 'Express Checkout Payment Completed Successfully';
            $response['ACK'] = $httpParsedResponseAr;
            return $response;
        } else {
            $response['message'] = 'Express Checkout Payment Failed!';
            $response['ACK'] = $httpParsedResponseAr;
            return $response;
        }
    }

}


