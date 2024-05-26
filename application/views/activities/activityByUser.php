<?php //pre($user);?>
<li class="user-header bg-light-blue" style="text-align: center">
	<img style="width: 50%" src="<?= (isset($user["profile_picture"]) && !empty($user["profile_picture"]))?$user["profile_picture"]: site_url('public/images/avatar3.png') ?>" class="img-circle" alt="User Image">
    <p><?= $user["display_name"]?><small> <?= isset($user["userType"]["type"])?$user["userType"]["type"]:"" ?> </small></p>
	<p><?= $user["email"]?></p>
	<p><?= $activity_at ?></p>
</li>
			                                