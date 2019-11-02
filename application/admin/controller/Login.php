<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/29
 * Time: 10:57
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;

class Login extends Controller
{
    public function index(){


        $data=$this->request->post();
        $salt=config('salt');
        $password=$data['password'];
        $data['password']=md5(crypt($password,md5($salt)));
        $res= Db::table('manage')->where($data)->find();

        if($res){
            $payload=['id'=>$res['id'],'names'=>$res['names']];
          $token=JWT::getToken($payload,config('jwtkey'));

            return json([
               'code'=>config('code.success')
               ,'msg'=>"登陆成功",
                'data'=>[
                    'token'=>$token,
                    'names'=>$res['names']
                ]
            ]);

        }else{
            return json([
                'code'=>config('code.fail')
                ,'msg'=>"登陆失败"
            ]);
        }

    }
}