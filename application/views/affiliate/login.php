<div class="form-holder" style="margin-top: 80px; ">
    <div class="form-content">
        <div class="form-items">
            <h3>Affiliates Login Form.</h3>
            <div id="alert"></div>
            <div class="page-links">
                <a href="<?=BASEURL?>affiliate/login" class="active">Login</a><a href="<?=BASEURL?>affiliate/signup">Register</a>
            </div>
            <form id="affiliate-login-form" method="post" action="<?=BASEURL?>affiliate/process-login">
                <input class="form-control" type="text" name="email" placeholder="E-mail Address" required>
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                <input type="checkbox" id="chk1"><label for="chk1">Remmeber me</label>
                <div class="form-button">
                    <button id="submit" type="submit" class="ibtn">Login</button> <a href="<?=BASEURL?>affiliate/forget">Forget password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function () {
        $("#affiliate-login-form").on('submit', function(e) {
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
