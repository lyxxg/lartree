<?php
namespace Xxh\LarTree;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Xxh\LarTree\Services\LarTreeServices;

trait LarTree
{



    //数据容器
    protected static $datas=[];

    //单例
    protected static $instance;

    //定义父子关系
    protected static  $son = 'id',$father = 'pid';

    //要查询的字段
    protected static  $field=['*'];


    final public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }


    public function __construct()
    {
    
    }


    //把表的数据放到数据容器
    public function initTableConainer($table)
    {


        //这里吃很多内存
        $datas = DB::table($table)->get($this->getField())->toArray();
        $this->setDataContainer($datas);
    }

    //表生成数据
    public function getTableTree($pid)
    {

        $datas = $this->getSonData($pid);
        $father = $this->getFatherName();
        $arr = [];
        if(! count($datas))
            return;

        foreach ($datas as $key=>$data) {

            if ($data[$father] == $pid) {

                $arr[$key] = (array)$data;


                $arr[$key]['child'] = $this->getTableTree($data['id']);
            }
        };

        return $arr;
    }

    public function getDatas()
    {
        return self::$datas;
    }





    //设置数据容器
    public function setDataContainer($datas)
    {

        $all = [];
        $pid = self::$father;
        foreach ($datas as $key=>$data) {
            $all[$data->$pid][] = (array)$data;
        }
        self::$datas = $all;
    }



    //获取从数据容器获取
    public function getDataContainer($pid)
    {

        return self::$datas;
    }


    //获取儿子的数据
    public function getSonData($pid)
    {

        return self::$datas[$pid]??[];
    }



    //设置父亲名称
    public function setFatherName()
    {


    }


    //返回父亲名称
    public function getFatherName()
    {
        return self::$father;
    }


    public function setField($field)
    {
        self::$field = $field;
    }


    public function getField()
    {
        return self::$field;
    }










}
