<?php ?>



<a class="btn  btn-danger  btn-block" href="<?= site_url("email/compose") ?>">Compose</a>
<a class="btn btn-outline btn-sm btn-primary  btn-block" href="<?= site_url("email/inbox") ?>">Inbox &nbsp;&nbsp;<span class="badge " ><?= isset($_SESSION["unreadEmailsCount"])? $_SESSION["unreadEmailsCount"]:"" ?></span></a>
<a class="btn btn-outline btn-sm btn-primary btn-block" href="<?= site_url("email/sent") ?>">Sent Mail</a>
<a class="btn btn-outline btn-sm btn-primary  btn-block" href="<?= site_url("email/draft") ?>">Draft</a>
<a class="btn btn-outline btn-sm btn-primary  btn-block" href="<?= site_url("email/trash") ?>">Trash</a>

