<?php
/**
 * Plugin Name:       Connections Bio Entry Opened Narrow Plus Category Names - Template
 * Plugin URI:        http://www.chem.ufl.edu
 * Description:       This is a variation of the default template which shows the bio field for an entry.
 * Version:           1.0
 * Author:            Steven M. Kobb
 * Author URI:        http://connections-pro.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CN_Bio_Card_Opened_Narrow_Pluscatnames_Template' ) ) {

	class CN_Bio_Card_Opened_Narrow_Pluscatnames_Template {

		public static function register() {

			$atts = array(
				'class'       => 'CN_Bio_Card_Opened_Narrow_Pluscatnames_Template',
				'name'        => 'Bio Entry Card Opened Narrow Plus Catnames',
				'slug'        => 'card-bio-opened-narrow-pluscatnames',
				'type'        => 'all',
				'version'     => '2.0.1',
				'author'      => 'Steven A. Zahm',
				'authorURL'   => 'connections-pro.com',
				'description' => 'This is a variation of the default template which shows the bio field for an entry.',
				'custom'      => TRUE,
				'path'        => plugin_dir_path( __FILE__ ),
				'url'         => plugin_dir_url( __FILE__ ),
				'thumbnail'   => 'thumbnail.png',
				'parts'       => array(),
				);

			cnTemplateFactory::register( $atts );
		}

		public function __construct( $template ) {
			$this->template = $template;
			$template->part( array( 'tag' => 'card', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
			$template->part( array( 'tag' => 'card-single', 'type' => 'action', 'callback' => array( __CLASS__, 'card' ) ) );
		}


		public static function card( $entry, $template, $atts ) {

/*

global $noResultMessage, $defaults;
$noResultMessage = 'test';
$defaults['message'] = 'test2';
print("*TEST!");
*/
			?>

<?php
global $thisCatFound, $rowEnded, $NumFound, $ColNum;
$thisCat = strip_tags($entry->getCategoryBlock( array( 'label' => '', 'separator' => ', ', 'before' => '', 'after' => '', 'return' => TRUE ) ));
##$count      = count( $entry );
$categories = $entry->getCategory(  );
$testAr = is_array($categories);
##echo '<!--*testAr=' . $testAr . '<br>-->';

while ((is_array($categories)) AND ($current = each($categories))) {
	$value = $current['value'];
	$key = $current['key'];
	$thisVal = get_object_vars($value);
	##echo "key='" . $key . "'<br>\n";
	##echo "value=";
	##print_r($value);
	$thisCount=$thisVal['count'];
	##echo 'count=' . $thisCount . '<br>';
/*

	while ((is_array($thisVal)) AND ($current2 = each($thisVal))) {
		$value2 = $current2['value'];
		$key2 = $current2['key'];
		##echo "key2='" . $key2 . "'<br>\n";
	}
*/

	##echo "value='" . $categories['$key'] . "'<br>\n";
	##echo 'key=' . $key . '<br>value=' . $value . '<br>';
}

##print_r($categories);
##$count = $categories[0]['count'];
##$count      = count( $categories );
##$thisCount = $entry['categories:cnEntry:private']['0']['count'];
##echo '***' . $thisCount;
$paddingBottom = '0px';
##echo 'count=' . $count . '<br>';
if (!$thisCatFound[$thisCat]) {
	##if ((!empty($NumFound)) AND ($rowEnded == FALSE)) { $rowEnded = TRUE; echo "</div><!-- end row -->\n\n"; }

	print('<h2 style="padding-left:20px; padding-top:20px" id="squelch-taas-title-0" class="squelch-taas-group-title">');
	print($thisCat);
	print("</h2>\n");
	$paddingBottom = '0px';
	$thisCatFound[$thisCat] = TRUE;
	$NumFound = 0; $ColNum = 0; $rowEnded = FALSE;
	##if (empty($numFound)) { $NumFound = 0; $ColNum = 0; }
}

##if ($ColNum >= $numCols) { $rowEnded = TRUE; echo "<!-- end row --></div>"; }


$numCols = 3;
$NumFound++;
$ColNum++;
$lastCol = FALSE;
if ((empty($ColNum)) OR ($ColNum > $numCols)) { $ColNum = 1; }
if ($ColNum == 1) { echo '<div class="clearfloat" style="clear:both"></div><div class="cn-entry-row" style="height:auto; width:auto; border: 0px dotted #666;"><!--*start row-->'; $rowEnded = FALSE; }
##echo 'start ColNum=' . $ColNum . '<br>';
$image = '';
$photo = '';
$photo2 = '';
$photo3 = '';
$photoTagArray = '';
$srcse = '';
$photoUrl = '';
$mag = '';
$photowidth = '';
$photoheight = '';
$photoalt = '';
$photofound = '';
$photoHTML = '';
$minheight = '50px';
$minheight_photo = '50px';
##$entry->getImage();

$image = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'thumbnail', 'return' => TRUE, 'action' => 'none' ) );
$photo = $entry->getImage( array( 'image' => 'photo' , 'preset' => 'profile', 'return' => TRUE, 'action' => 'none', 'style' => FALSE ) );

