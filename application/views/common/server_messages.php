<?php ?>
<div id="appErrors" class="server_messeges no-print">
	<div  class=" alert bg-red message_container no-print">
       <button type="button" class="close" id="dismiss_appErrors" onclick="$('#appErrors').slideUp();">
		<span class="glyphicon glyphicon-remove-circle bg-red"></span>
	   </button>
        
        <?php if(isset($appErrors) && !empty($appErrors)){ ?>
        
          <ul class="custom_ul" >
             <?php foreach ($appErrors as $error){ ?>
             <li><?= $error ?> </li>
             <?php } ?>
          </ul>
        <?php } ?>
        
        <?php if(isset($_SESSION["appErrors"]) && !empty($_SESSION["appErrors"])){ ?>
          <ul class="custom_ul" >
             <?php foreach ($_SESSION["appErrors"] as $error){ ?>
             <li><?= $error ?> </li>
             <?php } ?>
          </ul>
          <?php unset($_SESSION["appErrors"]); ?>
        <?php } ?>
        
   	</div>                  
 </div>
 <div id="appMessages" class="server_messeges no-print sm-12 xs-12">
   <div  class=" alert bg-green message_container no-print">
       <button type="button" class="close" id="dismiss_appMessages" onclick="$('#appMessages').slideUp();" >
		<span class="glyphicon glyphicon-remove-circle bg-green"></span>
	   </button>
       
        <?php if(isset($appMessages) && !empty($appMessages)){ ?>
          <ul class="custom_ul" >
             <?php foreach ($appMessages as $message){ ?>
             <li><?= $message ?> </li>
             <?php } ?>
          </ul>
        <?php } ?>
        
        <?php if(isset($_SESSION["appMessages"]) && !empty($_SESSION["appMessages"])){ ?>
          <ul class="custom_ul" >
             <?php foreach ($_SESSION["appMessages"] as $message){ ?>
             <li><?= $message ?> </li>
             <?php } ?>
          </ul>
          <?php unset($_SESSION["appMessages"]); ?>
        <?php } ?>
	</div>      
 </div>


<div id="appNotifications" class="server_messeges no-print">
   <div  class=" alert  bg-yellow message_container no-print">
       <button type="button" class="close" id="dismiss_app_notifications" onclick="$('#appNotifications').slideUp();" >
			<span class="glyphicon glyphicon-remove-circle bg-yellow"></span>
	   </button>
	   
        <?php if(isset($_SESSION["appNotifications"]) && !empty($_SESSION["appNotifications"])){ ?>
          <ul class="custom_ul" >
             <?php foreach ($_SESSION["appNotifications"] as $notification){ ?>
             <li><?= $notification ?> </li>
             <?php } ?>
          </ul>
        <?php } ?>
	</div>      
 </div>