<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* admin/create.html.twig */
class __TwigTemplate_5c49c31868a969fc75ab4b1ab7467ce90091d312a38fcff76df99001869893b2 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/create.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/create.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/create.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 2
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 3
        echo "\t<!-- Creation title -->
\t<h1>Création d'un article</h1>

\t<!-- Creation form -->
\t";
        // line 7
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 7, $this->source); })()), 'form_start');
        echo "

\t";
        // line 10
        echo "
\t<div class=\"form-group\">
\t\t<label for=\"\">Titre</label>
\t\t";
        // line 13
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 13, $this->source); })()), "title", [], "any", false, false, false, 13), 'widget', ["attr" => ["placeholder" => "Titre de l'article"]]);
        echo "
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Contenu</label>
\t\t";
        // line 17
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 17, $this->source); })()), "content", [], "any", false, false, false, 17), 'widget', ["attr" => ["placeholder" => "Contenu de l'article"]]);
        echo "
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Image</label>
\t\t";
        // line 22
        echo "\t\t";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 22, $this->source); })()), "imageFile", [], "any", false, false, false, 22), 'widget');
        echo "
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Libellés</label>
\t\t";
        // line 26
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 26, $this->source); })()), "wordings", [], "any", false, false, false, 26), 'widget');
        echo "
\t</div>

\t<button type=\"submit\" class=\"btn btn-success\">
\t\t<!-- If editMode, display the appropriate button -->
\t\t";
        // line 31
        if ((isset($context["editMode"]) || array_key_exists("editMode", $context) ? $context["editMode"] : (function () { throw new RuntimeError('Variable "editMode" does not exist.', 31, $this->source); })())) {
            // line 32
            echo "\t\t\tEnregistrer
\t\t";
        } else {
            // line 34
            echo "\t\t\tAjouter l'article
\t\t";
        }
        // line 36
        echo "\t</button>

\t";
        // line 38
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["formArticle"]) || array_key_exists("formArticle", $context) ? $context["formArticle"] : (function () { throw new RuntimeError('Variable "formArticle" does not exist.', 38, $this->source); })()), 'form_end');
        echo "
\t<style>
\t\t.custom-file-label { opacity: 0; }
\t\t.custom-file-input { opacity: 1; }
\t</style>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "admin/create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 38,  124 => 36,  120 => 34,  116 => 32,  114 => 31,  106 => 26,  98 => 22,  91 => 17,  84 => 13,  79 => 10,  74 => 7,  68 => 3,  58 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}
{% block body %}
\t<!-- Creation title -->
\t<h1>Création d'un article</h1>

\t<!-- Creation form -->
\t{{ form_start(formArticle) }}

\t{# {{ form_error() }} #}

\t<div class=\"form-group\">
\t\t<label for=\"\">Titre</label>
\t\t{{ form_widget(formArticle.title, {'attr' : {'placeholder': \"Titre de l'article\"}}) }}
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Contenu</label>
\t\t{{ form_widget(formArticle.content, {'attr' : {'placeholder': \"Contenu de l'article\"}}) }}
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Image</label>
\t\t{# Bootstrap issue to see selected file on the input, not resolved yet -> check the style#}
\t\t{{ form_widget(formArticle.imageFile ) }}
\t</div>
\t<div class=\"form-group\">
\t\t<label for=\"\">Libellés</label>
\t\t{{ form_widget(formArticle.wordings) }}
\t</div>

\t<button type=\"submit\" class=\"btn btn-success\">
\t\t<!-- If editMode, display the appropriate button -->
\t\t{% if editMode %}
\t\t\tEnregistrer
\t\t{% else %}
\t\t\tAjouter l'article
\t\t{% endif %}
\t</button>

\t{{ form_end(formArticle) }}
\t<style>
\t\t.custom-file-label { opacity: 0; }
\t\t.custom-file-input { opacity: 1; }
\t</style>
{% endblock %}
", "admin/create.html.twig", "/Applications/MAMP/htdocs/almalusa/templates/admin/create.html.twig");
    }
}
