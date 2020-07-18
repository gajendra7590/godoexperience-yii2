<?php
namespace common\helpers;
use Yii;
use yii\base\ErrorException;
use Stripe\Stripe;
use Stripe\Exception\CardException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\InvalidRequestException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;


class PaymentHelpers
{       
    /**
     * This is function is for charge the payment for user
     */
    public static function charge($obj) { 
        $pk = Yii::$app->components['stripe']['privateKey'];        
        try { 
            Stripe::setApiKey($pk); 
            $charge = \Stripe\Charge::create($obj);  
            return [
                'error'=>false,
                'response'=>$charge
            ]; 
          } catch(CardException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'CardException'
              ];
          } catch (RateLimitException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'RateLimitException'
              ];             
          } catch (InvalidRequestException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'InvalidRequestException'
              ];
             
          } catch (AuthenticationException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'AuthenticationException'
              ];
          } catch (ApiConnectionException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'ApiConnectionException'
              ];
          } catch (ApiErrorException $e) {
              return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'ApiErrorException'
              ];
          } catch (Exception $e) { 
             return [
                'error' => true,
                'http_status' => $e->getHttpStatus(),
                'type' =>  $e->getError()->type,
                'code' =>  $e->getError()->code,
                'message' =>  $e->getError()->message,
                'exception_type' => 'Other'
             ];
          } 
    }
}