if ($photo) {
	list($span1, $span2, $photo2, $endspan1, $endspan2) = explode('><', $photo);
	$photoTagArray = getHtmlTagArrayAccNoCatNames($photo);
	$srcset = $photoTagArray['srcset'];
	list($photoUrl, $mag) = explode(' ', $srcset);
	$photowidth = $photoTagArray['width'];
	$photoheight = $photoTagArray['height'];
	$photoalt = $photoTagArray['alt'];
	##echo "photoUrl=" . $photoUrl . "end<br>";
	if ($photoUrl) {
	$photofound = TRUE;
		$minheight = $minheight_photo;
		$photoHTML = "<div style=\"float:left; padding-right; 3px; width:{$photowidth}; height:{$photoheight};\">" . $photo . "</div>";
	}
	if (!$photoUrl) { $photo = ''; }

}
if ($photo2) {
	$photo3 = '<' . $photo2 . '>';
	$photo3 = str_replace(' 1x', '', $photo3);
	$photo3 = str_replace('srcset=', 'src=', $photo3);
}
if ((!$photo) AND ($photo3)) {
	$photofound = TRUE;
	$minheight = $minheight_photo;
	$photoHTML = '<span class="cn-image-style"><span style="display: block; max-width: 100%; width: 180px">' . $photo3 . '</span></span>';

}
?>
<div class="cn-entry" style="-moz-border-radius:4px; background-color:#FFFFFF; border:0px solid #E3E3E3; color: #000000; margin:8px 0px; padding:6px; padding-left:20px; position: relative; width:30%; float:left;">
	<div style="width:100%; float:left">
<?php
##echo $NumFound . '.';
if ($photofound) {
	echo $photoHTML;
}
?>

		<div style="clear:both;"></div>
		<div style="margin-bottom: 3px;">

		<h3><?php echo $entry->getNameBlock(array('link' => '')); ?></a></h3>
		<?php
		$thisTitle = $entry->getTitleBlock(array('return' => TRUE));
		$thisTitle = str_replace(' ', '&nbsp;', $thisTitle);
		$thisTitle = str_replace(',&nbsp;', ",<br />", $thisTitle);
		echo $thisTitle;
		?>
		<?php $entry->getOrgUnitBlock(); ?>
		<?php $entry->getContactNameBlock(); ?>

		<?php $entry->getFamilyMemberBlock(); ?>
		<?php
		$phones = $entry->getPhoneNumberBlock(array('type' => 'workphone', 'format' => '%number%', 'before' => '<strong>Phone:</strong>&nbsp;', 'return' => TRUE));
		$phones = str_replace('<span class="phone-number-block">', '', $phones);
		$phones = str_replace('</span></span>', '</span>', $phones);
		$phones = str_replace('<span class="tel">', '', $phones);
		$phones = str_replace('</span><span class="type" style="display: none;">work</span>', '', $phones);
		print("$phones");
		if ((!empty($phones)) AND (!empty($mail))) { echo '<br />'; }

		$email = $entry->getEmailAddressBlock(array('type' => 'work', 'format' => '%address%', 'before' => '<strong>Email:</strong>&nbsp;', 'return' => TRUE));
		$email = str_replace('</span><span class="type" style="display: none;">INTERNET</span>', '', $email);
		$email = str_replace('<span class="email-address-block">', '', $email);
		$email = str_replace('<span class="email">', '', $email);
		$email = str_replace('</span>', '', $email);
		$email = str_replace('<span class="email-address">', '', $email);
		$email = str_replace('<a class="value"', '<a', $email);
		$email = str_replace('<span class="email cn-email-address">', '', $email);
		$email = str_replace("\n", '', $email);


		print("$email");

		$address = $entry->getAddressBlock(array('return' => TRUE));

		$address = str_replace('<span class="address-name">Work</span>', '<span class="address-name">Address</span>', $address);
		$address = str_replace('<span class="address-name">Other</span>', '', $address);
		echo '<p></p>';
		echo $address;
		?>

		</div>
		<?php $entry->getSocialMediaBlock(); ?>
		<?php $entry->getImBlock(); ?>
		<?php ##$entry->getLinkBlock();
		?>

		<?php
		$thisLink = '';
		$echoLink = '';

		echo '<!--';
		$thisLink = $entry->getLinkBlock( array( 'format' => '%url%', 'type' => $atts['link_types'], 'return' => TRUE ) );
		echo '-->';
		$thisLink = strip_tags($thisLink);
		if ($thisLink) {
			$echoLink = '<span class="link website"><span class="link-name">Research Website</span>:<br /> <a target="_blank" class="url" href="' . $thisLink . '">' . $thisLink . '</a></span><br />';
			echo $echoLink;
		}
		?>
		<?php $entry->getDateBlock(); ?>
	</div>
	<div style="clear:both"></div>
	<?php echo $entry->getBioBlock(); ?>
<?php
	echo '<!--';
	##$thisentry = $entry->getMetaBlock(array('separator' => '-'),'','');

	$thisentry = $entry->getMetaBlock( array('key' => 'Education', 'single' => FALSE, 'display_custom' => TRUE, 'return' => TRUE),'','');
	$thisentry = str_replace('<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">0: </h3><span class="cn-entry-meta-value">0, ', '<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value">', $thisentry);
	$thisentry = str_replace('<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">1: </h3><span class="cn-entry-meta-value">1, ', '<h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value">', $thisentry);
	$thisentry = str_replace('<li style="margin-top:20px"><h3 style="padding-bottom:0px; margin-bottom:0px; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc;">Education: </h3><span class="cn-entry-meta-value"></span></li>', '', $thisentry);
	echo '-->';

	echo $thisentry;

?>

	<div class="clearfloat" style="clear:both"></div>
</div>
<?php
##echo '<br>end ColNum=' . $ColNum . '<br>';
if (($ColNum >= $numCols) OR ($NumFound >= $thisCount)) {
	$rowEnded = TRUE; echo "<!-- end row --></div><div class=\"clearfloat\" style=\"clear:both\"></div>";
}
?>

<?php
		}

	}

	// Register the template.
	add_action( 'cn_register_template', array( 'CN_Bio_Card_Opened_Narrow_Pluscatnames_Template', 'register' ) );
}
