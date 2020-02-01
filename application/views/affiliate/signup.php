<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Affiliate Registertion Form</h3>
            <div id="alert"></div>
            <div class="page-links">
                <a href="<?=BASEURL?>affiliate/login">Login</a><a href="<?=BASEURL?>affiliate/signup" class="active">Register</a>
            </div>
            <form id="affiliate-signup-form" method="post" action="<?=BASEURL?>affiliate/process-signup">
                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                <input class="form-control" type="text" name="phone" placeholder="Phone #" required>
                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                <select name="country" class="form-control" required>
                    <option value="">Select Country</option>
                    <option value="pakistan">Pakistan</option>
                    <option value="india">India</option>
                </select>
                <select name="city" class="form-control" required>
                    <option value="">Select City</option>
                    <option value="lahore">Lahore</option>
                    <option value="multan">Multan</option>
                </select>
                <textarea name="address" class="form-control" rows="5" placeholder="Address"></textarea>
                <input class="form-control" type="text" name="paypal_account" placeholder="Paypal Account" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
        $("#affiliate-signup-form").on('submit', function(e) {
            e.preventDefault();

            $this = $(this);
            $url = $this.attr('action');
            $.post($url, {data: $this.serialize()}, function(resp) {
                resp = JSON.parse(resp);
                if (resp.status == true) {
                    window.location.href = "<?=BASEURL?>affiliate/dashboard";
                }else{
                    $('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>');
                }
            });
        });
    });//onload
</script>