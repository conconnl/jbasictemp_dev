<?php defined( '_JEXEC' ) or die;

// begin function compress
function compress($buffer) 
{
	// remove comments
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	// remove tabs, spaces, new lines, etc.
	$buffer = str_replace(array("\r\n","\r","\n","\t",'  ','    ','    '),'',$buffer);
	// remove unnecessary spaces
	$buffer = str_replace('{ ', '{', $buffer);
	$buffer = str_replace(' }', '}', $buffer);
	$buffer = str_replace('; ', ';', $buffer);
	$buffer = str_replace(', ', ',', $buffer);
	$buffer = str_replace(' {', '{', $buffer);
	$buffer = str_replace('} ', '}', $buffer);
	$buffer = str_replace(': ', ':', $buffer);
	$buffer = str_replace(' ,', ',', $buffer);
	$buffer = str_replace(' ;', ';', $buffer);
	$buffer = str_replace(';}', '}', $buffer);

	return $buffer;
}

$uri = $this->baseurl.'/templates/'.$this->template;
// less compiler
$lesspath = __DIR__;
require_once $lesspath . '/less.php';
$less_files = array( $lesspath . '/../../css/template/template.less' => $uri);
$options = array( 'cache_dir' => $lesspath.'/cache/' );
$css_file_name = Less_Cache::Get( $less_files, $options );
$compiled = file_get_contents( $lesspath.'/cache/'.$css_file_name );

if (file_exists($lesspath.'/cache/'.$css_file_name))
{
	// merge files
	$compiled = file_get_contents( $lesspath.'/cache/'.$css_file_name );
	$compiled .= file_get_contents(JUri::base().'/media/system/css/system.css');
	$compiled .= file_get_contents(JPATH_THEMES.'/system/css/system.css');
	$compiled .= file_get_contents(JPATH_THEMES.'/system/css/general.css');

	// get parameters from template
	$less = new lessc;
	$app = JFactory::getApplication('site');
	$template = $app->getTemplate(true);
	
		$bgcolor1 = $template->params->get('bgcolor1');
		$bgcolor2 = $template->params->get('bgcolor2');
		$bgcolor3 = $template->params->get('bgcolor3');
		$bgcolor4 = $template->params->get('bgcolor4');
		$bgcolor5 = $template->params->get('bgcolor5');
		$compiled .= $less->compile(".bg-color1 { background-color:$bgcolor1; }");
		$compiled .= $less->compile(".bg-color2 { background-color:$bgcolor2; }");
		$compiled .= $less->compile(".bg-color3 { background-color:$bgcolor3; }");
		$compiled .= $less->compile(".bg-color4 { background-color:$bgcolor4; }");
		$compiled .= $less->compile(".bg-color5 { background-color:$bgcolor5; }");

		$fontcolorlight = $template->params->get('fontcolorlight');
		$headingcolorlight = $template->params->get('headingcolorlight');
		$fontcolordark = $template->params->get('fontcolordark');
		$headingcolordark = $template->params->get('headingcolordark');
		$compiled .= $less->compile(".fontcolor-dark { color:$fontcolordark; h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {color: $headingcolordark;}}");
		$compiled .= $less->compile(".fontcolor-light { color:$fontcolorlight; h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {color: $headingcolorlight;}}");

		$paddingnone = $template->params->get('paddingnone');
		$paddingnormal = $template->params->get('paddingnormal');
		$paddinglarge = $template->params->get('paddinglarge');
		$compiled .= $less->compile(".padding-none { padding-bottom:$paddingnone; padding-top:$paddingnone; }");
		$compiled .= $less->compile(".padding-normal { padding-bottom:$paddingnormal; padding-top:$paddingnormal; }");
		$compiled .= $less->compile(".padding-large { padding-bottom:$paddinglarge; padding-top:$paddinglarge; }");

	$compressed = compress($compiled);

	file_put_contents($lesspath.'/../../css/template.css', $compressed);
}
