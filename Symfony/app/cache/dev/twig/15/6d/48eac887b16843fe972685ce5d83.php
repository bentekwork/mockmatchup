<?php

/* MockMatchBundle:Default:index.html.twig */
class __TwigTemplate_156d48eac887b16843fe972685ce5d83 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("MockMobileBundle::layout.html.twig");

        $this->blocks = array(
            'scripts' => array($this, 'block_scripts'),
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

    // line 2
    public function block_scripts($context, array $blocks = array())
    {
        // line 3
        $this->displayParentBlock("scripts", $context, $blocks);
        echo "
<script src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/MockMobile/js/jquery.carousel.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/MockMobile/js/mock.js"), "html", null, true);
        echo "\"></script>
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "<div class=\"ui-grid-b\">
\t<div class=\"ui-block-a team1_teams team1\">
\t\t<div class =\"show_name\">
\t\t
\t\t</div>
\t\t<div class=\"thumb\">
\t\t<ul>
\t\t";
        // line 16
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "teams"));
        foreach ($context['_seq'] as $context["_key"] => $context["team"]) {
            // line 17
            echo "\t\t     <li data-team=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "team_key"), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "name"), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "logo"), "html", null, true);
            echo "\" /></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['team'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 19
        echo "\t\t</ul>
\t\t</div>
\t</div>
\t<div class=\"ui-block-b results\">
\t\t<form id=\"mockmatchform\" data-ajax=\"false\" action=\"/matchup\" method=\"post\">
\t\t\t<div class=\"hideme control-group\">
\t\t\t\t<label class=\"control-label\" for=\"username\">League</label>
\t\t    \t<div class=\"controls\">
\t\t\t\t\t<input type=\"text\" id=\"username\" required=\"required\" name=\"league\" value=\"263.l.46750\" />
\t\t\t\t</div>
\t\t\t</div>

\t\t\t<div class=\"hideme control-group\">
\t\t\t\t<label class=\"control-label\" for=\"username\">Left Team Key</label>
\t\t    \t<div class=\"controls\">
\t\t\t\t\t<input type=\"text\" id=\"left_team\" required=\"required\" name=\"left_team_key\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->getContext($context, "left_team_key"), "html", null, true);
        echo "\" />
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"hideme control-group\">
\t\t\t\t<label class=\"control-label\" for=\"username\">Right Team Key</label>
\t\t    \t<div class=\"controls\">
\t\t\t\t\t<input type=\"text\" id=\"right_team\" required=\"required\" name=\"right_team_key\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->getContext($context, "right_team_key"), "html", null, true);
        echo "\" />
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"week_select\">
\t\t\t\t<div class=\"controlgroup\" data-role=\"controlgroup\" >
\t\t\t\t   <select data-iconpos=\"left\" data-mini=\"true\" name=\"week\" id=\"week\" class=\"team_select\">
\t\t\t\t\t\t";
        // line 46
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "weeks"));
        foreach ($context['_seq'] as $context["_key"] => $context["week"]) {
            // line 47
            echo "\t\t\t\t\t\t\t";
            if (($this->getAttribute($this->getContext($context, "week"), "num") == $this->getContext($context, "selected_week"))) {
                // line 48
                echo "\t\t\t\t\t\t\t\t<option selected value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "week"), "num"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "week"), "named"), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            } else {
                // line 50
                echo "\t\t\t\t\t\t\t\t<option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "week"), "num"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "week"), "named"), "html", null, true);
                echo "</option>
\t\t\t\t\t\t\t";
            }
            // line 52
            echo "\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['week'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 53
        echo "\t\t\t\t\t\t
\t\t\t\t   </select>
\t\t\t\t</div>\t\t
\t\t\t</div>
\t\t</form>
\t\t<div class = \"total\">
\t\t\t<h3>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "total"), "left_team"), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "total"), "right_team"), "html", null, true);
        echo "</h3>
\t\t</div>
\t\t<div class=\"results_scroll\">
\t\t\t<table>
\t\t\t";
        // line 63
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "scoreboard"));
        foreach ($context['_seq'] as $context["_key"] => $context["score"]) {
            // line 64
            echo "\t\t\t\t";
            if (($this->getAttribute($this->getContext($context, "score"), "stat_winner") == "left_team")) {
                // line 65
                echo "\t\t\t\t\t<tr><td class=\"win score\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "left_stat"), "html", null, true);
                echo "</td><td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "cat_name"), "html", null, true);
                echo "</td><td class=\"score\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "right_stat"), "html", null, true);
                echo "</td></tr>
\t\t\t\t";
            } elseif (($this->getAttribute($this->getContext($context, "score"), "stat_winner") == "right_team")) {
                // line 67
                echo "\t\t\t\t\t<tr><td class=\"score\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "left_stat"), "html", null, true);
                echo "</td><td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "cat_name"), "html", null, true);
                echo "</td><td class=\"win score\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "right_stat"), "html", null, true);
                echo "</td></tr>
\t\t\t\t";
            } else {
                // line 68
                echo "\t
\t\t\t\t\t<tr><td class=\"score\">";
                // line 69
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "left_stat"), "html", null, true);
                echo "</td><td>";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "cat_name"), "html", null, true);
                echo "</td><td class=\"score\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "score"), "right_stat"), "html", null, true);
                echo "</td></tr>
\t\t\t\t";
            }
            // line 71
            echo "\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['score'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 72
        echo "\t\t\t</table>
\t\t</div>
\t</div>

\t<div class=\"ui-block-c team2 team2_teams\">
\t\t<div class =\"show_name\">
\t
\t\t</div>
\t\t<div class=\"thumb2\">
\t\t<ul>
\t\t";
        // line 82
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "teams"));
        foreach ($context['_seq'] as $context["_key"] => $context["team"]) {
            // line 83
            echo "\t     \t<li data-team=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "team_key"), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "name"), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "team"), "logo"), "html", null, true);
            echo "\" /></li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['team'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 85
        echo "\t\t</ul>
\t\t</div>
\t</div>
</div><!-- /grid-b -->

";
    }

    public function getTemplateName()
    {
        return "MockMatchBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  228 => 85,  215 => 83,  211 => 82,  199 => 72,  193 => 71,  184 => 69,  181 => 68,  171 => 67,  161 => 65,  158 => 64,  154 => 63,  145 => 59,  137 => 53,  131 => 52,  123 => 50,  115 => 48,  112 => 47,  108 => 46,  99 => 40,  90 => 34,  73 => 19,  60 => 17,  56 => 16,  47 => 9,  44 => 8,  38 => 5,  34 => 4,  30 => 3,  27 => 2,);
    }
}
