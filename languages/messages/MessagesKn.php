<?php
/** Kannada (ಕನ್ನಡ)
 *
 * @addtogroup Language
 *
 * @author Mana
 * @author G - ג
 * @author Shushruth
 * @author HPN
 * @author Nike
 * @author Hari Prasad Nadig <hpnadig@gmail.com> http://en.wikipedia.org/wiki/User:Hpnadig
 * @author Ashwath Mattur <ashwatham@gmail.com> http://en.wikipedia.org/wiki/User:Ashwatham
 * @author Siebrand
 */

$namespaceNames = array(
	NS_MEDIA            => 'ಮೀಡಿಯ',
	NS_SPECIAL          => 'ವಿಶೇಷ',
	NS_MAIN             => '',
	NS_TALK             => 'ಚರ್ಚೆಪುಟ',
	NS_USER             => 'ಸದಸ್ಯ',
	NS_USER_TALK        => 'ಸದಸ್ಯರ_ಚರ್ಚೆಪುಟ',
	# NS_PROJECT set by $wgMetaNamespace
	NS_PROJECT_TALK     => '$1_ಚರ್ಚೆ',
	NS_IMAGE            => 'ಚಿತ್ರ',
	NS_IMAGE_TALK       => 'ಚಿತ್ರ_ಚರ್ಚೆಪುಟ',
	NS_MEDIAWIKI        => 'ಮೀಡಿಯವಿಕಿ',
	NS_MEDIAWIKI_TALK   => 'ಮೀಡೀಯವಿಕಿ_ಚರ್ಚೆ',
	NS_TEMPLATE         => 'ಟೆಂಪ್ಲೇಟು',
	NS_TEMPLATE_TALK    => 'ಟೆಂಪ್ಲೇಟು_ಚರ್ಚೆ',
	NS_HELP             => 'ಸಹಾಯ',
	NS_HELP_TALK        => 'ಸಹಾಯ_ಚರ್ಚೆ',
	NS_CATEGORY         => 'ವರ್ಗ',
	NS_CATEGORY_TALK    => 'ವರ್ಗ_ಚರ್ಚೆ'
);

$digitTransformTable = array(
	'0' => '೦', # &#x0ce6;
	'1' => '೧', # &#x0ce7;
	'2' => '೨', # &#x0ce8;
	'3' => '೩', # &#x0ce9;
	'4' => '೪', # &#x0cea;
	'5' => '೫', # &#x0ceb;
	'6' => '೬', # &#x0cec;
	'7' => '೭', # &#x0ced;
	'8' => '೮', # &#x0cee;
	'9' => '೯', # &#x0cef;
);

