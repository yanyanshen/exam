<?php
header('Content-type:text/html;charset=utf-8');
/*沈艳艳
    @查询每个章节的数目 封装的类
    @ $sub 科目
    @param string $chapter1 章节1
    @param string $chapter2 章节2
    @param string $chapter3 章节3
    @param string $chapter4 章节4
    @param string $chapter5 章节5
    @param string $chapter6 章节6
    @param string $chapter7 章节7
    @param string $c        用来区分是我的题库还是章节练习
    @return string $count 每个章节的题目数量
  */
function subject ($sub,$chapter1,$chapter2,$chapter3,$chapter4,$chapter5,$chapter6,$chapter7,$type,$c){
    if($type==2||$type==3){
        $type=1;
    }
    foreach($sub as $k=>$v){
        if($v['chapter']==1){
            $sub[$k]['num']=$chapter1;
            $sub[$k]['type']=$type;
            $sub[$k]['mc']=$c;
        }
        if($v['chapter']==2){
            $sub[$k]['num']=$chapter2;
            $sub[$k]['type']=$type;
            $sub[$k]['mc']=$c;
        }
        if($v['chapter']==3){
            $sub[$k]['num']=$chapter3;
            $sub[$k]['type']=$type;
            $sub[$k]['mc']=$c;
        }
        if($v['chapter']==4){
            $sub[$k]['num']=$chapter4;
            $sub[$k]['type']=$type;
            $sub[$k]['mc']=$c;
        }
        if($v['chapter']==5){
            $sub[$k]['num']=$chapter5;
            $sub[$k]['type']=0;
            $sub[$k]['mc']=$c;
        }
        if($v['subject']==1){
            if($v['chapter']==6){
                $sub[$k]['num']=$chapter6;
                $sub[$k]['type']=2;
                $sub[$k]['mc']=$c;
            }
        }else{
            if($v['chapter']==6){
                $sub[$k]['num']=$chapter6;
                $sub[$k]['type']=0;
                $sub[$k]['mc']=$c;
            }
        }

        if($v['subject']==2){
            if($v['chapter']==7){
                $sub[$k]['num']=$chapter7;
                $sub[$k]['type']=0;
                $sub[$k]['mc']=$c;
            }
        }else{
            if($v['chapter']==7){
                $sub[$k]['num']=$chapter7;
                $sub[$k]['type']=3;
                $sub[$k]['mc']=$c;
            }
        }

    }
    return $sub;
}

/*沈艳艳
@param string   $string 字符串
@param string   $str    子字符串
@param return   $new_str      将字符串移除后返回的新的字符串
*/
function remove_string($string,$str){
    $string = ','.$string.',';
    $new_str = preg_replace("/,$str,/i",',',$string);
    $data['questionid'] = trim($new_str,',');
    M('exam_collect')->where(array('userid'=>session('mid')))->save($data);
    return '移除成功';
}



//php获取从百度搜索进入网站的关键词


function search_word_from() {
    $referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
    if(strstr( $referer, 'baidu.com')){ //百度
        preg_match( "|baidu.+wo?r?d=([^\\&]*)|is", $referer, $tmp );
        $keyword = urldecode( $tmp[1] );
        $from = '百度'; //
    }elseif(strstr( $referer, 'google.com') or strstr( $referer, 'google.cn')){ //谷歌
        preg_match( "|google.+q=([^\\&]*)|is", $referer, $tmp );
        $keyword = urldecode( $tmp[1] );
        $from = '谷歌';
    }elseif(strstr( $referer, 'so.com')){ //360搜索
        preg_match( "|so.+q=([^\\&]*)|is", $referer, $tmp );
        $keyword = urldecode( $tmp[1] );
        $from = '360';
    }elseif(strstr( $referer, 'sogou.com')){ //搜狗
        preg_match( "|sogou.com.+query=([^\\&]*)|is", $referer, $tmp );
        $keyword = urldecode( $tmp[1] );
        $from = '搜狗';
    }elseif(strstr( $referer, 'soso.com')){ //搜搜
        preg_match( "|soso.com.+w=([^\\&]*)|is", $referer, $tmp );
        $keyword = urldecode( $tmp[1] );
        $from = '搜搜';
    }else {
        $keyword ='';
        $from = '';
    }
    return array('keyword'=>$keyword,'from'=>$from);
    /*
     *  $word = search_word_from();
        if(!empty($word['keyword'])) {
            echo '关键字：' . $word['keyword'] . ' 来自：' . $word['from'];
        }*/
}



