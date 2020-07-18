<?php

namespace admin\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use admin\controllers\BaseController;
use common\helpers\Utils;

use common\models\ManageUser;
use common\models\User;
use common\models\Experiences;
use common\models\ExperiencesOrder;

class DashboardController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','top-vendors','top-experiences-by-order','get-all-counts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [

                ],
            ],
        ];
    }

    public function init(){
        if (Yii::$app->user->isGuest) {
            throw new \yii\web\UnauthorizedHttpException();
        }
    }
    public function actionIndex()
    {
        return $this->render('@app/views/dashboard/index',['data'=>[]]);
    }

    public function actionGetAllCounts(){

        if( (Yii::$app->request->isAjax) && (Yii::$app->request->isGet) ){

            $_from_date = Yii::$app->request->get('_from_date');
            $_to_date = Yii::$app->request->get('_to_date');
            if($_from_date == NULL){
                $_from_date = date('Y-m-01');
            }

            if($_to_date == NULL){
                $_to_date = date('Y-m-t');
            }

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return array(
                'total_exp_count' => $this->totalExpCounts($_from_date,$_to_date),
                'total_orders_count' => $this->totalOrders($_from_date,$_to_date),
                'total_users_count' => $this->totalUsers($_from_date,$_to_date),
                'total_vendors_count' => $this->totalVendors($_from_date,$_to_date)
           );
        }
    }

    public function actionTopVendors(){
        if( (Yii::$app->request->isAjax) && (Yii::$app->request->isGet) ) {

            $_from_date = Yii::$app->request->get('_from_date');
            $_to_date = Yii::$app->request->get('_to_date');
            if($_from_date == NULL){
                $_from_date = date('Y-m-01');
            }

            if($_to_date == NULL){
                $_to_date = date('Y-m-t');
            }

            $rows = (new \yii\db\Query())
                ->select(["COUNT(E.user_id) as y", 'UCASE(CONCAT_WS(" ",U.first_name,U.last_name)) as label'])
                ->from('experiences_order as EO')
                ->join('INNER JOIN', 'experiences as E', 'E.id = EO.experience_id')
                ->join('INNER JOIN', 'user as U', 'E.user_id = U.id')
                ->where('U.role_id  = 2')
                ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") >='."'".$_from_date."'")
                ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") <='."'".$_to_date."'")
                ->groupBy('E.user_id')
                ->limit(5)
                ->all();
//            var_dump($rows->prepare(Yii::$app->db->queryBuilder)->createCommand()->rawSql);die;
            if( $rows ){
                return $this->renderAjax('@app/views/dashboard/top_five_vendors', [
                    'data' => $rows
                ]);
            }else{ return '<div class="no_chart_avaliable chart_pre_loader"> No Chart Data Found </div>'; }

        }
    }

    public function actionTopExperiencesByOrder(){
        if( (Yii::$app->request->isAjax) && (Yii::$app->request->isGet) ) {

            $where['E.status'] = 1;
            if(Yii::$app->user->identity->role_id == '2'){
                $where['E.user_id'] = Yii::$app->user->identity->id;
            }

            $_from_date = Yii::$app->request->get('_from_date');
            $_to_date = Yii::$app->request->get('_to_date');
            if($_from_date == NULL){
                $_from_date = date('Y-m-01');
            }

            if($_to_date == NULL){
                $_to_date = date('Y-m-t');
            }

            $rows = (new \yii\db\Query())
                ->select(["COUNT(EO.experience_id) as y", 'EO.experience_id as label'])
                ->from('experiences_order as EO')
                ->join('INNER JOIN', 'experiences as E', 'E.id = EO.experience_id')
                ->where($where)
                ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") >='."'".$_from_date."'")
                ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") <='."'".$_to_date."'")
                ->groupBy('EO.experience_id')
                ->limit(5)
                ->all();

            if( $rows ){
                return $this->renderAjax('@app/views/dashboard/top_experiences_orders', [
                    'data' => $rows
                ]);
            }else{ return '<div class="no_chart_avaliable chart_pre_loader"> No Chart Data Found </div>'; }

        }
    }

    //Get Total Experiences count
    protected function totalExpCounts($start,$end){
        $where =  array('status' => 1);
        if(Yii::$app->user->identity->role_id == '2'){
            $where['user_id'] = Yii::$app->user->identity->id;
        }

        $rows = (new \yii\db\Query())
            ->select(['id'])
            ->from('experiences')
            ->where($where)
            ->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") >='."'".$start."'")
            ->andWhere('DATE_FORMAT(created_at,"%Y-%m-%d") <='."'".$end."'")
            ->count();
        return $rows;
    }

    //Get Total Orders count
    protected function totalOrders($start,$end){
        $where =  array();
        if(Yii::$app->user->identity->role_id == '2'){
            $where['E.user_id'] = Yii::$app->user->identity->id;
        }

        $rows = (new \yii\db\Query())
            ->select(['id'])
            ->from('experiences_order as EO')
            ->join('INNER JOIN', 'experiences E', 'E.id = EO.experience_id')
            ->where($where)
            ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") >='."'".$start."'")
            ->andWhere('DATE_FORMAT(EO.created_at,"%Y-%m-%d") <='."'".$end."'")
            ->count();
        return $rows;

    }

    //Get Total Users count
    protected function totalUsers($start,$end){
        if(Yii::$app->user->identity->role_id == '2'){
            return 0;
        }else{
            $rows = (new \yii\db\Query())
                ->select(['id'])
                ->from('user as U')
                ->where(['status'=>'1','role_id'=>'3'])
                ->andWhere('DATE_FORMAT(U.created_at,"%Y-%m-%d") >='."'".$start."'")
                ->andWhere('DATE_FORMAT(U.created_at,"%Y-%m-%d") <='."'".$end."'")
                ->count();
            return $rows;
        }
    }

    //Get Total Vendors
    protected function totalVendors($start,$end){

        if(Yii::$app->user->identity->role_id == '2'){
            return 0;
        }else{
            $rows = (new \yii\db\Query())
                ->select(['id'])
                ->from('user as U')
                ->where(['status'=>'1','role_id'=>'2'])
                ->andWhere('DATE_FORMAT(U.created_at,"%Y-%m-%d") >='."'".$start."'")
                ->andWhere('DATE_FORMAT(U.created_at,"%Y-%m-%d") <='."'".$end."'")
                ->count();
            return $rows;
        }
    }

}
