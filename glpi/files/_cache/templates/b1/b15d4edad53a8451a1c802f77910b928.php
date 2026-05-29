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

/* pages/setup/general/general_setup.html.twig */
class __TwigTemplate_51a2fe8a72ab51662df575ec40e89602 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'config_fields' => [$this, 'block_config_fields'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 34
        return "pages/setup/general/base_form.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 35
        $macros["fields"] = $this->macros["fields"] = $this->loadTemplate("components/form/fields_macros.html.twig", "pages/setup/general/general_setup.html.twig", 35)->unwrap();
        // line 39
        $context["field_options"] = ["field_class" => "col-12 col-xxl-6 col-sm-6", "label_class" => "col-xxl-8", "input_class" => "col-xxl-4"];
        // line 45
        $context["field_options"] = ["field_class" => "col-12 col-xxl-6 col-sm-6", "full_width" => true];
        // line 50
        $context["inline_field_options"] = Twig\Extension\CoreExtension::merge(($context["field_options"] ?? null), ["input_addclass" => "w-auto"]);
        // line 34
        $this->parent = $this->loadTemplate("pages/setup/general/base_form.html.twig", "pages/setup/general/general_setup.html.twig", 34);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 54
    public function block_config_fields($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 55
        yield "
<div class=\"row ps-4\">

    ";
        // line 58
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["url_base", (($__internal_compile_0 =         // line 60
($context["config"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["url_base"] ?? null) : null), __("URL of the application"),         // line 62
($context["field_options"] ?? null)], 58, $context, $this->getSourceContext());
        // line 63
        yield "

    ";
        // line 65
        yield CoreExtension::callMacro($macros["fields"], "macro_textareaField", ["text_login", (($__internal_compile_1 =         // line 67
($context["config"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["text_login"] ?? null) : null), __("Text in the login box"), Twig\Extension\CoreExtension::merge(        // line 69
($context["field_options"] ?? null), ["enable_richtext" => true, "enable_images" => false])], 65, $context, $this->getSourceContext());
        // line 73
        yield "

    ";
        // line 75
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["helpdesk_doc_url", (($__internal_compile_2 =         // line 77
($context["config"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["helpdesk_doc_url"] ?? null) : null), __("Simplified interface help link"),         // line 79
($context["field_options"] ?? null)], 75, $context, $this->getSourceContext());
        // line 80
        yield "

    ";
        // line 82
        yield CoreExtension::callMacro($macros["fields"], "macro_textField", ["central_doc_url", (($__internal_compile_3 =         // line 84
($context["config"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["central_doc_url"] ?? null) : null), __("Standard interface help link"),         // line 86
($context["field_options"] ?? null)], 82, $context, $this->getSourceContext());
        // line 87
        yield "

    ";
        // line 89
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["decimal_number", (($__internal_compile_4 =         // line 91
($context["config"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["decimal_number"] ?? null) : null), __("Default decimals limit"), Twig\Extension\CoreExtension::merge(        // line 93
($context["inline_field_options"] ?? null), ["min" => 1, "max" => 4])], 89, $context, $this->getSourceContext());
        // line 97
        yield "

    ";
        // line 99
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["use_public_faq", (($__internal_compile_5 =         // line 101
($context["config"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["use_public_faq"] ?? null) : null), __("Allow FAQ anonymous access"),         // line 103
($context["field_options"] ?? null)], 99, $context, $this->getSourceContext());
        // line 104
        yield "

</div>

<div class=\"hr-text\">
    <i class=\"ti ti-language\"></i>
    <span>";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Translations"), "html", null, true);
        yield "</span>
</div>

<div class=\"row ps-4\">

    ";
        // line 115
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["translate_dropdowns", (($__internal_compile_6 =         // line 117
($context["config"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["translate_dropdowns"] ?? null) : null), __("Translation of dropdowns"),         // line 119
($context["field_options"] ?? null)], 115, $context, $this->getSourceContext());
        // line 120
        yield "

    ";
        // line 122
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["translate_kb", (($__internal_compile_7 =         // line 124
($context["config"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["translate_kb"] ?? null) : null), __("Knowledge base translation"),         // line 126
($context["field_options"] ?? null)], 122, $context, $this->getSourceContext());
        // line 127
        yield "

    ";
        // line 129
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["translate_reminders", (($__internal_compile_8 =         // line 131
($context["config"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["translate_reminders"] ?? null) : null), __("Translation of reminders"),         // line 133
($context["field_options"] ?? null)], 129, $context, $this->getSourceContext());
        // line 134
        yield "

</div>

<div class=\"hr-text\">
    <i class=\"ti ti-list\"></i>
    <span>";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Dynamic display"), "html", null, true);
        yield "</span>
</div>

<div class=\"row ps-4\">

    ";
        // line 145
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["dropdown_max", (($__internal_compile_9 =         // line 147
($context["config"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["dropdown_max"] ?? null) : null), __("Page size for dropdown (paging using scroll)"), Twig\Extension\CoreExtension::merge(        // line 149
($context["inline_field_options"] ?? null), ["min" => 1, "max" => 200])], 145, $context, $this->getSourceContext());
        // line 153
        yield "

    ";
        // line 155
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownNumberField", ["ajax_limit_count", (($__internal_compile_10 =         // line 157
($context["config"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["ajax_limit_count"] ?? null) : null), __("Don't show search engine in dropdowns if the number of items is less than"), Twig\Extension\CoreExtension::merge(        // line 159
($context["inline_field_options"] ?? null), ["min" => 1, "max" => 200, "toadd" => ["0" => __("Never")], "width" => "auto"])], 155, $context, $this->getSourceContext());
        // line 165
        yield "
</div>

<div class=\"hr-text\">
    <i class=\"ti ti-search\"></i>
    <span>";
        // line 170
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Search engine"), "html", null, true);
        yield "</span>
</div>

<div class=\"row ps-4\">

    ";
        // line 175
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["allow_search_view", (($__internal_compile_11 =         // line 177
($context["config"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["allow_search_view"] ?? null) : null), [__("No"), Twig\Extension\CoreExtension::sprintf(__("%1\$s (%2\$s)"), __("Yes"), __("last criterion")), Twig\Extension\CoreExtension::sprintf(__("%1\$s (%2\$s)"), __("Yes"), __("default criterion"))], __("Items seen"), Twig\Extension\CoreExtension::merge(        // line 184
($context["inline_field_options"] ?? null), ["width" => "auto"])], 175, $context, $this->getSourceContext());
        // line 187
        yield "

    ";
        // line 189
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownYesNo", ["allow_search_global", (($__internal_compile_12 =         // line 191
($context["config"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["allow_search_global"] ?? null) : null), __("Global search"), Twig\Extension\CoreExtension::merge(        // line 193
($context["inline_field_options"] ?? null), ["width" => "auto"])], 189, $context, $this->getSourceContext());
        // line 196
        yield "

    ";
        // line 198
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["allow_search_all", (($__internal_compile_13 =         // line 200
($context["config"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["allow_search_all"] ?? null) : null), [__("No"), Twig\Extension\CoreExtension::sprintf(__("%1\$s (%2\$s)"), __("Yes"), __("last criterion"))], __("All"), Twig\Extension\CoreExtension::merge(        // line 206
($context["inline_field_options"] ?? null), ["width" => "auto"])], 198, $context, $this->getSourceContext());
        // line 209
        yield "

    ";
        // line 211
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["list_limit_max", (($__internal_compile_14 =         // line 213
($context["config"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["list_limit_max"] ?? null) : null), __("Default search results limit (page)"), Twig\Extension\CoreExtension::merge(        // line 215
($context["inline_field_options"] ?? null), ["min" => 5, "max" => 200, "step" => 5])], 211, $context, $this->getSourceContext());
        // line 220
        yield "

    ";
        // line 222
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["cut", (($__internal_compile_15 =         // line 224
($context["config"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["cut"] ?? null) : null), __("Default characters limit (summary text boxes)"), Twig\Extension\CoreExtension::merge(        // line 226
($context["inline_field_options"] ?? null), ["step" => 50])], 222, $context, $this->getSourceContext());
        // line 229
        yield "

    ";
        // line 231
        yield CoreExtension::callMacro($macros["fields"], "macro_numberField", ["url_maxlength", (($__internal_compile_16 =         // line 233
($context["config"] ?? null)) && is_array($__internal_compile_16) || $__internal_compile_16 instanceof ArrayAccess ? ($__internal_compile_16["url_maxlength"] ?? null) : null), __("Default url length limit"), Twig\Extension\CoreExtension::merge(        // line 235
($context["inline_field_options"] ?? null), ["min" => 20, "max" => 80, "step" => 5])], 231, $context, $this->getSourceContext());
        // line 240
        yield "

</div>

<div class=\"hr-text\">
    <i class=\"ti ti-lock\"></i>
    <span>";
        // line 246
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Item locks"), "html", null, true);
        yield "</span>
</div>

<div class=\"row ps-4\">

    ";
        // line 251
        $context["locks_rand"] = Twig\Extension\CoreExtension::random($this->env->getCharset());
        // line 252
        yield "    ";
        $context["id_lock_use_lock_item"] = ("lock_use_lock_item_" . ($context["locks_rand"] ?? null));
        // line 253
        yield "    ";
        $context["id_lock_lockprofile_id"] = ("dropdown_lock_lockprofile_id" . ($context["locks_rand"] ?? null));
        // line 254
        yield "    ";
        $context["id_lock_item_list_id"] = ("dropdown_lock_item_list" . ($context["locks_rand"] ?? null));
        // line 255
        yield "    ";
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["lock_use_lock_item", (($__internal_compile_17 =         // line 257
($context["config"] ?? null)) && is_array($__internal_compile_17) || $__internal_compile_17 instanceof ArrayAccess ? ($__internal_compile_17["lock_use_lock_item"] ?? null) : null), __("Use locks"), Twig\Extension\CoreExtension::merge(        // line 259
($context["field_options"] ?? null), ["id" =>         // line 260
($context["id_lock_use_lock_item"] ?? null)])], 255, $context, $this->getSourceContext());
        // line 262
        yield "

    ";
        // line 264
        $context["lock_options"] = ($context["field_options"] ?? null);
        // line 265
        yield "    ";
        if ( !(($__internal_compile_18 = ($context["config"] ?? null)) && is_array($__internal_compile_18) || $__internal_compile_18 instanceof ArrayAccess ? ($__internal_compile_18["lock_use_lock_item"] ?? null) : null)) {
            // line 266
            yield "        ";
            $context["lock_options"] = Twig\Extension\CoreExtension::merge(($context["lock_options"] ?? null), ["disabled" => true]);
            // line 269
            yield "    ";
        }
        // line 270
        yield "
    ";
        // line 271
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownField", ["Profile", "lock_lockprofile_id", (($__internal_compile_19 =         // line 274
($context["config"] ?? null)) && is_array($__internal_compile_19) || $__internal_compile_19 instanceof ArrayAccess ? ($__internal_compile_19["lock_lockprofile_id"] ?? null) : null), __("Profile to be used when locking items"), Twig\Extension\CoreExtension::merge(Twig\Extension\CoreExtension::merge(        // line 276
($context["inline_field_options"] ?? null), ($context["lock_options"] ?? null)), ["width" => "auto", "rand" =>         // line 278
($context["locks_rand"] ?? null), "condition" => ["interface" => "central"]])], 271, $context, $this->getSourceContext());
        // line 283
        yield "

    ";
        // line 285
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownArrayField", ["lock_item_list", "", $this->extensions['Glpi\Application\View\Extension\PhpExtension']->call("ObjectLock::getLockableObjects"), __("List of items to lock"), Twig\Extension\CoreExtension::merge(        // line 290
($context["lock_options"] ?? null), ["multiple" => true, "values" => (($__internal_compile_20 =         // line 292
($context["config"] ?? null)) && is_array($__internal_compile_20) || $__internal_compile_20 instanceof ArrayAccess ? ($__internal_compile_20["lock_item_list"] ?? null) : null), "rand" =>         // line 293
($context["locks_rand"] ?? null)])], 285, $context, $this->getSourceContext());
        // line 295
        yield "

    <script>
    \$(function(ready){
        \$('#";
        // line 299
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["id_lock_use_lock_item"] ?? null), "html", null, true);
        yield "').change(function(){
            var enabled = this.checked;
            \$('#";
        // line 301
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["id_lock_lockprofile_id"] ?? null), "html", null, true);
        yield "').prop('disabled', !enabled);
            \$('#";
        // line 302
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["id_lock_item_list_id"] ?? null), "html", null, true);
        yield "').prop('disabled', !enabled);
        });
    });
    </script>
