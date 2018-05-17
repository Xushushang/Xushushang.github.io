<?php
error_reporting(E_ALL||~E_NOTICE);
header('Content-type:text/html;charset=utf-8');
require_once "jssdk.php";
$jssdk = new JSSDK("wx9fbf438f1e3869b9", "20b1bc60997c3781261a165f4e2134e4");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
  <title>微信-混合开发-JSSDK</title>
  <style>
        *{
            padding: 0;
            margin:0;
        }
        h1{
            text-align: center;
        }
        html,body, .app{
            width:100%;
            height:100%;
        }
        .app{
            width:100%;
            height:100%;
            /* overflow:auto; */
            box-sizing: border-box;
        }
        #boxImg{
            width:90%;
            height:70%;
            margin:10px auto;
            box-shadow: 0 0 10px red;
            border-radius: 6px;
            box-sizing: border-box;
        }
        #imgbtn,#scan{
            width:80%;
            margin:20px auto;
            height:50px;
            box-shadow: 0 0 10px #ddd;
            background: brown;
            color:#fff;
            font-size: 28px;
            text-align: center;
            line-height: 50px;
        }
        p{
            width:90%;
            height:40%;
            font-size: 24px;
            text-align: center;
            color:yellowgreen;
            margin:10px auto;
            box-shadow: 0 0 10px #ddd;
        }
    </style>
</head>
<body>

    <h1>微信-SDK混合开发</h1>
    <div id="boxImg"></div>
    <div id="imgbtn">点击拍照</div>
    <div id="scan" >扫描二维码</div>
    <div id="start" >开始录音</div>
    <div id="end" >结束录音</div>
    <div id="stop" >停止播放</div>
    
    <p id="geolocation">获取地理定位中....</p>
</body>
<script type="text/javascript" src="http://www.meiyulu.com.cn/base/js/jquery-1.10.1.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script>
  wx.config({
    debug: true,//上线就要设置成false
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
  });
  wx.ready(function () {
   //网络状态
   wx.getNetworkType({
        success: function (res) {
        var networkType = res.networkType; // 返回网络类型2g，3g，4g，wifi
         alert(networkType)
        }
    });
    //拍照
    document.getElementById("imgbtn").onclick=function(){
        alert("kaishi拍照");
        wx.chooseImage({
            count: 1, // 默认9
            sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
            sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
            success: function (res) {
            var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
            alert(localIds);
            var boxImg=document.getElementById("boxImg");
            boxImg.style.backgroundImage = "url("+localIds()+")";
            boxImg.style.backgroundSize = "cover";
            }
        });
    }
    //扫描二维码
    document.getElementById("scan").onclick=function(){
        alert("saomiao二维码");
        wx.scanQRCode({
        needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
        scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
        success: function (res) {
            var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
            window.location.href = result;
            }
        });
    }
    //录音功能
    var localId=null;
    $("#start").on("click",function(){//开始录音

    })
    //获取地理定位
    docuemnt.getElementById("geolocation").innerHTML=""

  });
  wx.error(function(res){
 
    alert(res);
  })
</script>
</html>
