<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\Input\Cookie;
use Joomla\CMS\Layout\LayoutHelper;

$hideInterval = (int) $params->get('hideInterval', 0);

// 14 days 60 * 60 * 24 * 14
// 14 stunden 60 * 60 * 14
$cookieTimeSeconds = 60 * 60 * $hideInterval;
$currentTime = time();
$toastId = 'thisToast' . $module->id;
$node = $toastId . 'Node';
$session = Factory::getSession();
$sessionData = (int) $session->get($node);
$cookie = new Cookie;
$cookieData = (int) $cookie->get($node);

if ($cookieTimeSeconds > 0
	&& ($sessionData > $currentTime || $cookieData  > $currentTime)
){
	return;
}

$timeToCookie = $currentTime + $cookieTimeSeconds;
$session->set($node, $timeToCookie);
$cookieOptions = array(
	'expires' => $timeToCookie,
	// Wichtig! Damit Cookie sowohl unter /de/ als auch /en/ verfügbar.
	'path' => '/',
	/*
	When TRUE the cookie will be made accessible only through the HTTP protocol.
	This means that the cookie won't be accessible by scripting languages, such
	as JavaScript. This setting can effectively help to reduce identity theft
	through XSS attacks (although it is not supported by all browsers)
	*/
	'httponly' => true,
	'samesite' => 'strict',
	'secure' => true
);

$cookie->set($node,
	1,
	$cookieOptions
);

?>
<div id="<?php echo $toastId; ?>" role="status" class="toast"
	data-bs-autohide="false">
  <div class="toast-header">
		<strong class="me-auto"><?php echo $params->get('headline', ''); ?></strong>
		<?php echo LayoutHelper::render('ghsvs.closeButtonTop',
			array('options' => ['dismissType' => 'toast'])); ?>
  </div>
  <div class="toast-body">
    <?php echo $module->content; ?>
  </div>
</div>
<?php
$js = <<< JS
document.addEventListener("DOMContentLoaded", function() {
var $toastId = new bootstrap.Toast("#$toastId");
$toastId.show();
});
JS;

Factory::getApplication()->getDocument()->addScriptDeclaration($js);
