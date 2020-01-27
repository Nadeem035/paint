
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
            <h3>Painter Registertion Form</h3>
            <div id="alert"></div>
            <div class="page-links">
                <a href="<?=BASEURL?>painter/login">Login</a><a href="<?=BASEURL?>painter/signup" class="active">Register</a>
            </div>
            <form id="painter-signup-form" method="post" action="<?=BASEURL?>painter/process-signup">
                <input class="form-control" type="text" name="name" placeholder="Full Name" required>
                <input class="form-control" type="text" name="phone" placeholder="Phone #" required>
                <input class="form-control" type="email" name="email" placeholder="E-mail Address" required>
                <select name="country" class="form-control" required>
                    <option value="">Select Country</option>
                    <option value="pakistan">Pakistan</option>
                    <option value="india">India</option>
                    <option value="uk">UK</option>
                    <option value="usa">USA</option>
                    <option value="canada">Canada</option>
                </select>
                <select name="city" class="form-control" required>
                    <option value="">Select City</option>
                    <option value="lahore">Lahore</option>
                    <option value="Multan">Multan</option>
                    <option value="Karachi">Karachi</option>
                </select>
                <textarea name="address" class="form-control" rows="5" placeholder="Address"></textarea>
                <div class="form-group">
                    <strong class="text-white">Choice Services</strong>
                    <select class="services form-control" name="services[]" multiple>
                        <?php foreach ($cat as $key => $c): ?>
                            <option value="<?=$c['category_id']?>"><?=$c['name']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
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
        $("#painter-signup-form").on('submit', function(e) {
            e.preventDefault();

            $this = $(this);
            $url = $this.attr('action');
            $.post($url, {data: $this.serialize()}, function(resp) {
                resp = JSON.parse(resp);
                if (resp.status == true) {
                    window.location.href = "<?=BASEURL?>painter/dashboard";
                }else{
                    $('#alert').html('<div class="alert alert-danger">'+resp.msg+'</div>');
                }
            });
        });
    });//onload
</script>