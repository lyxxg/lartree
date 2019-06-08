### 介绍
  高效生成系统树 
  用于无限级分类
 
  例如：楼中楼评论 获取下级分类等 
  
  只会产生一个sql并且速度非常快
   
### 支持
 仅支持adjacency结构
 例如(classify表id(儿子) pid(父亲)  )
 
 
### 测试 (只统计生成树使用的时间)
 ![测试](https://xxh-download.cdn.bcebos.com/test.png)
 
| 数据量(条)  | 时间(s)  | 内存(m) 
|  ---- | ----  | ---   |
| 756   |  0.022 | 0.83   |
| 5256  | 0.075  | 2.84   |
| 11256 | 0.16   | 5.67  |
| 48843 |  0.883 | 24.63 |
|108843 |  1.80  | 52.42


### 傻瓜式一次次查询
![傻瓜式](https://xxh-download.cdn.bcebos.com/forsql.png) 
    查询到1 where pid = 1 
    查询到2 where pid = 2     
    查询到3 where pid = 3        
| 数据量(条)     | 时间(s)  | 内存(m) 
|  ---- | ----   | ---     
| 146   |  0.72  | 2.81    
|  646  |  3.01  |10.84
|  2646 |  13.34|42.91
  
      
  
### 安装
  1. composer require lyxxxh/lartree 
   



#### 查看例子(不使用也可以)
![例子](https://xxh-download.cdn.bcebos.com/ex.png)

    1.在app/config.php的providers添加
      Xxh\LarModel\LarTreeProvider::class
 	2. php artisan vendor:publish --provider="Xxh\LarModel\LarTreeProvider::class"
 	3. 导入user 下面附数据库 （我测试的数据库）
[600条sql](https://xxh-download.cdn.bcebos.com/600.sql)
[4w条sql](https://xxh-download.cdn.bcebos.com/4w.sql)
[10w条sql](https://xxh-download.cdn.bcebos.com/10w.sql)
    

 	
 	
####  生成树使用方法(可参考vendor/lyxxxh/lartree/src/LarController.php)

 ```
 //引入命名空间
 use Xxh\LarTree\Services\LarTreeServices;
 class LarController extends Controller {
 
   use LarTree; //使用LarTree
    public function index()
    {
       //设置需要的字段  为了更快速  不设置也可以
       $this->setField(['id','pid','name']);
        
       //默认是id pid
      // $this->setFatherSonName('子id','父id');
     
      //设置表 把查询到的所有结果先存到$datas变量
      $this->initTableConainer('users');
      
      //最开始的父id
      $data = $this->getTableTree(0);
      
      dd($data);//获取树结构了
    }     
    
    
 }
     

```

#### 自定义


vendor/lyxxxh/lartree/src/LarTree.php使用[trait](https://learnku.com/docs/laravel-core-concept/5.5/trait/3025)

根据需求重写里面的所有方法(看源码)

例如获取文章的评论
你完全可以复制代码 然后重写setDataContainer($data)



  
 
