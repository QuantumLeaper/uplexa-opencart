<div id="textbox">
  <h2 class="alignleft"> <?php echo $message; ?>  </h2>
  <input type="button" value="Verify Payment" onClick="window.location.reload()">
</div>

<div class="buttons">
	<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,800' rel='stylesheet'>
        <link href='https://cdn.uplexa.com/css/payments.css' rel='stylesheet'>


            <!-- uPlexa container payment box -->
            <div class='container-upx-payment'>
            <!-- header -->
            <div class='header-upx-payment'>
            <span class='logo-upx' style="max-width: 30px; max-height: 30px;"><img src='https://cdn.uplexa.com/img/upx.png' /></span>
            <span class='upx-payment-text-header'><h2>MONERO PAYMENT</h2></span>
            </div>
            <!-- end header -->
            <!-- upx content box -->
            <div class='content-upx-payment'>
            <div class='upx-amount-send'>
            <span class='upx-label'>Send:</span>
            <div class='upx-amount-box'><?php echo $amount_upx; ?></div><div class='upx-box'>UPX</div>
            </div>
            <div class='upx-address'>
            <span class='upx-label'>To this address:</span>
            <div class='upx-address-box'><?php echo $integrated_address; ?></div>
            </div>
            <div class='upx-qr-code'>
            <span class='upx-label'>Or scan QR:</span>
            <div class='upx-qr-code-box'><img src='https://api.qrserver.com/v1/create-qr-code/? size=200x200&data=<?=$uri?>' /></div>
            </div>
            <div class='clear'></div>
            </div>
            <!-- end content box -->
            <!-- footer upx payment -->
            <div class='footer-upx-payment'>
            <a href='https://uplexa.com' target='_blank'>Help</a> | <a href='https://uplexa.com' target='_blank'>About uPlexa</a>
            </div>
            <!-- end footer upx payment -->
            </div>
            <!-- end uPlexa container payment box -->

	</div>
