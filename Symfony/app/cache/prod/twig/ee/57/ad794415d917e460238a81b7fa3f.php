<?php

/* MockMatchBundle:Default:settings.html.twig */
class __TwigTemplate_ee57ad794415d917e460238a81b7fa3f extends Twig_Template
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

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<form action=\"/matchup/settings\" method=\"post\">
\t<div class=\"control-group\">
\t\t<label class=\"control-label\" for=\"username\">Season</label>
    \t<div class=\"controls\">
\t\t   <select data-iconpos=\"left\" name=\"league\" id=\"week\" >
\t\t\t\t";
        // line 9
        if (isset($context["leagues"])) { $_leagues_ = $context["leagues"]; } else { $_leagues_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_leagues_);
        foreach ($context['_seq'] as $context["_key"] => $context["league"]) {
            // line 10
            echo "\t\t\t\t\t";
            if (isset($context["league"])) { $_league_ = $context["league"]; } else { $_league_ = null; }
            if (isset($context["selected_league"])) { $_selected_league_ = $context["selected_league"]; } else { $_selected_league_ = null; }
            if (($this->getAttribute($_league_, "league_key") == $_selected_league_)) {
                // line 11
                echo "\t\t\t\t\t\t<option selected value=\"";
                if (isset($context["league"])) { $_league_ = $context["league"]; } else { $_league_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_league_, "league_key"), "html", null, true);
                echo "\">";
                if (isset($context["league"])) { $_league_ = $context["league"]; } else { $_league_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_league_, "season"), "html", null, true);
                echo "</option>
\t\t\t\t\t";
            } else {
                // line 13
                echo "\t\t\t\t\t\t<option value=\"";
                if (isset($context["league"])) { $_league_ = $context["league"]; } else { $_league_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_league_, "league_key"), "html", null, true);
                echo "\">";
                if (isset($context["league"])) { $_league_ = $context["league"]; } else { $_league_ = null; }
                echo twig_escape_filter($this->env, $this->getAttribute($_league_, "season"), "html", null, true);
                echo "</option>
\t\t\t\t\t";
            }
            // line 15
            echo "\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['league'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 16
        echo "\t\t   </select>
\t\t</div>
\t</div>
\t<button data-ajax=\"false\" type=\"submit\">Submit</button>
</form>
";
    }

    public function getTemplateName()
    {
        return "MockMatchBundle:Default:settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 16,  66 => 15,  56 => 13,  46 => 11,  41 => 10,  36 => 9,  29 => 4,  26 => 3,);
    }
}
