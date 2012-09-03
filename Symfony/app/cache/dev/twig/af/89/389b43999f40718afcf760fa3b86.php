<?php

/* MockMobileBundle::layout.html.twig */
class __TwigTemplate_af89389b43999f40718afcf760fa3b86 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'scripts' => array($this, 'block_scripts'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html> 
<html> 
\t<head> 
\t<title>Mock Matchup</title> 
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> 
\t<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />\t
\t";
        // line 7
        $this->displayBlock('scripts', $context, $blocks);
        // line 16
        echo "\t
</head> 
<body> 

<div data-role=\"page\" data-theme=\"a\" data-form=\"ui-body-a\">
\t<div data-role=\"header\">
\t\t";
        // line 22
        echo $this->env->getExtension('actions')->renderAction("MockMobileBundle:Default:nav", array(), array());
        // line 23
        echo "\t</div>

\t<div data-role=\"content\" role=\"main\">
\t\t  ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        // line 27
        echo "\t
\t</div><!-- /content -->

</div><!-- /page -->

</body>
</html>";
    }

    // line 7
    public function block_scripts($context, array $blocks = array())
    {
        // line 8
        echo "\t<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/MockMobile/css/mock.min.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" href=\"http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css\" />
\t<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/MockMobile/css/mock_custom.css"), "html", null, true);
        echo "\" />
\t<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/MockMobile/js/jquery.carousel.css"), "html", null, true);
        echo "\" />
\t<script src=\"http://code.jquery.com/jquery-1.7.1.min.js\"></script>
\t<script src=\"http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js\"></script>

\t";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "\t\t  ";
    }

    public function getTemplateName()
    {
        return "MockMobileBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 27,  78 => 26,  69 => 11,  65 => 10,  59 => 8,  46 => 27,  39 => 23,  37 => 22,  29 => 16,  19 => 1,  228 => 85,  215 => 83,  211 => 82,  199 => 72,  193 => 71,  184 => 69,  181 => 68,  171 => 67,  161 => 65,  158 => 64,  154 => 63,  145 => 59,  137 => 53,  131 => 52,  123 => 50,  115 => 48,  112 => 47,  108 => 46,  99 => 40,  90 => 34,  73 => 19,  60 => 17,  56 => 7,  47 => 9,  44 => 26,  38 => 5,  34 => 4,  30 => 3,  27 => 7,);
    }
}