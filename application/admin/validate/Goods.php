<?php
/**
 * Created by PhpStorm.
 * User: yhy
 * Date: 2019/10/30
 * Time: 21:48
 */

namespace app\admin\validate;


use think\Controller;

class Goods extends Controller
{
    protected $rule = [
        'gname' => 'require|min:2|max:8',
        'thumb' => 'require',
        'mprice' => 'require|number|min:1|max:8',
        'sele' => 'require|number|min:1|max:8',
        'stock' => 'require|number|min:1|max:8',
        'banner' => 'require',
        'detail' => 'require',
    ];
    protected $message = [
        'thumb' => 'gthumb必填',
        'gname.require' => 'gname必填',
        'gname.min' => 'cname最少2个字段',
        'mprice.min' => 'cname最少1个字段',
        'mprice.require' => 'gmprice必填',
        'sele.require' => 'sele必填',
        'stock.require' => 'gstock必填',
        'banner.require' => 'gbanner必填',
        'detail.require' => 'gdetail必填',
        'sele.min' => 'sele最少1个字段',
        'stock.min' => 'gstock最少1个字段',
    ];
    protected $scene = [
        'insert' => ['thumb', 'name', 'mprice','sele', 'stock', 'banner','detail']
    ];


}