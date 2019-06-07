<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="lartree/css/zTreeStyle/zTreeStyle.css" type="text/css">



</head>
<body>


<ul id="treeDemo" class="ztree"></ul>


</body>
<script type="text/javascript" src="lartree/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="lartree/js/jquery.ztree.core.js"></script>

<script>

    var setting = {
        view: {
            addHoverDom: false,
            removeHoverDom: false,
            selectedMulti: false
        },
        check: {
            enable: true
        },
        data: {


            key: {
                isParent: "isParent",
                children: "child",
                name: "name",
                title: "name",
                url: "url",
                icon: "icon",

            },
            simpleData: {
                enable: false,
                idKey: "id",
                pIdKey: "pid",
                rootPId: null
            },
        },
        edit: {
            enable: true
        }
    };
    var zNodes = {!! $datas !!};



    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    });

</script>
</html>