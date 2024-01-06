<form id="myForm" action="https://www.webangeltech.com/payment/" method="post" style="visibility:hidden">
 <input type="text" name="checkout_id" value="<?= $checkout ?>" />
 <input type="text" name="amount" value="<?= $amount ?>" />
 <input type="text" name="name" value="<?= $name ?>" />
 <input type="text" name="email" value="<?= $email ?>" />
 <input type="text" name="contact" value="<?= $contact ?>" />
 <input type="text" name="address" value="<?= $address ?>" /> 
</form>
<script type="text/javascript">
    document.getElementById('myForm').submit();
</script>