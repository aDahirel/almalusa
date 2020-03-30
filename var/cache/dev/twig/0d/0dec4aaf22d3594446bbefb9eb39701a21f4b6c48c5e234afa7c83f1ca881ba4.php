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

/* blog/index.html.twig */
class __TwigTemplate_4aed4c837df1a610b70c0e6a223770a468b09f8f76208136e35eb92bee7b9bfc extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "blog/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "\t<!-- Articles section -->
\t<section
\t\tclass=\"articles\">
\t\t<!-- Display all the articles in database -->
\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["articles"]) || array_key_exists("articles", $context) ? $context["articles"] : (function () { throw new RuntimeError('Variable "articles" does not exist.', 8, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["article"]) {
            // line 9
            echo "\t\t\t<article
\t\t\t\tclass=\"mb-5\">
\t\t\t\t<!-- Article title -->
\t\t\t\t<h2>";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "title", [], "any", false, false, false, 12), "html", null, true);
            echo "</h2>
\t\t\t\t<!-- Article content -->
\t\t\t\t<div
\t\t\t\t\tclass=\"content\">
\t\t\t\t\t<!-- Article picture -->
\t\t\t\t\t<img src=\"";
            // line 17
            echo twig_escape_filter($this->env, $this->extensions['Vich\UploaderBundle\Twig\Extension\UploaderExtension']->asset($context["article"], "imageFile"), "html", null, true);
            echo "\" alt=\"\" width=\"50%\" height=\"50%\">
\t\t\t\t\t<p>";
            // line 18
            echo twig_get_attribute($this->env, $this->source, $context["article"], "content", [], "any", false, false, false, 18);
            echo "</p>
\t\t\t\t\t<!-- Article date -->
\t\t\t\t\t<div class=\"metadata\">Ecrit le
\t\t\t\t\t\t";
            // line 21
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "createdAt", [], "any", false, false, false, 21), "d/m/y"), "html", null, true);
            echo "
\t\t\t\t\t\tà
\t\t\t\t\t\t";
            // line 23
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["article"], "createdAt", [], "any", false, false, false, 23), "H:i"), "html", null, true);
            echo "
\t\t\t\t\t\t<!-- Article category -->
\t\t\t\t\t\tdans les libellés :
\t\t\t\t\t\t";
            // line 26
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["article"], "wordings", [], "any", false, false, false, 26));
            foreach ($context['_seq'] as $context["_key"] => $context["wording"]) {
                // line 27
                echo "\t\t\t\t\t\t
\t\t\t\t\t\t";
                // line 28
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["wording"], "title", [], "any", false, false, false, 28), "html", null, true);
                echo "

\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['wording'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "\t\t\t\t\t</div><br>
\t\t\t\t\t<!-- Article page button -->
\t\t\t\t\t<a href=\"";
            // line 33
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_show", ["id" => twig_get_attribute($this->env, $this->source, $context["article"], "id", [], "any", false, false, false, 33)]), "html", null, true);
            echo "\" class=\"btn btn-primary\">Lire la suite</a>
\t\t\t\t</div>
\t\t\t</article>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['article'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "\t</section>
\t<!-- / Articles section -->
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "blog/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  142 => 37,  132 => 33,  128 => 31,  119 => 28,  116 => 27,  112 => 26,  106 => 23,  101 => 21,  95 => 18,  91 => 17,  83 => 12,  78 => 9,  74 => 8,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
\t<!-- Articles section -->
\t<section
\t\tclass=\"articles\">
\t\t<!-- Display all the articles in database -->
\t\t{% for article in articles %}
\t\t\t<article
\t\t\t\tclass=\"mb-5\">
\t\t\t\t<!-- Article title -->
\t\t\t\t<h2>{{ article.title }}</h2>
\t\t\t\t<!-- Article content -->
\t\t\t\t<div
\t\t\t\t\tclass=\"content\">
\t\t\t\t\t<!-- Article picture -->
\t\t\t\t\t<img src=\"{{ vich_uploader_asset(article, 'imageFile') }}\" alt=\"\" width=\"50%\" height=\"50%\">
\t\t\t\t\t<p>{{ article.content | raw }}</p>
\t\t\t\t\t<!-- Article date -->
\t\t\t\t\t<div class=\"metadata\">Ecrit le
\t\t\t\t\t\t{{ article.createdAt | date('d/m/y') }}
\t\t\t\t\t\tà
\t\t\t\t\t\t{{ article.createdAt | date('H:i') }}
\t\t\t\t\t\t<!-- Article category -->
\t\t\t\t\t\tdans les libellés :
\t\t\t\t\t\t{% for wording in article.wordings %}
\t\t\t\t\t\t
\t\t\t\t\t\t{{ wording.title }}

\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t</div><br>
\t\t\t\t\t<!-- Article page button -->
\t\t\t\t\t<a href=\"{{ path('blog_show', {'id' : article.id}) }}\" class=\"btn btn-primary\">Lire la suite</a>
\t\t\t\t</div>
\t\t\t</article>
\t\t{% endfor %}
\t</section>
\t<!-- / Articles section -->
{% endblock %}
", "blog/index.html.twig", "/Applications/MAMP/htdocs/almalusa/templates/blog/index.html.twig");
    }
}
