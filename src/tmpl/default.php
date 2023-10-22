<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Input\Cookie;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

/*
From Dispatcher:
$toastId String
$forcePosition String
$hideInterval Integer
$cookieTimeSeconds Integer
$headline String
$toastClass String
$content String
$robotsHide Bool
$moduleclass_sfx String
$wam Joomla\CMS\WebAsset\WebAssetManager
*/

if ($robotsHide === true)
{
	return;
}

$currentTime = time();
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
$cookieOptions = [
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
];

$cookie->set($node,
	1,
	$cookieOptions
);

$wam->useScript('bootstrap.toast');
?>
<div class="toast-container <?php echo $toastId . $forcePosition; ?>">
	<div id="<?php echo $toastId; ?>" role="status" class="toast<?php echo $toastClass; ?>"
		data-bs-autohide="false">
		<div class="toast-header">
			<strong class="me-auto"><?php echo $headline; ?></strong>
			<button type="button" class="btn-close" data-bs-dismiss="toast"
				aria-label="<?php echo Text::_('JCLOSE'); ?>"></button>
		</div>
		<div class="toast-body">
			<?php echo $content; ?>
		</div>
	</div>
</div>
<?php
$js = <<< JS
document.addEventListener("DOMContentLoaded", function() {
var $toastId = new bootstrap.Toast("#$toastId");
$toastId.show();
});
JS;
$wam->addInlineScript($js);

if (trim($forcePosition) === 'position-relative')
{
	$css = <<< CSS
.toast-container.$toastId{z-index:1 !important}
CSS;
	$wam->addInlineStyle($css);
}
