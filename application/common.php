<?php
// 应用公共文件
use think\Request;
use phpmailer\PHPMailer;
use yuntongxin\smsMobile;

$request=Request::instance();
//请求对象的属性注入
$request->siteName='爱之情人事系统V6.00';

//获取全站配置列表
function confs()
{
    if(cache('root_configs')){
        return cache('root_configs');
    }else{
        $confRes= db('conf')->select();
        //把二维数组转为以en_name为键的数组
        $root_configs=array();
        foreach ($confRes as $v){
            $root_configs[$v['en_name']]=$v['value'];
        }
        //return $configs;
//        if($root_configs['cache']=='开启'){
//            cache('root_configs',$root_configs,$root_configs['cache_time']);
//        }
        return $root_configs;
    }

}

/*生成二维码*/
function getQrcode($url){
    vendor("phpqrcode.phpqrcode");
    $data =$url;
    $level = 'M';// 纠错级别：L、M、Q、H
    $size =10;// 点的大小：1到10,用于手机端4就可以了
    $QRcode = new \QRcode();
    ob_start();
    $QRcode->png($data,false,$level,$size,2);
    $imageString = base64_encode(ob_get_contents());
    ob_end_clean();
    return "data:image/jpg;base64,".$imageString;
}

//加密解密算法
/**
 * @param $value 加密的值
 * @param int $type 0代表加密，1代表解密
 */
function encryption($value='a5201314',$type=0)
{
    $key=config('encryption_key');
    if($type==0){
        return str_replace('=','',base64_encode($value ^ $key));
    }else{
        $value = base64_decode($value);
        return $value ^ $key;
    }
}

//格式化金钱
function format_number($num,$cut) {
    return sprintf("%.".$cut."f",$num);
}

//云通信短信验证通知类方法（单条）
function commonSmsNotice($mobile,$tmp,$arr=array('name'=>'admin'))
{
    //实例化短信接口类
    $sms=new SmsMobile();
    //传入配置文件信息
    $sms::$keyId=config('yuntongxin.keyId');  //短信keyId
    $sms::$keySecret=config('yuntongxin.keySecret');  //短信keySecret
    //执行发送提交
    $response=(array)$sms::sendSms(
        $mobile,
        $tmp,
        $arr,
        config('yuntongxin.sign') //短信签名
    );
    return $response;
}

/**
 * 系统邮件发送函数
 * @param string $tomail 接收邮件者邮箱
 * @param string $name 接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body 邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
function send_mail($tomail, $subject = '', $body = '',$name='system', $attachment = null) {

    $mail = new PHPMailer();            //实例化PHPMailer对象
    $mail->CharSet = 'utf-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                     // 设定使用SMTP服务
    $mail->SMTPDebug = 0;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
    $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl';          // 使用安全协议
    $mail->Host = config('mail.host');              // SMTP 服务器
    $mail->Port = config('mail.port');             // SMTP服务器的端口号
    $mail->Username = config('mail.username');     // SMTP服务器用户名
    $mail->Password = config('mail.password');     // SMTP服务器密码  不是登录密码 是客户端授权密码
    $mail->SetFrom(config('mail.sendAddress'));    //发送邮件地址
    $replyEmail = '';                             //留空则为发件人EMAIL
    $replyName = '';                             //回复名称（留空则为发件人名称）
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($tomail, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}

//请求对象的方法注入
function getSiteUrl(Request $request){//第一个参数必须是Request类型的变量
    return '站点url：'.$request->domain();
}
//注册请求对象的方法，也叫钩子
Request::hook('getSiteUrl','getSiteUrl');//两个参数也可以不同

//百度编辑器的多个实例
function get_ueditor($name,$value='',$height=300){
    $str=<<<HTML
        <script id='$name'  name='$name' type='text/plain'>$value</script>
            <script type="text/javascript">
            var ue = UE.getEditor('$name',{
            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
            toolbars:[[
                'FullScreen',//全屏
                'Undo',//撤销
                'Redo',//重做
                '|',
                'forecolor',//字体颜色
                '|',
                'fontfamily', //字体
                '|',
                'fontsize', //字号
                '|',
                'bold',//加粗
                '|',
                'justifyleft', //居左对齐
                'justifyright', //居右对齐
                'justifycenter', //居中对齐
                'justifyjustify', //两端对齐
                '|',
                'lineheight', //行间距
                'horizontal', //分隔线
                'edittip ', //编辑提示
                'autotypeset', //自动排版
                '|',
                'italic', //斜体
                'unlink',//取消链接
                'underline', //下划线
                '|',
                'formatmatch', //格式刷
                'removeformat', //清除格式
                '|',
                'insertorderedlist', //有序列表
                'insertunorderedlist', //无序列表
                'paragraph', //段落格式
                '|',
                'simpleupload', //单图上传
                'imagenone', //默认
                'imageleft', //左浮动
                'imageright', //右浮动
                'imagecenter', //居中
            ]],
            //focus时自动清空初始化时的内容
            autoClearinitialContent:false,
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //默认的编辑区域高度
            initialFrameHeight:200
            //更多其他参数，请参考ueditor.config.js中的配置项
    });
    </script>
HTML;
    return $str;
}
//字符串截取并且超出显示省略号
function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text,0,$length,'utf8').' …';
    return $text;
}

//字符串截取超出不显示省略号
function _subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text,0,$length,'utf8');
    return $text;
}

//进一取整的函数
function ceils($price)
{
    return ceil($price);
}

//四舍五入的函数
function rounds($price)
{
    return round($price,2);
}

/**
 * 【互亿无线】系统短信发送配置
 */
//将 xml数据转换为数组格式。
function xml_to_array($xml){
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches)){
        $count = count($matches[0]);
        for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
            if(preg_match( $reg, $subxml )){
                $arr[$key] = xml_to_array( $subxml );
            }else{
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}
//请求数据到短信接口，检查环境是否 开启 curl init。
function Post($curlPost,$url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}
//random() 函数返回随机整数。
function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return strtoupper($hash);
}
//兼容php5.5以下
function i_array_column($input, $columnKey, $indexKey=null){
    if(!function_exists('array_column')){
        $columnKeyIsNumber  = (is_numeric($columnKey))?true:false;
        $indexKeyIsNull            = (is_null($indexKey))?true :false;
        $indexKeyIsNumber     = (is_numeric($indexKey))?true:false;
        $result                         = array();
        foreach((array)$input as $key=>$row){
            if($columnKeyIsNumber){
                $tmp= array_slice($row, $columnKey, 1);
                $tmp= (is_array($tmp) && !empty($tmp))?current($tmp):null;
            }else{
                $tmp= isset($row[$columnKey])?$row[$columnKey]:null;
            }
            if(!$indexKeyIsNull){
                if($indexKeyIsNumber){
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && !empty($key))?current($key):null;
                    $key = is_null($key)?0:$key;
                }else{
                    $key = isset($row[$indexKey])?$row[$indexKey]:0;
                }
            }
            $result[$key] = $tmp;
        }
        return $result;
    }else{
        return array_column($input, $columnKey, $indexKey);
    }
}
