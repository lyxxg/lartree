<?php
namespace Xxh\LarTree;

use App\Http\Controllers\Controller;
use Xxh\LarTree\LarTree;
class LarController extends Controller {

    use LarTree;



    public function index()
    {


      //$start_memory = memory_get_usage();
      //$start_time = microtime(true);


        //设置需要的字段  为了更快速  不设置也可以
        $this->setField(['id','pid','name']);

        //设置表
        $this->initTableConainer('users');


        //获取树形数据
        $datas =$this->getTableTree(0);

        $datas = json_encode($datas);

        /*
        $end_memory = memory_get_usage();
        $use_memory = $end_memory - $start_memory;
        $use_memory = $use_memory/1024/1024;
        echo '当前脚本消耗内存大小为：'.$use_memory.'MB';

        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);
        echo " 脚本执行时间 = ".$execution_time." 秒";
        */
        return view('lartree::index',compact('datas'));

    }


}