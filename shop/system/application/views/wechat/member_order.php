<?php $this->load->view('wechat/common_header');?>

  <script>
  $(function(){
    $('li table tbody tr:even').attr('class','order_dafail_ul_li_active');
    $('wechat_order_title_img2').click(function(){
      $('.order_shipping_info').eq($(this).index()).hide();
    });
  });
  </script>   

</div> 
<div class="member_base_infos ">
     
  <!-- order_info -->
    
          <div class="wechat_member_order_title ">
            <img src="/images/icon_dingdan.png">
            <img class="iconfont-fanhui1" width="10px" height="10px" alt="返回" src="/images/iconfont-fanhui1.png">
             <h3>我的订单</h3>
          </div>
          <div class="member_normal_line  ">          
          <!--  img src="/images/search.png" class="order_search_button float_right"/>
             <input type="text" name="search_keywords" placeholder="商品名称，商品编号，订单编号" class="search_keywords float_right"/ -->              
          </div>
    
  
  <?php if($orders){
        foreach($orders as $key=>$val){
    ?>      
      <div class="base_title">
          <div class=" order_sn_div">
             <span>订单编号：</span><?php echo $val->to_order_sn;?>
          </div>
		  
          <ul class="wechat_order_title_img">
            <li class="wechat_order_title_img1 order_detail_li" data_id=<?php echo $val->to_id;?>><img src="/images/xiangqing.png"></li>
            <li class="wechat_order_title_img2 close_order" data_id=<?php echo $val->to_id;?>><img src="/images/sahnchu.png"></li>
           <?php if($val->to_status == 10){?>
		   <li class="wechat_order_title_img3 pay_now_wechat" data_sn="<?php echo $val->to_order_sn;?>" data_pay_way="<?php echo $val->to_pay_way;?>"><img src="/images/zhifu.png"></li>
		   <?php }?>
		  </ul> 
        </div>  
     <div class="order_shipping_info">
        
       <ul class="order_detail_ul">
       
          <li>
            <table>
              <thead>
              <tr>
                <td>用餐日期</td>
                <td>餐品</td>
                <td>份数</td>
                <td>单价(元)</td>
                <td>合计</td>
              </tr>
              </thead>
            <?php $current_date = strtotime(date('Y-m-d'));$temp_count = count($val->order_detail);foreach($val->order_detail as $k=>$v){ 
        ?>   <tbody>
              <tr>
                <td><?php echo $v->service_date;?></td>
                <td><?php for($i=0;$i<5;$i++){$title = 'title'.$i;if($v->$title){ if($i){echo '+';}echo $v->$title;}}?></td>
                <td><?php echo $v->count;?></td>
                <td><?php echo $v->now_price;?></td>
                <td><?php if($val->event){echo $v->count*$val->event->price;}else{echo $v->count*$v->now_price;}?></td>
              </tr>
              </tbody>
              
             <?php }?>

            </table>
            
          </li>
          <li>
            <ul class="receiver_info" data_id=<?php echo $val->to_id;?>>
          <li>收货人：<?php echo $val->to_receiver;?></li>
          <li>手机号码：<?php echo $val->to_mobile;?></li>
          <li>地址：<?php echo $val->to_address;?></li>
          <li>下单时间：<?php echo $val->to_created;?></li>
           <li class="extra_li">订单总金额：<?php echo $val->to_total_amount;?>元</li>
          <li class="extra_li">订单状态：<?php echo $order_status[$val->to_status];?>
               <?php $current_time=date('H:i:s');if(($val->to_status == 10)&&($val->to_pay_way != 'daofu')&&(($val->first_server_date > $current_date)||(($val->first_server_date == $current_date)&&($current_time < $order_time->tc_title)))){?>
                  <span class="extra_span pay_now_wechat" data_sn="<?php echo $val->to_order_sn;?>" data_pay_way="<?php echo $val->to_pay_way;?>">去付款</span>
               <?php }?>
          </li>
          <li class="extra_li">支付方式及金额：
             <?php if($val->coupon_amount){
              echo '优惠券:'.$val->coupon_amount.'元';
           }
           if ($val->to_order_amount){
               if ($val->to_pay_way == 'alipay'){
                echo '支付宝:';
               }else if($val->to_pay_way == 'wechat'){
                echo '微信支付:';
               }else if($val->to_pay_way == 'daofu'){
                echo '货到付款:';
               }
               echo $val->to_order_amount.'元';if($val->to_pay_status==0){echo "(未支付)";}else if($val->to_pay_status==1){echo "(已支付)";}        
           }
         ?> 
          </li> 
         
          <li class="extra_li extra_li_last">备注：<?php echo $val->to_comment;?></li> 
        </ul>
          </li>
       </ul>  
        
     </div> 
    
   <?php 
     }
}?>
 
  </div>
  
  <!-- order_info --> 
     
</div> 
</body>
</html> 