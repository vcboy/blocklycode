<?php
namespace backend\controllers;
use backend\models\Notice;
use Yii;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Site controller
 */
class DefaultController extends Controller
{
    //控制器渲染视图时使用 @app/views/layouts/default.php 作为布局文件
    public $layout = 'default';
    public $subject;
    public $is_welcome = 1;//是否欢迎页面
    public $childSubject;//子菜单
    public function behaviors()
    {
        /*
         * 权限设置，验证方式：按控制器的action验证
         * 无需登录即可执行的action:login,error
         * 已授权用户登录后才可执行的action:logout，index，clearcache
         * 该规则所有动作的get和post方式下均可用（verbs没有指定action方式的，默认post、get均有效）
         */
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'   => ['login', 'error'],
                        'allow'     => true,
                    ],
                    [
                        'actions'   => ['logout', 'index','clearcache'],
                        'allow'     => true,
                        'roles'     => ['@'],   //其中？代表游客，@代表已登录的用户。
                    ],
                ],
            ],
            'verbs' => [
                'class'     => VerbFilter::className(),
                'actions'   => [
                    'logout' => ['get','post'],
                ],
            ],
        ];
    }

    /**
     * 后台首页
     * @return string
     */
    public function actionIndex(){
        return $this -> render('index');
    }

    /**
     * 用户登录
     * @return string
     */
    public function actionLogin()
    {
        $this -> layout = 'main';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(['plan/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionError(){
        if(Yii::$app -> user -> isGuest) {
            return $this -> goBack();
        }
        return $this->render('error');
    }

    /*
     * 清除缓存
     */
    public function actionClearcache() {
        Yii::$app->cache->flush();
        echo json_encode(array('ok'=>1));
        exit(); 
    }
}