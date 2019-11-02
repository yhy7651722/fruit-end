<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Category extends Controller
{


    public function _initialize()
    {
        checkToken();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */

    public function index()
    {
        $model = model('Category');
        $result = $model->query();
        $count = count($result);
        if ($result > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类查询成功',
                'data' => $result,
                'count'=>$count
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类查询失败'
            ]);
        }
        //
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //cname thumb sort
        //权限 身份
        //请求方式
        //验证参数
        $data=$this->request->post();
        $validate=validate('Category');
        if(!$validate->scene('insert')->check($data)){
            return json([
                'code'=>config('code.fail')
                ,'msg'=>$validate->getError()
            ]);

        }
        $model=model('Category');
        $res=$model->insert($data);
        if($res>0){
            return json([
                'code'=>config('code.success')
                ,'msg'=>'分类添加成功'
            ]);
        }else{
            return json([
                'code'=>config('code.fail')
                ,'msg'=>'分类添加失败'
            ]);
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $model = model('Category');

        $result = $model->selectupdates($id);

        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类获取成功',
                'data' => $result
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类获取失败',

            ]);
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->request->put();


        $model = model('Category');
        $res = $model->updateedit($data,$id);
        if ($res){
            return json([
                'code'=>config('code.success'),
                'msg'=>'数据修改成功',
//                'data'=>$res
            ]);
        }else{
            return json([
                'code'=>config('code.fail'),
                'msg'=>'数据修改失败',
            ]);
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //

        $model=model('Category');
        $result=$model->del($id);
        if($result>0){
            return json([
                'code'=>config('code.success')
                ,'msg'=>'数据删除成功'
            ]);
        }else{
            return json([
                'code'=>config('code.fail')
                ,'msg'=>'数据删除失败'
            ]);
        }

    }
}
