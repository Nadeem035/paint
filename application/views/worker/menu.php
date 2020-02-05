<div id="sidebar">

	<!-- mainmenu -->
	<ul id="floatMenu" class="mainmenu">
		<li rel="super_category"><a class="active link" href="<?=BASEURL?>worker">Super Category</a></li>
		<li rel="cat"><a class="active link" href="<?=BASEURL?>worker/cat">Category</a></li>
		<li rel="shop"><a class="link" href="<?=BASEURL?>worker/shops">Shops</a></li>
		<li rel="products"><a class="link" href="<?=BASEURL?>worker/products">Products</a></li>
		<li rel="package"><a class="link" href="<?=BASEURL?>worker/package">Package</a></li>
		<li rel="order"><a class="link" href="<?=BASEURL?>worker/order">Order</a></li>
		<li rel="pass"><a class="link" href="<?=BASEURL?>worker/change_password">Change Password</a></li>
	</ul>
	<!-- /.mainmenu -->
<script type="text/javascript">
$(document).ready(function(e){
	$("li[rel=<?=strtolower($active)?>]").addClass("active");
});
</script>
</div>
