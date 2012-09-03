<?php

/* MockUserBundle:User:login.html.twig */
class __TwigTemplate_cb38981dbe5bcfe3f3c9f80d701effd8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MockMobileBundle::layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "MockMobileBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<div>
";
        // line 6
        if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
        echo twig_escape_filter($this->env, $_message_, "html", null, true);
        echo "
</div>
<h2 class=\"title\">Login</h2>
<form class=\"form-horizontal\" action=\"/signin\" data-ajax=\"false\" method=\"post\">
\t<div class=\"control-group\">
\t\t<label class=\"control-label\" for=\"username\">Yahoo Email Address:</label>
    \t<div class=\"controls\">
\t\t\t<input type=\"text\" id=\"username\" required=\"required\" name=\"openid_identifier\" value=\"\" />
\t\t</div>
\t</div>

\t<input type=\"hidden\" name=\"_target_path\" value=\"/login\" />
   \t<button class=\"btn btn-primary btn-large\" type=\"submit\">login</button>
\t<a href=\"/signup\">Signup for MockMatchup</a>
</form>
";
    }

    public function getTemplateName()
    {
        return "MockUserBundle:User:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 6,  29 => 5,  26 => 4,);
    }
}