$messages = array(
# User preference toggles
'tog-underline'            => 'ಲಿಂಕುಗಳ ಕೆಳಗೆ ಗೆರೆ ತೋರಿಸಿ',
'tog-hideminor'            => 'ಚಿಕ್ಕಪುಟ್ಟ ಬದಲಾವಣೆಗಳನ್ನು ಅಡಗಿಸಿ',
'tog-extendwatchlist'      => 'ಸಂಬಂಧಿತ ಎಲ್ಲಾ ಬದಲಾವಣೆಗಳನ್ನು ತೋರುವಂತೆ ಪಟ್ಟಿಯನ್ನು ವಿಸ್ತರಿಸಿ',
'tog-watchcreations'       => 'ನಾನು ಪ್ರಾರಂಭಿಸುವ ಲೇಖನಗಳನ್ನು ನನ್ನ ವೀಕ್ಷಣಾಪಟ್ಟಿಗೆ ಸೇರಿಸು',
'tog-watchdefault'         => 'ನಾನು ಸಂಪಾದಿಸುವ ಪುಟಗಳನ್ನು ವೀಕ್ಷಣಾಪಟ್ಟಿಗೆ ಸೇರಿಸು',
'tog-watchdeletion'        => 'ನಾನು ಅಳಿಸುವ ಪುಟಗಳನ್ನು ನನ್ನ ವೀಕ್ಷಣಾ ಪಟ್ಟಿಗೆ ಸೇರಿಸು',
'tog-previewonfirst'       => 'ಮೊದಲ ಬದಲಾವಣೆಯ ನಂತರ ಮುನ್ನೋಟವನ್ನು ತೋರಿಸು',
'tog-enotifwatchlistpages' => 'ನನ್ನ ವೀಕ್ಷಣೆಯಲ್ಲಿರುವ ಪುಟವು ಬದಲಾದಾಗ ನನಗೆ ಇ-ಅಂಚೆ ಕಳುಹಿಸು',
'tog-enotifusertalkpages'  => 'ನನ್ನ ಚರ್ಚೆ ಪುಟ ಬದಲಾದರೆ ನನಗೆ ಇ-ಅಂಚೆ ಕಳುಹಿಸು',
'tog-enotifminoredits'     => 'ಚಿಕ್ಕ-ಪುಟ್ಟ ಬದಲಾವಣೆಗಳಾದಾಗಲೂ ಇ-ಅಂಚೆ ಕಳುಹಿಸು',
'tog-shownumberswatching'  => 'ಪುಟವನ್ನು ವೀಕ್ಷಿಸುತ್ತಿರುವ ಸದಸ್ಯರ ಸಂಖ್ಯೆಯನ್ನು ತೋರಿಸು',
'tog-watchlisthideown'     => 'ವೀಕ್ಷಣಾ ಪಟ್ಟಿಯಲ್ಲಿ ನನ್ನ ಸಂಪಾದನೆಗಳನ್ನು ತೋರಿಸಬೇಡ',
'tog-watchlisthidebots'    => 'ವೀಕ್ಷಣಾಪಟ್ಟಿಯಲ್ಲಿ ಬಾಟ್ ಸಂಪಾದನೆಗಳನ್ನು ಅಡಗಿಸು',
'tog-watchlisthideminor'   => 'ಚಿಕ್ಕ ಬದಲಾವಣೆಗಳನ್ನು ವೀಕ್ಷಣಾ ಪಟ್ಟಿಯಿಂದ ಅಡಗಿಸು',
'tog-ccmeonemails'         => 'ಇತರರಿಗೆ ನಾನು ಕಳುಹಿಸುವ ಇ-ಅಂಚೆಯ ಪ್ರತಿಯನ್ನು ನನಗೂ ಕಳುಹಿಸು',

'underline-always' => 'ಯಾವಾಗಲೂ',
'underline-never'  => 'ಎಂದಿಗೂ ಇಲ್ಲ',

# Dates
'sunday'        => 'ಭಾನುವಾರ',
'monday'        => 'ಸೋಮವಾರ',
'tuesday'       => 'ಮಂಗಳವಾರ',
'wednesday'     => 'ಬುಧವಾರ',
'thursday'      => 'ಗುರುವಾರ',
'friday'        => 'ಶುಕ್ರವಾರ',
'saturday'      => 'ಶನಿವಾರ',
'sun'           => 'ಭಾನು',
'mon'           => 'ಸೋಮ',
'tue'           => 'ಮಂಗಳ',
'wed'           => 'ಬುಧ',
'thu'           => 'ಗುರು',
'fri'           => 'ಶುಕ್ರ',
'sat'           => 'ಶನಿ',
'january'       => 'ಜನವರಿ',
'february'      => 'ಫೆಬ್ರುವರಿ',
'march'         => 'ಮಾರ್ಚ್',
'april'         => 'ಏಪ್ರಿಲ್',
'may_long'      => 'ಮೇ',
'june'          => 'ಜೂನ್',
'july'          => 'ಜುಲೈ',
'august'        => 'ಆಗಸ್ಟ್',
'september'     => 'ಸೆಪ್ಟೆಂಬರ್',
'october'       => 'ಅಕ್ಟೋಬರ್',
'november'      => 'ನವೆಂಬರ್',
'december'      => 'ಡಿಸೆಂಬರ್',
'january-gen'   => 'ಜನವರಿ',
'february-gen'  => 'ಫ್ರೆಬ್ರುವರಿ',
'march-gen'     => 'ಮಾರ್ಚ್',
'april-gen'     => 'ಏಪ್ರಿಲ್',
'may-gen'       => 'ಮೇ',
'june-gen'      => 'ಜೂನ್',
'july-gen'      => 'ಜುಲೈ',
'august-gen'    => 'ಆಗಸ್ಟ್',
'september-gen' => 'ಸೆಪ್ಟಂಬರ್',
'october-gen'   => 'ಅಕ್ಟೋಬರ್',
'november-gen'  => 'ನವೆಂಬರ್',
'december-gen'  => 'ಡಿಸೆಂಬರ್',
'jan'           => 'ಜನವರಿ',
'feb'           => 'ಫೆಬ್ರುವರಿ',
'mar'           => 'ಮಾರ್ಚ್',
'apr'           => 'ಏಪ್ರಿಲ್',
'may'           => 'ಮೇ',
'jun'           => 'ಜೂನ್',
'jul'           => 'ಜುಲೈ',
'aug'           => 'ಆಗಸ್ಟ್',
'sep'           => 'ಸೆಪ್ಟಂಬರ್',
'oct'           => 'ಅಕ್ಟೋಬರ್',
'nov'           => 'ನವೆಂಬರ್',
'dec'           => 'ಡಿಸೆಂಬರ್',

# Bits of text used by many pages
'categories'      => '{{PLURAL:$1|ವರ್ಗ|ವರ್ಗಗಳು}}',
'pagecategories'  => '{{PLURAL:$1|ವರ್ಗ|ವರ್ಗಗಳು}}',
'category_header' => '"$1" ವರ್ಗದಲ್ಲಿರುವ ಲೇಖನಗಳು',
'subcategories'   => 'ಉಪವಿಭಾಗಗಳು',
'category-empty'  => "''ಈ ವರ್ಗದಲ್ಲಿ ಸದ್ಯದಲ್ಲಿ ಯಾವುದೇ ಪುಟಗಳಾಗಲಿ ಅಥವ ಚಿತ್ರಗಳಾಗಲಿ ಇಲ್ಲ.''",

'mainpagetext' => 'ವಿಕಿ ತಂತ್ರಾಂಶವನ್ನು ಯಶಸ್ವಿಯಾಗಿ ಅನುಸ್ಥಾಪಿಸಲಾಯಿತು.',

'about'          => 'ನಮ್ಮ ಬಗ್ಗೆ',
'article'        => 'ಲೇಖನ ಪುಟ',
'newwindow'      => '(ಹೊಸ ಕಿಟಕಿಯನ್ನು ತೆರೆಯುತ್ತದೆ)',
'cancel'         => 'ವಜಾ ಮಾಡಿ',
'qbfind'         => 'ಹುಡುಕು',
'qbedit'         => 'ಸಂಪಾದಿಸು',
'qbpageoptions'  => 'ಈ ಪುಟ',
'qbmyoptions'    => 'ನನ್ನ ಪುಟಗಳು',
'qbspecialpages' => 'ವಿಶೇಷ ಪುಟಗಳು',
'moredotdotdot'  => 'ಇನ್ನಷ್ಟು...',
'mypage'         => 'ನನ್ನ ಪುಟ',
'mytalk'         => 'ನನ್ನ ಚರ್ಚೆ',
'anontalk'       => 'ಈ ಐ.ಪಿ ಗೆ ಮಾತನಾಡಿ',
'navigation'     => 'ಸಂಚರಣೆ',

'errorpagetitle'    => 'ದೋಷ',
'returnto'          => '$1 ಗೆ ಹಿಂತಿರುಗಿ.',
'tagline'           => '{{SITENAME}} ಇಂದ',
'help'              => 'ಸಹಾಯ',
'search'            => 'ಹುಡುಕು',
'searchbutton'      => 'ಹುಡುಕು',
'go'                => 'ಹೋಗು',
'searcharticle'     => 'ಹೋಗು',
'history'           => 'ಪುಟದ ಚರಿತ್ರೆ',
'history_short'     => 'ಇತಿಹಾಸ',
'info_short'        => 'ಮಾಹಿತಿ',
'printableversion'  => 'ಪ್ರಿಂಟ್ ಆವೃತ್ತಿ',
'permalink'         => 'ಸ್ಥಿರ ಸಂಪರ್ಕ',
'edit'              => 'ಸಂಪಾದಿಸಿ (edit this page)',
'editthispage'      => 'ಈ ಪುಟವನ್ನು ಬದಲಾಯಿಸಿ',
'delete'            => 'ಅಳಿಸಿ',
'deletethispage'    => 'ಈ ಪುಟವನ್ನು ಅಳಿಸಿ',
'protect'           => 'ಸಂರಕ್ಷಿಸು',
'protectthispage'   => 'ಈ ಪುಟವನ್ನು ಸಂರಕ್ಷಿಸಿ',
'unprotect'         => 'ಸಂರಕ್ಷಣೆ ತೆಗೆ',
'unprotectthispage' => 'ಈ ಪುಟದ ಸಂರಕ್ಷಣೆಯನ್ನು ತಗೆಯಿರಿ',
'newpage'           => 'ಹೊಸ ಪುಟ',
'talkpage'          => 'ಈ ಪುಟದ ಬಗ್ಗೆ ಚರ್ಚೆ ಮಾಡಿ',
'talkpagelinktext'  => 'ಚರ್ಚೆ',
'specialpage'       => 'ವಿಶೇಷ ಪುಟ',
'personaltools'     => 'ವೈಯಕ್ತಿಕ ಉಪಕರಣಗಳು',
'postcomment'       => 'ನಿಮ್ಮ ಮಾತನ್ನು ಲಗತ್ತಿಸಿ',
'articlepage'       => 'ಲೇಖನ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',
'talk'              => 'ಚರ್ಚೆ',
'toolbox'           => 'ಉಪಕರಣ',
'userpage'          => 'ಸದಸ್ಯರ ಪುಟ ತೋರು',
'imagepage'         => 'ಚಿತ್ರದ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',
'templatepage'      => 'ಟೆಂಪ್ಲೇಟು ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',
'viewhelppage'      => 'ಸಹಾಯ ಪುಟ ತೋರು',
'categorypage'      => 'ವರ್ಗ ಪುಟ ತೋರು',
'viewtalkpage'      => 'ಚರ್ಚೆಯನ್ನು ವೀಕ್ಷಿಸಿ',
'otherlanguages'    => 'ಇತರ ಭಾಷೆಗಳು',
'lastmodifiedat'    => 'ಈ ಪುಟವನ್ನು ಕೊನೆಯಾಗಿ $2, $1 ರಂದು ಬದಲಾಯಿಸಲಾಗಿತ್ತು.', # $1 date, $2 time
'viewcount'         => 'ಈ ಪುಟವನ್ನು {{PLURAL:$1|೧ ಬಾರಿ|$1 ಬಾರಿ}} ವೀಕ್ಷಿಸಲಾಗಿದೆ.',
'protectedpage'     => 'ಸಂರಕ್ಷಿತ ಪುಟ',
'jumpto'            => 'ಇಲ್ಲಿಗೆ ಹೋಗು:',
'jumptosearch'      => 'ಹುಡುಕು',

# All link text and link target definitions of links into project namespace that get used by other message strings, with the exception of user group pages (see grouppage) and the disambiguation template definition (see disambiguations).
'aboutsite'         => 'ಕನ್ನಡ {{SITENAME}} ಬಗ್ಗೆ',
'aboutpage'         => 'Project:ನಮ್ಮ ಬಗ್ಗೆ',
'copyright'         => 'ಇದು ಈ ಕಾಪಿರೈಟ್‌ನಲ್ಲಿ ಲಭ್ಯವಿದೆ $1.',
'copyrightpagename' => '{{SITENAME}} ಕಾಪಿರೈಟ್',
'copyrightpage'     => '{{ns:project}}:ಕೃತಿಸ್ವಾಮ್ಯತೆಗಳು',
'currentevents'     => 'ಪ್ರಚಲಿತ',
'currentevents-url' => 'ಪ್ರಚಲಿತ',
'disclaimers'       => 'ಅಬಾಧ್ಯತೆಗಳು',
'edithelp'          => 'ಸಂಪಾದನೆಗೆ ಸಹಾಯ',
'edithelppage'      => 'Help:ಸಂಪಾದನೆ',
'helppage'          => 'Help:ಪರಿವಿಡಿ',
'mainpage'          => 'ಮುಖ್ಯ ಪುಟ',
'portal'            => 'ಸಮುದಾಯ ಪುಟ',
'portal-url'        => 'Project:ಸಮುದಾಯ ಪುಟ',
'privacy'           => 'ಖಾಸಗಿ ಮಾಹಿತಿಯ ಬಗ್ಗೆ ನಿಲುವು',
'sitesupport'       => 'ದೇಣಿಗೆ',
'sitesupport-url'   => 'Project:ದೇಣಿಗೆ',

'versionrequired'     => 'ಮೀಡಿಯವಿಕಿಯ $1 ನೇ ಅವೃತ್ತಿ ಬೇಕಾಗುತ್ತದೆ',
'versionrequiredtext' => 'ಈ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಲು ಮೀಡಿಯವಿಕಿಯ $1 ನೇ ಆವೃತ್ತಿ ಬೇಕಾಗಿದೆ. [[Special:Version|ಆವೃತ್ತಿ]] ಪುಟವನ್ನು ನೋಡಿ.',

'ok'                      => 'ಸರಿ',
'newmessageslink'         => 'ಹೊಸ ಸಂದೇಶಗಳು',
'newmessagesdifflink'     => 'ಕೊನೆಯ ಬದಲಾವಣೆ',
'youhavenewmessagesmulti' => '$1 ಅಲ್ಲಿ ನಿಮಗೆ ಹೊಸ ಸಂದೇಶಗಳಿವೆ',
'editsection'             => 'ಬದಲಾಯಿಸಿ',
'editold'                 => 'ಬದಲಾಯಿಸಿ',
'editsectionhint'         => '$1 ವಿಭಾಗ ಸಂಪಾದಿಸಿ',
'toc'                     => 'ಪರಿವಿಡಿ',
'showtoc'                 => 'ತೋರಿಸು',
'hidetoc'                 => 'ಅಡಗಿಸು',
'restorelink'             => '{{PLURAL:$1|೧ ಅಳಿಸಲ್ಪಟ್ಟ ಸಂಪಾದನೆ|$1 ಅಳಿಸಲ್ಪಟ್ಟ ಸಂಪಾದನೆಗಳು}}',
'feedlinks'               => 'ಫೀಡ್:',

# Short words for each namespace, by default used in the namespace tab in monobook
'nstab-main'      => 'ಲೇಖನ',
'nstab-user'      => 'ಸದಸ್ಯರ ಪುಟ',
'nstab-special'   => 'ವಿಶೇಷ',
'nstab-project'   => 'ಬಗ್ಗೆ',
'nstab-image'     => 'ಚಿತ್ರ',
'nstab-mediawiki' => 'ಸಂದೇಶ',
'nstab-template'  => 'ಟೆಂಪ್ಲೇಟು',
'nstab-help'      => 'ಸಹಾಯ',
'nstab-category'  => 'ವರ್ಗ',

# Main script and global functions
'nosuchspecialpage' => 'ಆ ಹೆಸರಿನ ವಿಶೇಷ ಪುಟ ಇಲ್ಲ',

# General errors
'error'              => 'ದೋಷ',
'databaseerror'      => 'ಡೇಟಬೇಸ್ ದೋಷ',
'noconnect'          => 'ಕ್ಷಮಿಸಿ! ಸದ್ಯಕ್ಕೆ ವಿಕಿಯು ತಾಂತ್ರಿಕ ತೊಂದರೆಗಳನ್ನು ಅನುಭವಿಸುತ್ತಿದೆ ಮತ್ತು ಡೇಟಾಬೇಸ್ ಸರ್ವರ್ ಅನ್ನು ಸಂಪರ್ಕಿಸಲು ಸಾಧ್ಯವಾಗುತ್ತಿಲ್ಲ. <br />
$1',
'internalerror'      => 'ಆಂತರಿಕ ದೋಷ',
'internalerror_info' => 'ಆಂತರಿಕ ದೋಷ: $1',
'filecopyerror'      => '"$1" ಫೈಲ್ ಅನ್ನು "$2" ಗೆ ನಕಲಿಸಲಾಗಲಿಲ್ಲ.',
'filedeleteerror'    => '"$1" ಫೈಲ್ ಅನ್ನು ಅಳಿಸಲಾಗಲಿಲ್ಲ.',
'filenotfound'       => '"$1" ಫೈಲನ್ನು ಹುಡುಕಲಾಗಲಿಲ್ಲ.',
'formerror'          => 'ದೋಷ: ಅರ್ಜಿ ಕಳುಹಿಸಲಾಗಲಿಲ್ಲ',
'badarticleerror'    => 'ಈ ಪುಟದ ಮೇಲೆ ನೀವು ಪ್ರಯತ್ನಿಸಿದ ಕಾರ್ಯವನ್ನು ನಡೆಸಲಾಗದು.',
'cannotdelete'       => 'ಈ ಪುಟ ಅಥವಾ ಚಿತ್ರವನ್ನು ಅಳಿಸಲಾಗಲಿಲ್ಲ. (ಬೇರೊಬ್ಬ ಸದಸ್ಯರಿಂದ ಆಗಲೇ ಅಳಿಸಲ್ಪಟ್ಟಿರಬಹುದು.)',
'badtitle'           => 'ಸರಿಯಿಲ್ಲದ ಹೆಸರು',
'viewsource'         => 'ಆಕರ ವೀಕ್ಷಿಸು',

# Login and logout pages
'logouttitle'                => 'ಸದಸ್ಯ ಲಾಗೌಟ್',
'yourname'                   => 'ನಿಮ್ಮ ಬಳಕೆಯ ಹೆಸರು',
'yourpassword'               => 'ನಿಮ್ಮ ಪ್ರವೇಶಪದ',
'yourpasswordagain'          => 'ಪ್ರವೇಶ ಪದ ಮತ್ತೊಮ್ಮೆ ಟೈಪ್ ಮಾಡಿ',
'remembermypassword'         => 'ಈ ಗಣಕಯಂತ್ರದಲ್ಲಿ ನನ್ನ ಪ್ರವೇಶ ಪದವನ್ನು ನೆನಪಿನಲ್ಲಿಟ್ಟುಕೊ',
'loginproblem'               => '<b>ನಿಮ್ಮ ಲಾಗಿನ್ ನಲ್ಲಿ ತೊ೦ದರೆಯಾಯಿತು.</b><br />ಮತ್ತೆ ಪ್ರಯತ್ನಿಸಿ!',
'login'                      => 'ಲಾಗ್ ಇನ್',
'userlogin'                  => 'ಲಾಗ್ ಇನ್ - log in',
'logout'                     => 'ಲಾಗ್ ಔಟ್',
'userlogout'                 => 'ಲಾಗ್ ಔಟ್ - log out',
'notloggedin'                => 'ಲಾಗಿನ್ ಆಗಿಲ್ಲ',
'createaccount'              => 'ಹೊಸ ಖಾತೆ ತೆರೆಯಿರಿ',
'gotaccount'                 => 'ಈಗಾಗಲೇ ಖಾತೆಯಿದೆಯೇ? $1.',
'createaccountmail'          => 'ಇ-ಅಂಚೆಯ ಮೂಲಕ',
'badretype'                  => 'ನೀವು ಕೊಟ್ಟ ಪ್ರವೇಶಪದಗಳು ಬೇರೆಬೇರೆಯಾಗಿವೆ.',
'userexists'                 => 'ನೀವು ನೀಡಿದ ಸದಸ್ಯರ ಹೆಸರು ಆಗಲೆ ಬಳಕೆಯಲ್ಲಿದೆ. ದಯವಿಟ್ಟು ಬೇರೊಂದು ಹೆಸರನ್ನು ಆಯ್ಕೆ ಮಾಡಿ.',
'loginerror'                 => 'ಲಾಗಿನ್ ದೋಷ',
'loginsuccesstitle'          => 'ಲಾಗಿನ್ ಯಶಸ್ವಿ',
'loginsuccess'               => 'ನೀವು ಈಗ "$1" ಆಗಿ ವಿಕಿಪೀಡಿಯಕ್ಕೆ ಲಾಗಿನ್ ಆಗಿದ್ದೀರಿ.',
'nosuchuser'                 => '"$1" ಹೆಸರಿನ ಯಾವ ಸದಸ್ಯರೂ ಇಲ್ಲ.
ಕಾಗುಣಿತವನ್ನು ಪರೀಕ್ಷಿಸಿ, ಅಥವಾ ಕೆಳಗಿನ ಫಾರ್ಮ್ ಅನ್ನು ಉಪಯೋಗಿಸಿ ಹೊಸ ಸದಸ್ಯತ್ವವನ್ನು ಸೃಷ್ಟಿಸಿ.',
'mailmypassword'             => 'ಹೊಸ ಪ್ರವೇಶ ಪದವನ್ನು ಇ-ಅಂಚೆ ಮೂಲಕ ಕಳುಹಿಸಿ',
'acct_creation_throttle_hit' => 'ಕ್ಷಮಿಸಿ, ನೀವಾಗಲೇ $1 ಖಾತೆಗಳನ್ನು ತೆರೆದಿದ್ದೀರಿ. ಇನ್ನು ಖಾತೆಗಳನ್ನು ತೆರೆಯಲಾಗುವುದಿಲ್ಲ.',
'loginlanguagelabel'         => 'ಭಾಷೆ: $1',

# Edit page toolbar
'bold_sample'     => 'ದಪ್ಪಗಿನ ಅಚ್ಚು',
'bold_tip'        => 'ದಪ್ಪಗಿನ ಅಚ್ಚು',
'link_sample'     => 'ಸಂಪರ್ಕದ ಹೆಸರು',
'link_tip'        => 'ಆಂತರಿಕ ಸಂಪರ್ಕ',
'headline_sample' => 'ಶಿರೋಲೇಖ',
'sig_tip'         => 'ಸಮಯಮುದ್ರೆಯೊಂದಿಗೆ ನಿಮ್ಮ ಸಹಿ',
'hr_tip'          => 'ಅಡ್ಡ ಗೆರೆ (ಆದಷ್ಟು ಕಡಿಮೆ ಉಪಯೋಗಿಸಿ)',

# Edit pages
'summary'                  => 'ಸಾರಾಂಶ',
'minoredit'                => 'ಇದು ಚುಟುಕಾದ ಬದಲಾವಣೆ',
'watchthis'                => 'ಈ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',
'savearticle'              => 'ಪುಟವನ್ನು ಉಳಿಸಿ',
'preview'                  => 'ಮುನ್ನೋಟ',
'showpreview'              => 'ಮುನ್ನೋಟ',
'showdiff'                 => 'ಬದಲಾವಣೆಗಳನ್ನು ತೋರಿಸಿ',
'anoneditwarning'          => "'''ಎಚ್ಚರ:''' ನೀವು ಲಾಗ್ ಇನ್ ಆಗಿಲ್ಲ. ನಿಮ್ಮ ಐಪಿ ವಿಳಾಸವು ಪುಟದ ಸಂಪಾದನೆಗಳ ಇತಿಹಾಸದಲ್ಲಿ ದಾಖಲಾಗುತ್ತದೆ.",
'blockedtitle'             => 'ಈ ಸದಸ್ಯರನ್ನು ತಡೆ ಹಿಡಿಯಲಾಗಿದೆ.',
'loginreqtitle'            => 'ಲಾಗಿನ್ ಆಗಬೇಕು',
'accmailtitle'             => 'ಪ್ರವೇಶ ಪದ ಕಳುಹಿಸಲಾಯಿತು.',
'accmailtext'              => "'$1'ನ ಪ್ರವೇಶ ಪದ $2 ಗೆ ಕಳುಹಿಸಲಾಗಿದೆ",
'newarticle'               => '(ಹೊಸತು)',
'newarticletext'           => "ಇನ್ನೂ ಅಸ್ಥಿತ್ವದಲ್ಲಿ ಇರದ ಪುಟದ ಲಿಂಕ್ ಅನ್ನು ನೀವು ಒತ್ತಿರುವಿರಿ.
ಈ ಪುಟವನ್ನು ಸೃಷ್ಟಿಸಲು ಕೆಳಗಿನ ಚೌಕದಲ್ಲಿ ಬರೆಯಲು ಆರಂಭಿಸಿರಿ. 
(ಹೆಚ್ಚು ಮಾಹಿತಿಗೆ [[{{MediaWiki:Helppage}}|ಸಹಾಯ ಪುಟ]] ನೋಡಿ).
ಈ ಪುಟಕ್ಕೆ ನೀವು ತಪ್ಪಾಗಿ ಬಂದಿದ್ದಲ್ಲಿ ನಿಮ್ಮ ಬ್ರೌಸರ್‍ನ '''back''' ಬಟನ್ ಅನ್ನು ಒತ್ತಿ.",
'noarticletext'            => '(ಈ ಪುಟದಲ್ಲಿ ಸದ್ಯಕ್ಕೆ ಏನೂ ಇಲ್ಲ)',
'note'                     => '<strong>ಸೂಚನೆ:</strong>',
'previewnote'              => 'ಇದು ಕೇವಲ ಮುನ್ನೋಟ, ಪುಟವನ್ನು ಇನ್ನೂ ಉಳಿಸಲಾಗಿಲ್ಲ ಎ೦ಬುದನ್ನು ಮರೆಯದಿರಿ!',
'editing'                  => "'$1' ಲೇಖನ ಬದಲಾಯಿಸಲಾಗುತ್ತಿದೆ",
'editinguser'              => "'$1' ಲೇಖನ ಬದಲಾಯಿಸಲಾಗುತ್ತಿದೆ",
'editingsection'           => '$1 (ವಿಭಾಗ) ಅನ್ನು ಸಂಪಾದಿಸುತ್ತಿರುವಿರಿ',
'storedversion'            => 'ಈಗಾಗಲೇ ಉಳಿಸಲಾಗಿರುವ ಆವೃತ್ತಿ',
'editingold'               => '<strong>ಎಚ್ಚರಿಕೆ: ಈ ಪುಟದ ಹಳೆಯ ಆವೃತ್ತಿಯನ್ನು ಬದಲಾಯಿಸುತ್ತಿದ್ದೀರಿ. ಈ ಬದಲಾವಣೆಗಳನ್ನು ಉಳಿಸಿದಲ್ಲಿ, ನ೦ತರದ ಆವೃತ್ತಿಗಳೆಲ್ಲವೂ ಕಳೆದುಹೋಗುತ್ತವೆ.</strong>',
'yourdiff'                 => 'ವ್ಯತ್ಯಾಸಗಳು',
'copyrightwarning'         => 'ದಯವಿಟ್ಟು ಗಮನಿಸಿ: {{SITENAME}} ಸೈಟಿನಲ್ಲಿ ನಿಮ್ಮ ಎಲ್ಲಾ ಕಾಣಿಕೆಗಳನ್ನೂ $2 ಅಡಿಯಲ್ಲಿ ಬಿಡುಗಡೆ ಮಾಡಲಾಗುತ್ತದೆ (ಮಾಹಿತಿಗೆ $1 ನೋಡಿ). ನಿಮ್ಮ ಸಂಪಾದನೆಗಳನ್ನು ಬೇರೆಯವರು ನಿರ್ಧಾಕ್ಷಿಣ್ಯವಾಗಿ ಬದಲಾಯಿಸಿ ಬೇರೆ ಕಡೆಗಳಲ್ಲಿ ಹಂಚಬಹುದು. ಇದಕ್ಕೆ ನಿಮ್ಮ ಒಪ್ಪಿಗೆ ಇದ್ದರೆ ಮಾತ್ರ ಇಲ್ಲಿ ಸಂಪಾದನೆ ಮಾಡಿ.<br />
ಅಲ್ಲದೆ ನಿಮ್ಮ ಸಂಪಾದನೆಗಳನ್ನು ಸ್ವತಃ ರಚಿಸಿದ್ದು, ಅಥವ ಕೃತಿಸ್ವಾಮ್ಯತೆಯಿಂದ ಮುಕ್ತವಾಗಿರುವ ಕಡೆಯಿಂದ ಪಡೆದಿದ್ದು ಎಂದು ಪ್ರಮಾಣಿಸುತ್ತಿರುವಿರಿ.
<strong>ಕೃತಿಸ್ವಾಮ್ಯತೆಯ ಅಡಿಯಲ್ಲಿರುವ ರಚನೆಗಳನ್ನು ಅನುಮತಿ ಇಲ್ಲದೆ ಇಲ್ಲಿಗೆ ಹಾಕಬೇಡಿ!</strong>',
'longpagewarning'          => '<strong>ಎಚ್ಚರ: ಈ ಪುಟ $1 ಕಿಲೋಬೈಟ್‍ಗಳಷ್ಟು ಉದ್ದ ಇದೆ; ಕೆಲವು ಬ್ರೌಸರ್‍ಗಳಲ್ಲಿ ೩೨ ಕಿಲೋಬೈಟ್‍ಗಳಿಗಿಂತ ಉದ್ದದ ಪುಟಗಳನ್ನು ಸಂಪಾದನೆ ಮಾಡುವುದು ಕಷ್ಟ. ಪುಟವನ್ನು ಆದಷ್ಟು ವಿಭಾಗಗಳಾಗಿ ವಿಂಗಡಿಸಲು ಪ್ರಯತ್ನಿಸಿ.</strong>',
'protectedpagewarning'     => '<strong>ಎಚ್ಚರಿಕೆ: ಈ ಪುಟವನ್ನು ಸಂರಕ್ಷಿಸಲಾಗಿದೆ. ಇದನ್ನು ಕೇವಲ ನಿರ್ವಾಹಕರು ಬದಲಾಯಿಸಬಹುದು.</strong>',
'semiprotectedpagewarning' => "'''ಗಮನಿಸಿ:''' ಈ ಪುಟವನ್ನು ಕೇವಲ ನೊಂದಯಿತ ಸದಸ್ಯರು ಸಂಪಾದನೆ ಮಾಡಬರುವಂತೆ ಸಂರಕ್ಷಿಸಲಾಗಿದೆ.",
'templatesused'            => 'ಈ ಪುಟದಲ್ಲಿ ಉಪಯೋಗಿಸಲಾಗಿರುವ ಟೆಂಪ್ಲೇಟುಗಳು:',
'templatesusedpreview'     => 'ಈ ಮುನ್ನೋಟದಲ್ಲಿ ಉಪಯೋಗಿಸಲ್ಪಟ್ಟಿರುವ ಟೆಂಪ್ಲೇಟುಗಳು:',
'templatesusedsection'     => 'ಈ ವಿಭಾಗದಲ್ಲಿ ಉಪಯೋಗಿಸಲ್ಪಟ್ಟಿರುವ ಟೆಂಪ್ಲೇಟುಗಳು:',
'template-protected'       => '(ಸಂರಕ್ಷಿತ)',
'template-semiprotected'   => '(ಅರೆ-ಸಂರಕ್ಷಿತ)',

# History pages
'revhistory'          => 'ಬದಲಾವಣೆಗಳ ಇತಿಹಾಸ',
'nohistory'           => 'ಈ ಪುಟಕ್ಕೆ ಬದಲಾವಣೆಗಳ ಇತಿಹಾಸ ಇಲ್ಲ.',
'currentrev'          => 'ಈಗಿನ ತಿದ್ದುಪಡಿ',
'revisionasof'        => '$1 ದಿನದ ಆವೃತ್ತಿ',
'previousrevision'    => '←ಹಿಂದಿನ ಪರಿಷ್ಕರಣೆ',
'nextrevision'        => 'ಮುಂದಿನ ಪರಿಷ್ಕರಣೆ',
'currentrevisionlink' => 'ಈಗಿನ ಪರಿಷ್ಕರಣೆ',
'cur'                 => 'ಸದ್ಯದ',
'next'                => 'ಮುಂದಿನದು',
'last'                => 'ಕೊನೆಯ',
'page_first'          => 'ಮೊದಲ',
'page_last'           => 'ಕೊನೆಯ',

# Revision feed
'history-feed-title'       => 'ಬದಲಾವಣೆಗಳ ಇತಿಹಾಸ',
'history-feed-description' => 'ವಿಕಿಯ ಈ ಪುಟದ ಬದಲಾವಣೆಗಳ ಇತಿಹಾಸ',

# Diffs
'history-title'           => '"$1" ಪುಟದ ಬದಲಾವಣೆಗಳ ಇತಿಹಾಸ',
'difference'              => '(ಆವೃತ್ತಿಗಳ ನಡುವಿನ ವ್ಯತ್ಯಾಸ)',
'lineno'                  => '$1 ನೇ ಸಾಲು:',
'editcurrent'             => 'ಈ ಪುಟದ ಪ್ರಸಕ್ತ ಆವೃತ್ತಿಯನ್ನು ಸ೦ಪಾದಿಸಿ',
'compareselectedversions' => 'ಆಯ್ಕೆ ಮಾಡಿದ ಆವೃತ್ತಿಗಳನ್ನು ಹೊಂದಾಣಿಕೆ ಮಾಡಿ ನೋಡಿ',

# Search results
'searchresults' => 'ಶೋಧನೆಯ ಫಲಿತಾಂಶಗಳು',
'prevn'         => 'ಹಿಂದಿನ $1',
'nextn'         => 'ಮುಂದಿನ $1',
'powersearch'   => 'ಹುಡುಕಿ',

# Preferences page
'preferences'        => 'ಇಚ್ಛೆಗಳು',
'mypreferences'      => 'ನನ್ನ ಆಯ್ಕೆಗಳು',
'prefs-edits'        => 'ಸಂಪಾದನೆಗಳ ಸಂಖ್ಯೆ:',
'prefsnologin'       => 'ಲಾಗಿನ್ ಆಗಿಲ್ಲ',
'changepassword'     => 'ಪ್ರವೇಶ ಪದ ಬದಲಾಯಿಸಿ',
'dateformat'         => 'ದಿನಾಂಕದ ಫಾರ್ಮ್ಯಾಟ್',
'prefs-rc'           => 'ಇತ್ತೀಚಿನ ಬದಲಾವಣೆಗಳು',
'saveprefs'          => 'ಉಳಿಸಿ',
'oldpassword'        => 'ಹಳೆಯ ಪ್ರವೇಶ ಪದ',
'newpassword'        => 'ಹೊಸ ಪ್ರವೇಶ ಪದ',
'recentchangescount' => 'ಇತ್ತೀಚೆಗಿನ ಬದಲಾವಣೆಗಳಲ್ಲಿರುವ ವಿಷಯಗಳ ಸಂಖ್ಯೆ',
'timezonelegend'     => 'ಟೈಮ್ ಝೋನ್',
'localtime'          => 'ಸ್ಥಳೀಯ ಸಮಯ',
'allowemail'         => 'ಬೇರೆ ಸದಸ್ಯರಿಂದ ಈ-ಮೈಲ್‍ಗಳನ್ನು ಸ್ವೀಕರಿಸು',

# User rights
'userrights-reason' => 'ಬದಲಾವಣೆಗೆ ಕಾರಣ:',

# Groups
'group'     => 'ಗುಂಪು:',
'group-bot' => 'ಬಾಟ್‍ಗಳು',
'group-all' => '(ಎಲ್ಲವೂ)',

'group-bot-member' => 'ಬಾಟ್',

# Recent changes
'nchanges'                          => '$1 {{PLURAL:$1|ಬದಲಾವಣೆ|ಬದಲಾವಣೆಗಳು}}',
'recentchanges'                     => 'ಇತ್ತೀಚೆಗಿನ ಬದಲಾವಣೆಗಳು',
'recentchangestext'                 => 'ವಿಕಿಗೆ ಮಾಡಲ್ಪಟ್ಟ ಇತ್ತೀಚಿನ ಬದಲಾವಣೆಗಳನ್ನು ಈ ಪುಟದಲ್ಲಿ ನೀವು ಕಾಣಬಹುದು.',
'rcnote'                            => 'ಕೊನೆಯ <strong>$2</strong> ದಿನಗಳಲ್ಲಿ ಮಾಡಿದ <strong>$1</strong> ಬದಲಾವಣೆಗಳು ಕೆಳಗಿನಂತಿವೆ.',
'rclistfrom'                        => '$1 ಇಂದ ಪ್ರಾರಂಭಿಸಿ ಮಾಡಲಾದ ಬದಲಾವಣೆಗಳನ್ನು ನೋಡಿ',
'rcshowhideminor'                   => 'ಚಿಕ್ಕಪುಟ್ಟ ಬದಲಾವಣೆಗಳನ್ನು $1',
'rcshowhidebots'                    => 'ಬಾಟ್‍ಗಳನ್ನು $1',
'rcshowhideliu'                     => 'ಲಾಗ್-ಇನ್ ಆಗಿರುವ ಸದಸ್ಯರು $1',
'rcshowhideanons'                   => 'ಅನಾಮಧೇಯ ಸದಸ್ಯರು $1',
'rcshowhidemine'                    => 'ನನ್ನ ಸಂಪಾದನೆಗಳನ್ನು $1',
'rclinks'                           => 'ಕೊನೆಯ $2 ದಿನಗಳಲ್ಲಿ ಮಾಡಿದ $1 ಕೊನೆಯ ಬದಲಾವಣೆಗಳನ್ನು ನೋಡಿ <br />$3',
'diff'                              => 'ವ್ಯತ್ಯಾಸ',
'hist'                              => 'ಇತಿಹಾಸ',
'hide'                              => 'ಅಡಗಿಸು',
'show'                              => 'ತೋರಿಸು',
'newpageletter'                     => 'ಹೊ',
'number_of_watching_users_pageview' => '[$1 ವೀಕ್ಷಿಸುತ್ತಿರುವ {{PLURAL:$1|ಸದಸ್ಯ|ಸದಸ್ಯರು}}]',

# Recent changes linked
'recentchangeslinked' => 'ಸಂಬಂಧಪಟ್ಟ ಬದಲಾವಣೆಗಳು',

# Upload
'upload'          => 'ಫೈಲ್ ಅಪ್ಲೋಡ್',
'uploadnologin'   => 'ಲಾಗಿನ್ ಆಗಿಲ್ಲ',
'filename'        => 'ಕಡತದ ಹೆಸರು',
'filedesc'        => 'ಸಾರಾಂಶ',
'filestatus'      => 'ಕೃತಿಸ್ವಾಮ್ಯತೆ ಸ್ಥಿತಿ',
'filesource'      => 'ಆಕರ',
'ignorewarning'   => 'ಎಚ್ಚರಿಕೆಯನ್ನು ಕಡೆಗಣಿಸಿ ಫೈಲನ್ನು ಉಳಿಸಿ.',
'ignorewarnings'  => 'ಎಲ್ಲಾ ಎಚ್ಚರಗಳನ್ನೂ ಕಡೆಗಣಿಸು',
'badfilename'     => 'ಚಿತ್ರದ ಹೆಸರನ್ನು $1 ಗೆ ಬದಲಾಯಿಸಲಾಗಿದೆ.',
'fileexists'      => 'ಈ ಹೆಸರಿನ ಫೈಲ್ ಆಗಲೇ ಅಸ್ತಿತ್ವದಲ್ಲಿದೆ. ಈ ಹೆಸರನ್ನು ಬದಲಾಯಿಸಲು ಇಚ್ಛೆಯಿಲ್ಲದಿದ್ದರೆ, ದಯವಿಟ್ಟು $1 ಅನ್ನು ಪರೀಕ್ಷಿಸಿ.',
'savefile'        => 'ಕಡತವನ್ನು ಉಳಿಸಿ',
'watchthisupload' => 'ಈ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',

'upload-file-error' => 'ಆಂತರಿಕ ದೋಷ',

# Image list
'imagelist'      => 'ಚಿತ್ರಗಳ ಪಟ್ಟಿ',
'getimagelist'   => 'ಚಿತ್ರಗಳ ಪಟ್ಟಿಯನ್ನು ಪಡೆಯಲಾಗುತ್ತಿದೆ',
'ilsubmit'       => 'ಹುಡುಕು',
'byname'         => 'ಹೆಸರಿಗನುಗುಣವಾಗಿ',
'bydate'         => 'ದಿನಾಂಕಕ್ಕನುಗುಣವಾಗಿ',
'bysize'         => 'ಗಾತ್ರಕ್ಕನುಗುಣವಾಗಿ',
'filehist-user'  => 'ಸದಸ್ಯ',
'linkstoimage'   => 'ಈ ಕೆಳಗಿನ ಪುಟಗಳು ಈ ಚಿತ್ರಕ್ಕೆ ಸಂಪರ್ಕ ಹೊಂದಿವೆ:',
'nolinkstoimage' => 'ಈ ಫೈಲಿಗೆ ಯಾವ ಪುಟವೂ ಸಂಪರ್ಕ ಹೊಂದಿಲ್ಲ.',
'imagelist_date' => 'ದಿನಾಂಕ',
'imagelist_name' => 'ಹೆಸರು',
'imagelist_user' => 'ಸದಸ್ಯ',
'imagelist_size' => 'ಗಾತ್ರ',

# File deletion
'filedelete-intro'   => "'''[[Media:$1|$1]]''' ಅನ್ನು ಅಳಿಸುತ್ತಿರುವಿರಿ.",
'filedelete-success' => "'''$1''' ಅಳಿಸಲಾಗಿದೆ.",

# Unwatched pages
'unwatchedpages' => 'ಯಾರೂ ವೀಕ್ಷಿಸುತ್ತಿರದ ಪುಟಗಳು',

# List redirects
'listredirects' => 'ರೀಡೈರೆಕ್ಟ್ ಪುಟಗಳ ಪಟ್ಟಿ',

# Unused templates
'unusedtemplates'     => 'ಉಪಯೋಗದಲ್ಲಿರದ ಟೆಂಪ್ಲೇಟುಗಳು',
'unusedtemplatestext' => 'ಯಾವ ಪುಟದಲ್ಲೂ ಉಪಯೋಗದಲ್ಲಿ ಇರದ ಟೆಂಪ್ಲೇಟುಗಳನ್ನು ಇಲ್ಲಿ ಪಟ್ಟಿ ಮಾಡಲಾಗಿದೆ. ಇವನ್ನು ಅಳಿಸುವ ಮುನ್ನ ಟೆಂಪ್ಲೇಟುಗಳಿಗೆ ಇತರ ಲಿಂಕುಗಳಿದೆಯೆ ಎಂದು ಪರೀಕ್ಷಿಸಲು ಮರೆಯದಿರಿ.',

# Random page
'randompage' => 'ಯಾದೃಚ್ಛಿಕ ಪುಟ',

# Statistics
'statistics'             => 'ಅಂಕಿ ಅಂಶಗಳು',
'sitestats'              => 'ತಾಣದ ಅಂಕಿಅಂಶಗಳು',
'userstats'              => 'ಸದಸ್ಯರ ಅಂಕಿ ಅಂಶ',
'sitestatstext'          => "ಒಟ್ಟು '''\$1''' ಪುಟಗಳು ಡೇಟಾಬೇಸ್‌ನಲ್ಲಿವೆ.
ಈ ಸಂಖ್ಯೆ \"ಚರ್ಚೆ\" ಪುಟಗಳನ್ನು, ವಿಕಿಪೀಡಿಯಾದ ಬಗೆಗಿನ ಪುಟಗಳನ್ನು, ಹಾಗೂ ಪುಟ್ಟ \"ಚುಟುಕು\" ಪುಟಗಳನ್ನೂ, ರೆಡೈರೆಕ್ಟ್ ಮಾಡಿದ ಪುಟಗಳನ್ನು ಹಾಗೂ ಬೇರೆಲ್ಲೂ ಸೇರಿಸಲಾಗದ ಕೆಲವು ಇತರೆ ಪುಟಗಳನ್ನು ಒಳಗೊಂಡಿದೆ.

ಇವುಗಳನ್ನು ಬಿಟ್ಟು, ಒಟ್ಟು '''\$2''' ಬಹುಶಃ ನಿಜವಾದ ಲೇಖನಗಳಿಂದ ಕೂಡಿದ ಪುಟಗಳಿವೆ.",
'userstatstext'          => "ಒಟ್ಟು '''$1''' ನೊಂದಾಯಿಸಿದ ಸದಸ್ಯರಿದ್ದಾರೆ. ಇವರಲ್ಲಿ '''$2''' ಮಂದಿ ನಿರ್ವಾಹಕರಿದ್ದಾರೆ ($3 ನೋಡಿ).",
'statistics-mostpopular' => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ವೀಕ್ಷಿತ ಪುಟಗಳು',

'disambiguations' => 'ದ್ವಂದ್ವನಿವಾರಣಾ ಪುಟಗಳು',

'brokenredirects'        => 'ಮುರಿದ ರಿಡೈರೆಕ್ಟ್‌ಗಳು',
'brokenredirectstext'    => 'ಕೆಳಗಿನ ರಿಡೈರೆಕ್ಟುಗಳು ವಿಕಿಯಲ್ಲಿ ಇಲ್ಲದ ಪುಟಗಳಿಗೆ ಸಂಪರ್ಕ ಹೊಂದಿವೆ:',
'brokenredirects-edit'   => '(ಸಂಪಾದಿಸಿ)',
'brokenredirects-delete' => '(ಅಳಿಸಿ)',

'withoutinterwiki' => 'ಬೇರೆ ಭಾಷೆಗಳಿಗೆ ಸಂಪರ್ಕ ಹೊಂದಿರದ ಪುಟಗಳು',

'fewestrevisions' => 'ಅತ್ಯಂತ ಕಡಿಮೆ ಬದಲಾವಣೆಗಳನ್ನು ಹೊಂದಿರುವ ಪುಟಗಳು',

# Miscellaneous special pages
'ncategories'             => '$1 {{PLURAL:$1|ವರ್ಗ|ವರ್ಗಗಳು}}',
'nlinks'                  => '$1 {{PLURAL:$1|ಸಂಪರ್ಕ|ಸಂಪರ್ಕಗಳು}}',
'nmembers'                => '$1 {{PLURAL:$1|ಸದಸ್ಯ|ಸದಸ್ಯರು}}',
'lonelypages'             => 'ಒಬ್ಬಂಟಿ ಪುಟಗಳು',
'uncategorizedpages'      => 'ವರ್ಗ ಗೊತ್ತು ಮಾಡದ ಪುಟಗಳು',
'uncategorizedcategories' => 'ಅವರ್ಗೀಕೃತ ವರ್ಗಗಳು',
'uncategorizedimages'     => 'ಅವರ್ಗೀಕೃತ ಚಿತ್ರಗಳು',
'uncategorizedtemplates'  => 'ಅವರ್ಗೀಕೃತ ಟೆಂಪ್ಲೇಟುಗಳು',
'unusedcategories'        => 'ಬಳಕೆಯಲ್ಲಿರದ ವರ್ಗಗಳು',
'unusedimages'            => 'ಉಪಯೋಗಿಸದ ಚಿತ್ರಗಳು',
'popularpages'            => 'ಜನಪ್ರಿಯ ಪುಟಗಳು',
'wantedcategories'        => 'ಬೇಕಾಗಿರುವ ವರ್ಗಗಳು',
'wantedpages'             => 'ಬೇಕಾಗಿರುವ ಪುಟಗಳು',
'mostlinked'              => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ಸಂಪರ್ಕಗಳನ್ನು ಹೊಂದಿರುವ ಪುಟಗಳು',
'mostlinkedcategories'    => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ಸಂಪರ್ಕಗಳನ್ನು ಹೊಂದಿರುವ ವರ್ಗಗಳು',
'mostlinkedtemplates'     => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ಸಂಪರ್ಕಗಳನ್ನು ಹೊಂದಿರುವ ಟೆಂಪ್ಲೇಟುಗಳು',
'mostcategories'          => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ವರ್ಗಗಳನ್ನು ಹೊಂದಿರುವ ಪುಟಗಳು',
'mostimages'              => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ಸಂಪರ್ಕಗಳನ್ನು ಹೊಂದಿರುವ ಚಿತ್ರಗಳು',
'mostrevisions'           => 'ಅತ್ಯಂತ ಹೆಚ್ಚು ಬದಲಾವಣೆಗಳಾಗಿವು ಪುಟಗಳು',
'allpages'                => 'ಎಲ್ಲ ಪುಟಗಳು',
'shortpages'              => 'ಪುಟ್ಟ ಪುಟಗಳು',
'longpages'               => 'ಉದ್ದನೆಯ ಪುಟಗಳು',
'deadendpages'            => 'ಕೊನೆಯಂಚಿನ ಪುಟಗಳು',
'protectedpages'          => 'ಸಂರಕ್ಷಿತ ಪುಟಗಳು',
'listusers'               => 'ಸದಸ್ಯರ ಪಟ್ಟಿ',
'specialpages'            => 'ವಿಶೇಷ ಪುಟಗಳು',
'spheading'               => 'ಎಲ್ಲಾ ಸದಸ್ಯರಿಗೂ ಇರುವ ವಿಶೇಷ ಪುಟಗಳು',
'newpages'                => 'ಹೊಸ ಪುಟಗಳು',
'ancientpages'            => 'ಹಳೆಯ ಪುಟಗಳು',
'intl'                    => 'ಅಂತರಭಾಷೆ ಸಂಪರ್ಕಗಳು',
'move'                    => 'ಸ್ಥಳಾಂತರಿಸಿ',
'movethispage'            => 'ಈ ಪುಟವನ್ನು ಸ್ಥಳಾಂತರಿಸಿ',

# Book sources
'booksources' => 'ಪುಸ್ತಕಗಳ ಮೂಲ',

'categoriespagetext' => 'ವಿಕಿಯಲ್ಲಿ ಈ ಕೆಳಗಿನ ವರ್ಗಗಳಿವೆ',
'isbn'               => 'ಐಎಸ್ಬಿಎನ್',
'alphaindexline'     => '$1 ಇಂದ $2',
'version'            => 'ಆವೃತ್ತಿ',

# Special:Log
'speciallogtitlelabel' => 'ಶೀರ್ಷಿಕೆ:',

# Special:Allpages
'nextpage'       => 'ಮುಂದಿನ ಪುಟ ($1)',
'prevpage'       => 'ಹಿಂದಿನ ಪುಟ ($1)',
'allarticles'    => 'ಎಲ್ಲ ಲೇಖನಗಳು',
'allpagessubmit' => 'ಹೋಗು',

# E-mail user
'emailuser'       => 'ಈ ಸದಸ್ಯರಿಗೆ ಇ-ಅಂಚೆ ಕಳಿಸಿ',
'emailpage'       => 'ಸದಸ್ಯರಿಗೆ ವಿ-ಅ೦ಚೆ ಕಳಿಸಿ',
'defemailsubject' => 'ವಿಕಿಪೀಡಿಯ ವಿ-ಅ೦ಚೆ',
'emailfrom'       => 'ಇಂದ',
'emailto'         => 'ಗೆ',
'emailsubject'    => 'ವಿಷಯ',
'emailmessage'    => 'ಸಂದೇಶ',
'emailsend'       => 'ಕಳುಹಿಸಿ',
'emailsent'       => 'ಇ-ಅಂಚೆ ಕಳುಹಿಸಲಾಯಿತು',
'emailsenttext'   => 'ನಿಮಗೆ ವಿ-ಅಂಚೆ ಕಳಿಸಲಾಗಿದೆ.',

# Watchlist
'watchlist'            => 'ವೀಕ್ಷಣಾ ಪಟ್ಟಿ',
'mywatchlist'          => 'ನನ್ನ ವೀಕ್ಷಣಾಪಟ್ಟಿ',
'nowatchlist'          => 'ನಿಮ್ಮ ವೀಕ್ಷಣಾಪಟ್ಟಿಯಲ್ಲಿ ಯಾವುದೇ ಪುಟಗಳಿಲ್ಲ',
'watchnologin'         => 'ಲಾಗಿನ್ ಆಗಿಲ್ಲ',
'addedwatch'           => 'ವೀಕ್ಷಣಾ ಪಟ್ಟಿಗೆ ಸೇರಿಸಲಾಯಿತು',
'addedwatchtext'       => '"$1" ಪುಟವನ್ನು ನಿಮ್ಮ [[Special:Watchlist|ವೀಕ್ಷಣಾಪಟ್ಟಿಗೆ]] ಸೇರಿಸಲಾಗಿದೆ. ಈ ಪುಟದ ಮತ್ತು ಇದರ ಚರ್ಚಾ ಪುಟದ ಮುಂದಿನ ಬದಲಾವಣೆಗಳು ವೀಕ್ಷಣಾ ಪಟ್ಟಿಯಲ್ಲಿ ಕಾಣಸಿಗುತ್ತವೆ, ಮತ್ತು [[Special:Recentchanges|ಇತ್ತೀಚೆಗಿನ ಬದಲಾವಣೆಗಳ]] ಪಟ್ಟಿಯಲ್ಲಿ ಈ ಪುಟಗಳನ್ನು ದಪ್ಪಕ್ಷರಗಳಲ್ಲಿ ಕಾಣಿಸಲಾಗುವುದು.

<p>ಈ ಪುಟವನ್ನು ವೀಕ್ಷಣಾ ಪಟ್ಟಿಯಿಂದ ತೆಗೆಯಬಯಸಿದಲ್ಲಿ, ಮೇಲ್ಪಟ್ಟಿಯಲ್ಲಿ ಕಾಣಿಸಿರುವ "ವೀಕ್ಷಣಾ ಪುಟದಿಂದ ತೆಗೆ" ಅನ್ನು ಕ್ಲಿಕ್ಕಿಸಿ.',
'watch'                => 'ವೀಕ್ಷಿಸಿ',
'watchthispage'        => 'ಈ ಪುಟವನ್ನು ವೀಕ್ಷಿಸಿ',
'unwatch'              => 'ವೀಕ್ಷಣಾ ಪಟ್ಟಿಯಿಂದ ತೆಗೆ',
'watchlist-hide-bots'  => 'ಬಾಟ್ ಸಂಪಾದನೆಗಳನ್ನು ಅಡಗಿಸು',
'watchlist-hide-own'   => 'ನನ್ನ ಸಂಪಾದನೆಗಳನ್ನು ಅಡಗಿಸು',
'watchlist-hide-minor' => 'ಚಿಕ್ಕಪುಟ್ಟ ಬದಲಾವಣೆಗಳನ್ನು ಅಡಗಿಸು',

'enotif_reset'       => 'ಭೇಟಿಯಿತ್ತ ಎಲ್ಲಾ ಪುಟಗಳನ್ನು ಗುರುತು ಮಾಡಿ',
'enotif_newpagetext' => 'ಇದೊಂದು ಹೊಸ ಪುಟ.',
'changed'            => 'ಬದಲಾಯಿಸಲಾಗಿದೆ',
'enotif_lastvisited' => 'ನಿಮ್ಮ ಕಳೆದ ಭೇಟಿಯ ನಂತರದ ಎಲ್ಲಾ ಬದಲಾವಣೆಗಳಿಗೆ $1 ನೋಡಿ.',

# Delete/protect/revert
'deletepage'        => 'ಪುಟವನ್ನು ಅಳಿಸಿ',
'confirm'           => 'ಧೃಡಪಡಿಸು',
'exblank'           => 'ಪುಟ ಖಾಲಿ ಇತ್ತು',
'confirmdelete'     => 'ಅಳಿಸುವಿಕೆ ಧೃಡಪಡಿಸು',
'deletesub'         => '("$1" ಅನ್ನು ಅಳಿಸಲಾಗುತ್ತಿದೆ)',
'confirmdeletetext' => 'ಪುಟ ಅಥವಾ ಚಿತ್ರ ಮತ್ತು ಅದರ ಸಂಪೂರ್ಣ ಇತಿಹಾಸವನ್ನು ನೀವು ಶಾಶ್ವತವಾಗಿ ಅಳಿಸಿಹಾಕುತ್ತಿದ್ದೀರಿ. ಇದನ್ನು ನೀವು ಮಾಡಬಯಸುವಿರಿ, ಇದರ ಪರಿಣಾಮಗಳನ್ನು ಬಲ್ಲಿರಿ, ಮತ್ತು [[{{MediaWiki:Policy-url}}]] ನ ಅನುಸಾರ ಇದನ್ನು ಮಾಡುತ್ತಿದ್ದೀರಿ ಎಂದು ದೃಢಪಡಿಸಿ.',
'actioncomplete'    => 'ಕಾರ್ಯ ಸಂಪೂರ್ಣ',
'deletedtext'       => '"$1" ಅನ್ನು ಅಳಿಸಲಾಯಿತು.
ಇತ್ತೀಚೆಗಿನ ಅಳಿಸುವಿಕೆಗಳ ಪಟ್ಟಿಗಾಗಿ $2 ಅನ್ನು ನೋಡಿ.',
'deletedarticle'    => '"$1" ಅಳಿಸಲಾಯಿತು',
'deletionlog'       => 'ಅಳಿಸುವಿಕೆ ದಿನಚರಿ',
'deletecomment'     => 'ಅಳಿಸುವುದರ ಕಾರಣ',
'protectlogpage'    => 'ಸಂರಕ್ಷಣೆ ದಿನಚರಿ',
'confirmprotect'    => 'ಸಂರಕ್ಷಣೆ ಧೃಡಪಡಿಸಿ',
'protectcomment'    => 'ಸ೦ರಕ್ಷಿಸಲು ಕಾರಣ',

# Namespace form on various pages
'blanknamespace' => '(ಮುಖ್ಯ)',

# Contributions
'contributions' => 'ಸದಸ್ಯರ ಕಾಣಿಕೆಗಳು',
'mycontris'     => 'ನನ್ನ ಕಾಣಿಕೆಗಳು',
'contribsub2'   => '$1 ($2) ಗೆ',
'uctop'         => ' (ಮೇಲಕ್ಕೆ)',

'sp-contributions-search' => 'ಸಂಪಾದನೆಗಳನ್ನು ಹುಡುಕು',
'sp-contributions-submit' => 'ಹುಡುಕು',

# What links here
'whatlinkshere'       => 'ಇಲ್ಲಿಗೆ ಯಾವ ಸಂಪರ್ಕ ಕೂಡುತ್ತದೆ',
'whatlinkshere-title' => '"$1" ಪುಟಕ್ಕೆ ಸಂಪರ್ಕ ಹೊಂದಿರುವ ಪುಟಗಳು',
'linklistsub'         => '(ಸ೦ಪರ್ಕಗಳ ಪಟ್ಟಿ)',
'linkshere'           => "'''[[:$1]]'''ಗೆ ಈ ಪುಟಗಳು ಸಂಪರ್ಕ ಹೊಂದಿವೆ:",
'nolinkshere'         => "'''[[:$1]]''' ಗೆ ಯಾವ ಪುಟಗಳೂ ಸಂಪರ್ಕ ಹೊಂದಿಲ್ಲ.",
'istemplate'          => 'ಸೇರ್ಪಡೆ',
'whatlinkshere-prev'  => '{{PLURAL:$1|ಹಿಂದಿನ|ಹಿಂದಿನ $1}}',
'whatlinkshere-next'  => '{{PLURAL:$1|ಮುಂದಿನ|ಮುಂದಿನ $1}}',

# Block/unblock
'blockip'            => 'ಈ ಸದಸ್ಯನನ್ನು ತಡೆ ಹಿಡಿಯಿರಿ',
'ipbreason'          => 'ಕಾರಣ',
'ipbsubmit'          => 'ಈ ಸದಸ್ಯರನ್ನು ತಡೆಹಿಡಿಯಿರಿ',
'blockipsuccesssub'  => 'ತಡೆಹಿಡಿಯುವಿಕೆ ಯಶಸ್ವಿಯಾಯಿತು.',
'blockipsuccesstext' => '"$1" ಐಪಿ ಸಂಖ್ಯೆಯನ್ನು ತಡೆ ಹಿಡಿಯಲಾಗಿದೆ. <br /> ತಡೆಗಳನ್ನು ಪರಿಶೀಲಿಸಲು [[Special:Ipblocklist|ತಡೆ ಹಿಡಿಯಲಾಗಿರುವ ಐಪಿ ಸಂಖ್ಯೆಗಳ ಪಟ್ಟಿ]] ನೋಡಿ.',
'ipblocklist'        => 'ಬ್ಲಾಕ್ ಮಾಡಲಾದ ಐಪಿ ವಿಳಾಸಗಳ ಹಾಗೂ ಬಳಕೆಯ ಹೆಸರುಗಳ ಪಟ್ಟಿ',
'infiniteblock'      => 'ಅನಂತ',
'blocklink'          => 'ತಡೆ ಹಿಡಿಯಿರಿ',
'contribslink'       => 'ಕಾಣಿಕೆಗಳು',
'blocklogpage'       => 'ತಡೆಹಿಡಿದ ಸದಸ್ಯರ ದಿನಚರಿ',
'blocklogentry'      => '"$1" ಅನ್ನು $2 ರ ಸಮಯದವರೆಗೆ ತಡೆಹಿಡಿಯಲಾಗಿದೆ',

# Move page
'movepage'        => 'ಪುಟವನ್ನು ಸ್ಥಳಾಂತರಿಸಿ',
'movearticle'     => 'ಪುಟವನ್ನು ಸ್ಥಳಾಂತರಿಸಿ',
'movenologin'     => 'ಲಾಗಿನ್ ಆಗಿಲ್ಲ',
'movenologintext' => 'ಪುಟವನ್ನು ಸ್ಥಳಾಂತರಿಸಲು ನೀವು ನೋಂದಾಯಿತ ಸದಸ್ಯರಾಗಿದ್ದು [[Special:Userlogin|ಲಾಗಿನ್]] ಆಗಿರಬೇಕು.',
'movepagebtn'     => 'ಪುಟವನ್ನು ಸ್ಥಳಾಂತರಿಸಿ',
'pagemovedsub'    => 'ಸ್ಥಳಾ೦ತರಿಸುವಿಕೆ ಯಶಸ್ವಿಯಾಯಿತು',
'1movedto2'       => '[[$1]] - [[$2]] ಪುಟಕ್ಕೆ ಸ್ಥಳಾಂತರಿಸಲಾಗಿದೆ',
'1movedto2_redir' => '[[$1]] - [[$2]] ಪುಟ ರಿಡೈರೆಕ್ಟ್ ಮೂಲಕ ಸ್ಥಳಾಂತರಿಸಲಾಗಿದೆ',
'movereason'      => 'ಕಾರಣ',

# Export
'export' => 'ಪುಟಗಳನ್ನು ರಫ್ತು ಮಾಡಿ',

# Namespace 8 related
'allmessages'         => 'ಸಂಪರ್ಕ ಸಾಧನದ ಎಲ್ಲ ಸಂದೇಶಗಳು',
'allmessagesmodified' => 'ಬದಲಾವಣೆ ಮಾಡಿದ್ದನ್ನು ಮಾತ್ರ ತೋರಿಸು',

# Special:Import
'import'             => 'ಪುಟಗಳನ್ನು ಅಮದು ಮಾಡಿ',
'importfailed'       => 'ಆಮದು ಯಶಸ್ವಿಯಾಗಲಿಲ್ಲ: $1',
'importbadinterwiki' => 'ಇಂಟರ್‍ವಿಕಿ ಲಿಂಕ್ ಸರಿಯಾಗಿಲ್ಲ',
'importnotext'       => 'ಖಾಲಿ ಅಥವಾ ಯಾವುದೇ ಶಬ್ಧಗಳಿಲ್ಲ',
'importsuccess'      => 'ಆಮದು ಯಶಸ್ವಿಯಾಯಿತು!',

# Tooltip help for the actions
'tooltip-pt-userpage'       => 'ನನ್ನ ಸದಸ್ಯ ಪುಟ',
'tooltip-pt-mytalk'         => 'ನನ್ನ ಚರ್ಚೆ ಪುಟ',
'tooltip-pt-mycontris'      => 'ನನ್ನ ಕಾಣಿಕೆಗಳ ಪಟ್ಟಿ',
'tooltip-ca-edit'           => 'ಈ ಪುಟವನ್ನು ನೀವು ಸಂಪಾದಿಸಬಹುದು. ಉಳಿಸುವ ಮುನ್ನ ಮುನ್ನೋಟವನ್ನು ಉಪಯೋಗಿಸಿ.',
'tooltip-ca-watch'          => 'ಈ ಪುಟವನ್ನು ನಿಮ್ಮ ವೀಕ್ಷಣಾಪಟ್ಟಿಗೆ ಸೇರಿಸಿ',
'tooltip-n-mainpage'        => 'ಮುಖ್ಯ ಪುಟ ನೋಡಿ',
'tooltip-n-recentchanges'   => 'ವಿಕಿಯಲ್ಲಿನ ಇತ್ತೀಚಿನ ಬದಲಾವಣೆಗಳ ಪಟ್ಟಿ.',
'tooltip-t-whatlinkshere'   => 'ಇಲ್ಲಿಗೆ ಸಂಪರ್ಕ ಹೊಂದಿರುವ ಎಲ್ಲಾ ವಿಕಿ ಪುಟಗಳ ಪಟ್ಟಿ',
'tooltip-t-upload'          => 'ಚಿತ್ರಗಳನ್ನು ಅಥವ ಮೀಡಿಯ ಫೈಲುಗಳನ್ನು ಅಪ್ಲೋಡ್ ಮಾಡಿ',
'tooltip-t-specialpages'    => 'ಎಲ್ಲಾ ವಿಶೇಷ ಪುಟಗಳ ಪಟ್ಟಿ',
'tooltip-ca-nstab-image'    => 'ಚಿತ್ರದ ಪುಟ ವೀಕ್ಷಿಸಿ',
'tooltip-ca-nstab-category' => 'ವರ್ಗದ ಪುಟವನ್ನು ನೋಡಿ',
'tooltip-save'              => 'ನಿಮ್ಮ ಬದಲಾವಣೆಗಳನ್ನು ಉಳಿಸಿ',

# Attribution
'anonymous'     => '{{SITENAME}} : ಅನಾಮಧೇಯ ಬಳಕೆದಾರ(ರು)',
'and'           => 'ಮತ್ತು',
'othercontribs' => '$1 ರ ಕೆಲಸವನ್ನು ಆಧರಿಸಿ.',
'creditspage'   => 'ಪುಟದ ಗೌರವಗಳು',

# Spam protection
'subcategorycount'     => 'ಒಟ್ಟು $1 ಉಪವಿಭಾಗಗಳು ಈ ವರ್ಗದಡಿ ಇವೆ.',
'categoryarticlecount' => 'ಈ ವರ್ಗದಲ್ಲಿ {{PLURAL:$1|ಒಂದು ಲೇಖನ| $1 ಲೇಖನಗಳು}} ಇವೆ.',
'category-media-count' => 'ಈ ವರ್ಗದಲ್ಲಿ {{PLURAL:$1|ಒಂದು ಫೈಲು|$1 ಫೈಲುಗಳು}} ಇವೆ.',

# Browsing diffs
'previousdiff' => '← ಹಿಂದಿನ ವ್ಯತ್ಯಾಸ',
'nextdiff'     => 'ಮುಂದಿನ ವ್ಯತ್ಯಾಸ',

# 'all' in various places, this might be different for inflected languages
'recentchangesall' => 'ಎಲ್ಲಾ',
'imagelistall'     => 'ಎಲ್ಲಾ',
'watchlistall2'    => 'ಎಲ್ಲಾ',
'namespacesall'    => 'ಎಲ್ಲಾ',
'monthsall'        => 'ಎಲ್ಲಾ',

# E-mail address confirmation
'confirmemail' => 'ಇ-ಅಂಚೆ ವಿಳಾಸವನ್ನು ಖಾತ್ರಿ ಮಾಡಿ',

# Delete conflict
'deletedwhileediting' => 'ಸೂಚನೆ: ನೀವು ಸಂಪಾದನೆ ಪ್ರಾರಂಭಿಸಿದ ನಂತರ ಈ ಪುಟವನ್ನು ಅಳಿಸಲಾಗಿದೆ!',

# Multipage image navigation
'imgmultipageprev' => '← ಹಿಂದಿನ ಪುಟ',
'imgmultipagenext' => 'ಮುಂದಿನ ಪುಟ →',

# Table pager
'table_pager_next'  => 'ಮುಂದಿನ ಪುಟ',
'table_pager_prev'  => 'ಹಿಂದಿನ ಪುಟ',
'table_pager_first' => 'ಮೊದಲ ಪುಟ',
'table_pager_last'  => 'ಕೊನೆಯ ಪುಟ',

# Auto-summaries
'autosumm-blank' => 'ಪುಟದಲ್ಲಿರುವ ಎಲ್ಲಾ ಮಾಹಿತಿಯನ್ನೂ ತಗೆಯುತ್ತಿರುವೆ',
'autosumm-new'   => 'ಹೊಸ ಪುಟ: $1',

# Watchlist editor
'watchlistedit-noitems' => 'ನಿಮ್ಮ ವೀಕ್ಷಣಾಪಟ್ಟಿಯಲ್ಲಿ ಯಾವುದೂ ಪುಟಗಳಿಲ್ಲ.',

);
