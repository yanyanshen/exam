<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Common\Controller\CommonController;
class LandMarkController extends CommonController{
    public function index(){
        //城市
        $city=D('citys')->city_one("flag=1","id,cityname",1);
        if(isset($_REQUEST['cityid'])){
            $cityid=$_REQUEST['cityid'];
            $info=D('citys')->city_one(array('id'=>$_REQUEST['cityid']),'cityname');
            $this->assign('cityname',$info['cityname']);
        }else{
            $cityid=$city[0]['id'];
            $this->assign('cityname',$city[0]['cityname']);
        }
        //区
        $county=D('countys')->Countys_list("cityid=$cityid","id,countyname",1);
        if(isset($_REQUEST['countyid'])){
            $countyid=$_REQUEST['countyid'];
            $info=D('countys')->Countys_list(array('id'=>$_REQUEST['countyid']),'countyname');
            $this->assign('countyname',$info['countyname']);
        }else{
            $countyid=$county[0]['id'];
            $this->assign('countyname',$county[0]['countyname']);

        }
        $land=D('landmark')->lands_list("countyid='$countyid' and cityid=$cityid",'id,cityid,countyid,landname,longitude,latitude',1);
        $this->assign("land",$land);
        $this->assign("cityid",$cityid);
        $this->assign("citys",$city);
        $this->assign("count",count($land));
        $this->assign("countys",$county);
        $this->assign("countyid",$countyid);
        $this->display();
    }

    public function returncounty(){
        $countys=D('Countys')->Countys_list(array('cityid'=>$_POST['cityid']),'id,countyname,cityid',1);
        $this->success($countys) ;
    }

//添加新地标
    function addnewland(){
        if(isset($_POST['landname'])){
            $info=D('landmark')->lands_list(array('countyid'=>$_POST['countyid'],'cityid'=>$_POST['cityid'],'landname'=>$_POST['landname']),'id');

            if($info){
                $res=D('landmark')->land_save(array('id'=>$info['id']),$_POST);
            }else{
                $res=D('landmark')->land_add($_POST);
                $this->success($res);
            }
            if($res){
                $this->success($res);
            }else{
                $this->error($res);
            }
        }
    }




    //删除地标
    public function del_land(){
        $id=$_GET['id'];
        $res=D('landmark')->land_del($id);
        if($res){
            $this->redirect('Admin/LandMark/index',array(),0,"<script>alert('删除成功')</script> ");
        }else{
            $this->redirect('Admin/LandMark/index','',0,"<script>alert('失败')</script> ");
        }
    }


    //点查看可以看到驾校、教练、指导员 的地标
    public function see_land(){
        $type=$_GET['type'];
        switch ($type){
            case 'jx':
                $url='School/jx_list?pid='.$_GET['pid'];
                break;
            case 'jl':
                $url='Coach/index_list?pid='.$_GET['pid'];
                break;
            case 'zd':
                $url='Guider/index_list?pid='.$_GET['pid'];
                break;
        }
        $id=$_GET['id'];
        $info=M('school')->field('id,nickname,cityid')->where("id=$id")->find();
        $cityid=$info['cityid'];
        $county=M('countys')->field("id,countyname")->where("cityid=$cityid")->select();

        //找到该用户已经有的地标
        $land=$this->returnland($id);

        //遍历找各自区、县的地标
        foreach ($county as $k=>$v){
            $county[$k]['land']=M('landmark')->field("id,landname")->where("countyid={$v['id']}")->select();
        }
        $this->assign('county',$county);
        $this->assign('land',$land);
        $this->assign('id',$id);
        $this->assign('info',$info);
        $this->assign('type',$type);
        $this->assign('url',$url);
        $this->display();
    }


    public function returnland($id){
        $where['type_id']=$id;
        $land=M('lands')->where($where)->getField('landmarkid');
        $arr=explode(',',$land);
        return $arr;
    }


    //保存更新地标

    public function save_landmark(){
        $id=$_POST['id'];
        $type=$_POST['type'];
        $where['type_id']=$id;
        $data['type_id']=$id;
        $data['type']=$type;

        $markArr=$_POST['mark_id'];
        $info = M('landsjuli')->where($where)->getField('id');
        if($info){
            M('landsjuli')->where($where)->delete();
        }

        foreach($markArr as $v){
            $idstr.=$v.',';
            $data['landmarkid'] = $v;
            M('landsjuli')->add($data);
        }
        $str=substr($idstr,0,-1);
        $info=M('lands')->where($where)->find();

        if($info){
            $res=M('lands')->where($where)->save(array('landmarkid'=>$str));
        }else{
            $data['landmarkid']=$str;
            $res=M('lands')->add($data);
        }

        if($res){
            $message="<script>alert('更新成功')</script>";
        }else{
            $message="<script>alert('更新失败')</script>";
        }
        $this->redirect("see_land",array('id'=>$id,'type'=>$type),0,$message);
    }
}