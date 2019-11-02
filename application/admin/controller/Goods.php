<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {


        $data = $this->request->get();
        if (isset($data['page']) && !empty($data['page'])) {
            $page = $data['page'];
        } else {
            $page = 1;
        }
        if (isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 2;
        }
        $sarr = [];
        if(isset($data['cid'])&&!empty($data['cid'])){
            $sarr['cid'] = $data['cid'];
        };
        if(isset($data['gname'])&&!empty($data['gname'])){
            $sarr['gname'] = ['like','%'.$data['gname'].'%'];
        };
        if(isset($data['min_price'])&&!empty($data['min_price'])&&isset($data['max_price'])&&!empty($data['max_price'])){
            $sarr['sale'] = [
                'between',[$data['min_price'],$data['max_price']]
            ];
        };

        $result = Db::table('goods')->alias('g')->join('category', 'g.cid=category.id')

            ->field('g.gid,g.gname,g.mprice,g.sale,g.stock,g.volume,g.thumb,g.description,g.norms,category.cname')
            ->where($sarr)
            ->paginate($limit,false,[
                'page'=>$page

            ]);




//        $model = model('Goods');
//        $result = $model->query();
        $count = $result->total();

        $goods=$result->items();
        if($count>0&&count($goods)>0){
            return json([
                'code' => config('code.success'),
                'msg' => '分类查询成功',
                'data' => $goods,
                'count' => $count
                ]);
        }

        else {
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
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $this->request->post();


        $model = model('Goods');
        $res = $model->insert($data);
        if ($res > 0) {
            return json([
                'code' => config('code.success')
                , 'msg' => '分类添加成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail')
                , 'msg' => '分类添加失败'
            ]);
        }

        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {

        $model = model('Goods');

        $result = $model->selectupdates($id);


        if ($result) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品信息获取成功',
                'data' => $result
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品信息获取失败',

            ]);
        }
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->request->put();


        $model = model('Goods');

        $res = $model->updateedit($data, $id);

        if ($res) {
            return json([
                'code' => config('code.success'),
                'msg' => '数据修改成功',
//                'data'=>$res
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '数据修改失败',
            ]);
        }
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $model = model('Goods');
        $result = $model->del($id);
        if ($result > 0) {
            return json([
                'code' => config('code.success')
                , 'msg' => '数据删除成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail')
                , 'msg' => '数据删除失败'
            ]);
        }

    }
    //

}
