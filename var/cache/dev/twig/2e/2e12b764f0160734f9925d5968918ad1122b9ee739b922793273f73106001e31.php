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

/* blog/show.html.twig */
class __TwigTemplate_4b8a6ac240e707564999f5286634c9815990d52cc7092eb5d793eb2c5a230fa3 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/show.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "blog/show.html.twig", 1);
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
        echo "\t<!-- Article page -->
\t<article
\t\tclass=\"my-4\">
\t\t<!-- Article title -->
\t\t<h2>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 8, $this->source); })()), "title", [], "any", false, false, false, 8), "html", null, true);
        echo "</h2>
\t\t<div
\t\t\tclass=\"content\">
\t\t\t<!-- Article picture -->
\t\t\t<img
\t\t\tsrc=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->extensions['Vich\UploaderBundle\Twig\Extension\UploaderExtension']->asset((isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 13, $this->source); })()), "imageFile"), "html", null, true);
        echo "\" alt=\"\" width=\"50%\" height=\"50%\">
\t\t\t<!-- Article content -->
\t\t\t<p>";
        // line 15
        echo twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 15, $this->source); })()), "content", [], "any", false, false, false, 15);
        echo "</p>
\t\t\t<!-- Article date -->
\t\t\t<div class=\"metadata\">Ecrit le
\t\t\t\t";
        // line 18
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 18, $this->source); })()), "createdAt", [], "any", false, false, false, 18), "d/m/y"), "html", null, true);
        echo "
\t\t\t\tà
\t\t\t\t";
        // line 20
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 20, $this->source); })()), "createdAt", [], "any", false, false, false, 20), "H:i"), "html", null, true);
        echo "
\t\t\t\tavec les libellés : 
\t\t\t\t";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 22, $this->source); })()), "wordings", [], "any", false, false, false, 22));
        foreach ($context['_seq'] as $context["_key"] => $context["wording"]) {
            // line 23
            echo "\t\t\t\t\t
\t\t\t\t\t";
            // line 24
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["wording"], "title", [], "any", false, false, false, 24), "html", null, true);
            echo "

\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['wording'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "\t\t\t</div>
\t\t</div>
\t\t<!-- Redirection to articles -->
\t\t<a href=\"";
        // line 30
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog");
        echo "\">
\t\t\t<button type=\"button\" class=\"btn btn-outline-primary my-4\">Retour</button>
\t\t</a>
\t\t<!-- If a user is connected dislay the modify button -->
\t\t";
        // line 34
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "user", [], "any", false, false, false, 34)) {
            // line 35
            echo "\t\t\t<a href=\"";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("blog_edit", ["id" => twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 35, $this->source); })()), "id", [], "any", false, false, false, 35)]), "html", null, true);
            echo "\">
\t\t\t\t<button type=\"button\" class=\"btn btn-outline-primary my-4\">Modifier</button>
\t\t\t</a>
\t\t";
        }
        // line 39
        echo "\t</article>
\t<!-- / Article page -->
\t<hr>
\t<!-- Comment section -->
\t<section
\t\tid=\"commentaires\">
\t\t<!-- Display the amount of comments -->
\t\t<h1 class=\"mb-5\">";
        // line 46
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 46, $this->source); })()), "comments", [], "any", false, false, false, 46)), "html", null, true);
        echo "
\t\t\tCommentaires :
\t\t</h1>
\t\t<!-- Display the comments -->
\t\t";
        // line 50
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 50, $this->source); })()), "comments", [], "any", false, false, false, 50));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 51
            echo "\t\t\t<div class=\"comment mb-5\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"col-3\">
\t\t\t\t\t\t<!-- Author of the comment -->
\t\t\t\t\t\t";
            // line 56
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 56), "html", null, true);
            echo "
\t\t\t\t\t\t<!-- Date of the comment -->
\t\t\t\t\t\t(<small>";
            // line 58
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 58), "d/m/Y à H:i"), "html", null, true);
            echo "</small>)
\t\t\t\t\t</div>
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"col\">
\t\t\t\t\t\t<!-- Content of the comment -->
\t\t\t\t\t\t";
            // line 63
            echo twig_get_attribute($this->env, $this->source, $context["comment"], "content", [], "any", false, false, false, 63);
            echo "
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        echo "\t\t<!-- If a user is connected, display the comment form -->
\t\t";
        // line 69
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 69, $this->source); })()), "user", [], "any", false, false, false, 69)) {
            // line 70
            echo "\t\t\t";
            echo             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 70, $this->source); })()), 'form_start');
            echo "
\t\t\t";
            // line 71
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 71, $this->source); })()), "author", [], "any", false, false, false, 71), 'row', ["attr" => ["placeholder" => "Votre nom"]]);
            echo "
\t\t\t";
            // line 72
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 72, $this->source); })()), "content", [], "any", false, false, false, 72), 'row', ["attr" => ["placeholder" => "Votre commentaire"]]);
            echo "
