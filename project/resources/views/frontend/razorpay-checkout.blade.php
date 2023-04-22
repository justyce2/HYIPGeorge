<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<form name='razorpayform' action="{{ $notify_url }}" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>
<script>
"use strict";
var options = <?php echo $json;?>;

options.handler = function (response){
    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
    document.getElementById('razorpay_signature').value = response.razorpay_signature;
    document.razorpayform.submit();
};

options.theme.image_padding = false;

options.modal = {
    ondismiss: function() {
      window.location.assign("{{ url()->previous() }}");
    },
    escape: true,
    backdropclose: false
};

var rzp = new Razorpay(options);
rzp.open();


</script>
