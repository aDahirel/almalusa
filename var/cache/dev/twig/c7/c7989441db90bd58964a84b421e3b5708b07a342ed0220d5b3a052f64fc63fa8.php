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

/* blog/login.html.twig */
class __TwigTemplate_70c2e94abcbec04c3d9e8807919a80a340fc16983b9a2c5fc53176d974d86724 extends Template
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
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/login.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "blog/login.html.twig", 1);
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
        echo "\t<!-- Page title -->
\t<h1>Connexion</h1>

\t<!-- Connexion form -->
\t<form action=\"";
        // line 7
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_login");
        echo "\" method=\"post\">
\t\t<div class=\"form-group\">
\t\t\t<input placeholder=\"Adresse email\" required name=\"_username\" type=\"text\" class=\"form-control\">
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<input placeholder=\"Mot de passse\" required name=\"_password\" type=\"password\" class=\"form-control\">
\t\t</div>
\t\t<div class=\"buttons d-flex\">
\t\t\t<div class=\"form-group mr-2\">
\t\t\t\t<button type=\"submit\" class=\"btn btn-success\">Connexion</button>
\t\t\t</div>
\t\t\t<div class=\"form-group\">
\t\t\t\t<a href=\"";
        // line 19
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_registration");
        echo "\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-info\">Inscription</button>
\t\t\t\t</a>
\t\t\t</div>
\t\t</div>
\t</form>
\t<!-- / Connexion form -->
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "blog/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 19,  74 => 7,  68 => 3,  58 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"base.html.twig\" %}
{% block body %}
\t<!-- Page title -->
\t<h1>Connexion</h1>

\t<!-- Connexion form -->
\t<form action=\"{{ path('security_login') }}\" method=\"post\">
\t\t<div class=\"form-group\">
\t\t\t<input placeholder=\"Adresse email\" required name=\"_username\" type=\"text\" class=\"form-control\">
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<input placeholder=\"Mot de passse\" required name=\"_password\" type=\"password\" class=\"form-control\">
\t\t</div>
\t\t<div class=\"buttons d-flex\">
\t\t\t<div class=\"form-group mr-2\">
\t\t\t\t<button type=\"submit\" class=\"btn btn-success\">Connexion</button>
\t\t\t</div>
\t\t\t<div class=\"form-group\">
\t\t\t\t<a href=\"{{ path('security_registration') }}\">
\t\t\t\t\t<button type=\"button\" class=\"btn btn-info\">Inscription</button>
\t\t\t\t</a>
\t\t\t</div>
\t\t</div>
\t</form>
\t<!-- / Connexion form -->
{% endblock %}
", "blog/login.html.twig", "/Applications/MAMP/htdocs/almalusa/templates/blog/login.html.twig");
    }
}
