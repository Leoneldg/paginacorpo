<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* pages/setup/general/base_form.html.twig */
class __TwigTemplate_3d152556aa1629effbc498e0b39a1a5c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'config_fields' => [$this, 'block_config_fields'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 33
        yield "
";
        // line 34
        if (($context["canedit"] ?? null)) {
            // line 35
            yield "    <form name=\"form\"
          action=\"";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Glpi\Application\View\Extension\ItemtypeExtension']->getItemtypeFormPath("Config"), "html", null, true);
            yield "\"
          method=\"post\"
          data-track-changes=\"true\">
        <input type=\"hidden\" name=\"_glpi_csrf_token\" value=\"";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Session::getNewCSRFToken(), "html", null, true);
            yield "\" />
";
        }
        // line 41
        yield "
<div class=\"row\">
    ";
        // line 43
        yield from $this->unwrap()->yieldBlock('config_fields', $context, $blocks);
        // line 45
        yield "</div>

";
        // line 47
        if (($context["canedit"] ?? null)) {
            // line 48
            yield "        <div class=\"card-footer mx-n2 d-flex\">
            <button type=\"submit\" name=\"update\" value=\"1\" class=\"ms-auto btn btn-primary\">
                <i class=\"ti ti-device-floppy\"></i>
                <span>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(_x("button", "Save"), "html", null, true);
            yield "</span>
            </button>
        </div>
    </form>
";
        }
        return; yield '';
    }

    // line 43
    public function block_config_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "    ";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pages/setup/general/base_form.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  86 => 43,  75 => 51,  70 => 48,  68 => 47,  64 => 45,  62 => 43,  58 => 41,  53 => 39,  47 => 36,  44 => 35,  42 => 34,  39 => 33,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/setup/general/base_form.html.twig", "/var/www/corpocapital/glpi/templates/pages/setup/general/base_form.html.twig");
    }
}