\t\t\t<button type=\"submit\" class=\"btn btn-success mb-5\">Envoyer</button>
\t\t\t";
            // line 74
            echo             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 74, $this->source); })()), 'form_end');
            echo "
\t\t\t<!-- Else display a connexion button -->
\t\t";
        } else {
            // line 77
            echo "\t\t\t<h2>Se connecter pour commenter</h2>
\t\t\t<a href=\"";
            // line 78
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_login");
            echo "\" class=\"btn btn-primary mb-5\">Connexion</a>
\t\t";
        }
        // line 80
        echo "\t</section>
\t<!-- / Comment section -->

";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "blog/show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 80,  220 => 78,  217 => 77,  211 => 74,  206 => 72,  202 => 71,  197 => 70,  195 => 69,  192 => 68,  181 => 63,  173 => 58,  168 => 56,  161 => 51,  157 => 50,  150 => 46,  141 => 39,  133 => 35,  131 => 34,  124 => 30,  119 => 27,  110 => 24,  107 => 23,  103 => 22,  98 => 20,  93 => 18,  87 => 15,  82 => 13,  74 => 8,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
\t<!-- Article page -->
\t<article
\t\tclass=\"my-4\">
\t\t<!-- Article title -->
\t\t<h2>{{ article.title }}</h2>
\t\t<div
\t\t\tclass=\"content\">
\t\t\t<!-- Article picture -->
\t\t\t<img
\t\t\tsrc=\"{{ vich_uploader_asset(article, 'imageFile') }}\" alt=\"\" width=\"50%\" height=\"50%\">
\t\t\t<!-- Article content -->
\t\t\t<p>{{ article.content | raw }}</p>
\t\t\t<!-- Article date -->
\t\t\t<div class=\"metadata\">Ecrit le
\t\t\t\t{{ article.createdAt | date('d/m/y') }}
\t\t\t\tà
\t\t\t\t{{ article.createdAt | date('H:i') }}
\t\t\t\tavec les libellés : 
\t\t\t\t{% for wording in article.wordings %}
\t\t\t\t\t
\t\t\t\t\t{{ wording.title }}

\t\t\t\t{% endfor %}
\t\t\t</div>
\t\t</div>
\t\t<!-- Redirection to articles -->
\t\t<a href=\"{{ path('blog') }}\">
\t\t\t<button type=\"button\" class=\"btn btn-outline-primary my-4\">Retour</button>
\t\t</a>
\t\t<!-- If a user is connected dislay the modify button -->
\t\t{% if app.user %}
\t\t\t<a href=\"{{ path('blog_edit', {'id' : article.id }) }}\">
\t\t\t\t<button type=\"button\" class=\"btn btn-outline-primary my-4\">Modifier</button>
\t\t\t</a>
\t\t{% endif %}
\t</article>
\t<!-- / Article page -->
\t<hr>
\t<!-- Comment section -->
\t<section
\t\tid=\"commentaires\">
\t\t<!-- Display the amount of comments -->
\t\t<h1 class=\"mb-5\">{{ article.comments | length }}
\t\t\tCommentaires :
\t\t</h1>
\t\t<!-- Display the comments -->
\t\t{% for comment in article.comments %}
\t\t\t<div class=\"comment mb-5\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"col-3\">
\t\t\t\t\t\t<!-- Author of the comment -->
\t\t\t\t\t\t{{ comment.author }}
\t\t\t\t\t\t<!-- Date of the comment -->
\t\t\t\t\t\t(<small>{{ comment.createdAt | date('d/m/Y à H:i')}}</small>)
\t\t\t\t\t</div>
\t\t\t\t\t<div
\t\t\t\t\t\tclass=\"col\">
\t\t\t\t\t\t<!-- Content of the comment -->
\t\t\t\t\t\t{{comment.content | raw}}
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t{% endfor %}
\t\t<!-- If a user is connected, display the comment form -->
\t\t{% if app.user %}
\t\t\t{{ form_start(commentForm) }}
\t\t\t{{ form_row(commentForm.author, {'attr': {'placeholder': \"Votre nom\"}}) }}
\t\t\t{{ form_row(commentForm.content, {'attr': {'placeholder': \"Votre commentaire\"}}) }}
\t\t\t<button type=\"submit\" class=\"btn btn-success mb-5\">Envoyer</button>
\t\t\t{{ form_end(commentForm) }}
\t\t\t<!-- Else display a connexion button -->
\t\t{% else %}
\t\t\t<h2>Se connecter pour commenter</h2>
\t\t\t<a href=\"{{ path('security_login') }}\" class=\"btn btn-primary mb-5\">Connexion</a>
\t\t{% endif %}
\t</section>
\t<!-- / Comment section -->

{% endblock %}
", "blog/show.html.twig", "/Applications/MAMP/htdocs/almalusa/templates/blog/show.html.twig");
    }
}
