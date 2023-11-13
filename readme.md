# Framework - Symfony 5.4

The symfony framework is an MVC based web framework, based on the PHP programming language, that uses Composer as a package manager

> Prerequisities : **
> 

- To start a project, we need to use the following command :

<aside>
💡  ***`symfony new --version=5.4 guideMichelin`  // to Start a new Project***

</aside>

<aside>
💡 ***`symfony server:start / symfony server:stop`  // to Start/Stop our server***

</aside>

Our project is called guideMichelin, we’ll first start by creating a new php Symfony project using the command above, and launch the server in the local host [**`http://localhost:8000`**](http://localhost:8000) using the ***START*** command

In the ***config/accueil*** directory of our project, we’ll create a ***routes.yaml*** file, and define our ***“Accueil”*** route:

```yaml
guide_michelin_accueil:  
	path: /accueil 
	controller: App\Controller\AccueilController::afficher
```

and then start to define our ***Controller*** by creating our ***afficher()*** function

```php
<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class AccueilController{

    function afficher(){
        return new Response("Bonjour: Guide michelin..... trouvez un restaurant");
    }
}
?>
```

l’Ajout du bundle/packages using Composer using this command:

<aside>
💡 ***composer require --dev debug // activate the debug mode***

</aside>

using dependacy, this also add the ***symfony/twig-bundle*** that would allow us to to create and use reusable HTML templates, 

- we’ll create the ***Accueil*** template and the `templates/accueil.html.twig` file.

```html
<!DOCTYPE html>
<html>    
	<head>        
		<title>Accueil</title> 
	</head>
  <body>
	  <h1>Bonjour Michelin</h1> 
	    <p> Vous trouverez des restaurant ici </p>
  </body>
</html>
```

- we’ll modify the ***AccueilController*** for it to extend the ***AbstractController*** and remplace the ***response*** method with the ***render*** method, giving our templates path as a parameter.

```php
<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController{    
	function afficher() {       
	 return $this->render('/accueil/accueil.html.twig');    
	}
}
?>
```

To modify the ***routes*** for them to begin with `/guideMichelin`, we’d have to modify the `routes.yaml` file and add a ***prefix***

```yaml
guide_michelin:  
	resource: accueil/routes.yaml  
	prefix: /guideMichelin
```

***→ As a result, all routes will begin by*** `http://localhost:8000/guideMichelin/accueil`

### ***Adding the Menu page, template, and route***

Following the previous example we’ll define the Menu and route in the ***routes.yaml*** file

```yaml
guide_michelin_menu:  
	path: /menu 
	controller: App\Controller\MenuController::afficher
```

Creating the ***MenuController,*** we will add link that will redirect us from the ***Accueil Page*** to the ***Menu Page,*** and another one to return to the ***Accueil***

- Same thing as ***AccueilController*** that we created earlier, while choosing the path for our ***Menu t***wig template `templates\menu\menu.html.twig` which will have this link.

```html
<a href="{{ path('guide_michelin_accueil') }}">Retour</a>
```

- While the `templates\accueil\accueil.html.twig` has this link that redirects us to `http://localhost:8080/guideMichelin/menu`

```html
<a href="{{ path('guide_michelin_menu') }}">Lien vers Menu Michelin</a>
```

In order to have `/accueil` page show a ***String*** passed in parameters, we will have to modify the `/config/guide/accueil/routes.yaml` file adding ***{name}*** to the previous path

```yaml
guide_michelin_accueil:  
	path: /accueil/{name}
	controller: App\Controller\AccueilController::afficher
```

Modifiying the ***AccueilController*** to render the String (name) passed in parameters

```php
/**/
class AccueilController($name){
	function afficher($name) {
        return $this->render('/accueil/accueil.html.twig', array('name' => $name));
    }
}
/**/
```

Adding the variable ***name*** to the twig template in ***`templates/guide/accueil/accueil.html.twig`*** file

```html
<!-->
 <h1>Bonjour Monsieur {{ name }}</h1>
<!-->
```

→ Test `[http://localhost:8000/guideMichelin/accueil/pasha](http://localhost:8080/guideMichelin/accueil/pasha)` 
---
