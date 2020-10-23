<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* C:\Abdessamad_Chafry_Etude\Ampps\www\CakeCmsTuto_v0_4_1\CakeCmsTuto_v0_4_x-42cdae6e8005f1ee15cf9e786126a37504d4cdef\vendor\cakephp\bake\src\Template\Bake\Layout\default.twig */
class __TwigTemplate_c9ff58eae244ce99e327f9820be48e4b8a6787504e4d0eb99e378c530abc2491 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->enter($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "C:\\Abdessamad_Chafry_Etude\\Ampps\\www\\CakeCmsTuto_v0_4_1\\CakeCmsTuto_v0_4_x-42cdae6e8005f1ee15cf9e786126a37504d4cdef\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Layout\\default.twig"));

        // line 16
        echo $this->getAttribute(($context["_view"] ?? null), "fetch", [0 => "content"], "method");
        
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->leave($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof);

    }

    public function getTemplateName()
    {
        return "C:\\Abdessamad_Chafry_Etude\\Ampps\\www\\CakeCmsTuto_v0_4_1\\CakeCmsTuto_v0_4_x-42cdae6e8005f1ee15cf9e786126a37504d4cdef\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Layout\\default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
{{ _view.fetch('content')|raw }}", "C:\\Abdessamad_Chafry_Etude\\Ampps\\www\\CakeCmsTuto_v0_4_1\\CakeCmsTuto_v0_4_x-42cdae6e8005f1ee15cf9e786126a37504d4cdef\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Layout\\default.twig", "C:\\Abdessamad_Chafry_Etude\\Ampps\\www\\CakeCmsTuto_v0_4_1\\CakeCmsTuto_v0_4_x-42cdae6e8005f1ee15cf9e786126a37504d4cdef\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Layout\\default.twig");
    }
}
