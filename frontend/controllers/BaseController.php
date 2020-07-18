<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class BaseController extends Controller
{
    public function init() {
        parent::init();
    }

     public function beforeAction($action) {
         $exception = Yii::$app->getErrorHandler()->exception;
         if(parent::beforeAction($action)) {
             if( ($action->id == 'error') && isset($exception->statusCode) && (in_array($exception->statusCode,
                     ['301','308','400','401','403','404','405','408','500','501','502','503','504']) ) ){
                 $message = $this->getStatusCode($exception->statusCode);
                 if(Yii::$app->request->isAjax){
                     Yii::$app->response->format = Response::FORMAT_JSON;
                     return false;
                 }else{
                     Yii::$app->session->setFlash('error', $message);
                     Yii::$app->response->redirect(['/']);
                     return false;
                 }
             }
         }
         return true;
     }


    private function getStatusCode($code){
        switch ($code) {
            case '301':
                return 'Site Moved Permanently';
                break;
            case '308':
                return 'Permanent Redirect';
                break;
            case '400':
                return 'Bad Request Occured';
                break;
            case '401':
                return 'Unauthorized Request';
                break;
            case '403':
                return 'Access Forbidden';
                break;
            case '404':
                return 'Page Not Found';
                break;
            case '405':
                return 'Method Not Allowed';
                break;
            case '408':
                return 'Request Timeout';
                break;
            case '500':
                return 'Internal Server Error';
                break;
            case '501':
                return 'Not Implemented';
                break;
            case '502':
                return 'Bad Gateway';
                break;
            case '503':
                return 'Service Unavailable';
                break;
            case '504':
                return 'Gateway Timeout';
                break;
        }

    }


}