</div>

<div class=\"hr-text\">
    <i class=\"ti ti-login\"></i>
    <span>";
        // line 310
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(__("Auto Login"), "html", null, true);
        yield "</span>
</div>

<div class=\"row ps-4\">

    ";
        // line 315
        yield CoreExtension::callMacro($macros["fields"], "macro_dropdownTimestampField", ["login_remember_time", (($__internal_compile_21 =         // line 317
($context["config"] ?? null)) && is_array($__internal_compile_21) || $__internal_compile_21 instanceof ArrayAccess ? ($__internal_compile_21["login_remember_time"] ?? null) : null), __("Time to allow \"Remember Me\""), Twig\Extension\CoreExtension::merge(        // line 319
($context["inline_field_options"] ?? null), ["emptylabel" => __("Disabled"), "min" => 0, "max" => (Twig\Extension\CoreExtension::constant("MONTH_TIMESTAMP") * 2), "step" => Twig\Extension\CoreExtension::constant("DAY_TIMESTAMP"), "toadd" => [Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP"), (Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP") * 2), (Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP") * 6), (Twig\Extension\CoreExtension::constant("HOUR_TIMESTAMP") * 12)], "width" => "auto"])], 315, $context, $this->getSourceContext());
        // line 332
        yield "

    ";
        // line 334
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["login_remember_default", (($__internal_compile_22 =         // line 336
($context["config"] ?? null)) && is_array($__internal_compile_22) || $__internal_compile_22 instanceof ArrayAccess ? ($__internal_compile_22["login_remember_default"] ?? null) : null), __("Default state of checkbox"),         // line 338
($context["field_options"] ?? null)], 334, $context, $this->getSourceContext());
        // line 339
        yield "

    ";
        // line 341
        yield CoreExtension::callMacro($macros["fields"], "macro_checkboxField", ["display_login_source", (($__internal_compile_23 =         // line 343
($context["config"] ?? null)) && is_array($__internal_compile_23) || $__internal_compile_23 instanceof ArrayAccess ? ($__internal_compile_23["display_login_source"] ?? null) : null), __("Display source dropdown on login page"),         // line 345
($context["field_options"] ?? null)], 341, $context, $this->getSourceContext());
        // line 346
        yield "
</div>

";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "pages/setup/general/general_setup.html.twig";
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
        return array (  351 => 346,  349 => 345,  348 => 343,  347 => 341,  343 => 339,  341 => 338,  340 => 336,  339 => 334,  335 => 332,  333 => 319,  332 => 317,  331 => 315,  323 => 310,  312 => 302,  308 => 301,  303 => 299,  297 => 295,  295 => 293,  294 => 292,  293 => 290,  292 => 285,  288 => 283,  286 => 278,  285 => 276,  284 => 274,  283 => 271,  280 => 270,  277 => 269,  274 => 266,  271 => 265,  269 => 264,  265 => 262,  263 => 260,  262 => 259,  261 => 257,  259 => 255,  256 => 254,  253 => 253,  250 => 252,  248 => 251,  240 => 246,  232 => 240,  230 => 235,  229 => 233,  228 => 231,  224 => 229,  222 => 226,  221 => 224,  220 => 222,  216 => 220,  214 => 215,  213 => 213,  212 => 211,  208 => 209,  206 => 206,  205 => 200,  204 => 198,  200 => 196,  198 => 193,  197 => 191,  196 => 189,  192 => 187,  190 => 184,  189 => 177,  188 => 175,  180 => 170,  173 => 165,  171 => 159,  170 => 157,  169 => 155,  165 => 153,  163 => 149,  162 => 147,  161 => 145,  153 => 140,  145 => 134,  143 => 133,  142 => 131,  141 => 129,  137 => 127,  135 => 126,  134 => 124,  133 => 122,  129 => 120,  127 => 119,  126 => 117,  125 => 115,  117 => 110,  109 => 104,  107 => 103,  106 => 101,  105 => 99,  101 => 97,  99 => 93,  98 => 91,  97 => 89,  93 => 87,  91 => 86,  90 => 84,  89 => 82,  85 => 80,  83 => 79,  82 => 77,  81 => 75,  77 => 73,  75 => 69,  74 => 67,  73 => 65,  69 => 63,  67 => 62,  66 => 60,  65 => 58,  60 => 55,  56 => 54,  51 => 34,  49 => 50,  47 => 45,  45 => 39,  43 => 35,  36 => 34,);
    }

    public function getSourceContext()
    {
        return new Source("", "pages/setup/general/general_setup.html.twig", "/var/www/corpocapital/glpi/templates/pages/setup/general/general_setup.html.twig");
    }
}
