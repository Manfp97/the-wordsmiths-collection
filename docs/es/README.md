<div id="top"></div>

<!-- PROJECT SHIELDS -->
<!--
*** I am using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->

<!-- PROJECT LOGO -->
<br />
<div align="center">
	<img src="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/public/favicon.svg" alt="Logo" width="156" height="156">
	<h1 align="center">The Wordsmith's Collection</h1>
	<p align="center">Sitio web con una selección de las obras literarias más importantes de la historia.</p>
	<p>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/stargazers">
			<img alt="GitHub Contributors" src="https://img.shields.io/github/stars/HenestrosaConH/the-wordsmiths-collection" />
		</a>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/graphs/contributors">
			<img alt="GitHub Contributors" src="https://img.shields.io/github/contributors/HenestrosaConH/the-wordsmiths-collection" />
		</a>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/issues">
			<img alt="Issues" src="https://img.shields.io/github/issues/HenestrosaConH/the-wordsmiths-collection" />
		</a>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/pulls">
			<img alt="GitHub pull requests" src="https://img.shields.io/github/issues-pr/HenestrosaConH/the-wordsmiths-collection" />
		</a>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/blob/main/LICENSE">
			<img alt="GitHub pull requests" src="https://img.shields.io/github/license/HenestrosaConH/the-wordsmiths-collection" />
		</a>
	</p>
	<p>
		<a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/issues/new/choose">Reportar Incidencia</a> · <a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/issues/new/choose">Proponer Funcionalidad</a> · <a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/discussions">¿Duda?</a>
	</p>
	<p>
		<a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/README.md/">🇬🇧 English</a> | 🇪🇸 Español
	</p>
</div>

<!-- TABLA DE CONTENIDOS -->

## Tabla de Contenidos

- [Sobre el Proyecto](#sobre-el-proyecto)
  - [Modelo Entidad Relación](#modelo-entidad-relación)
  - [Modelo Relacional](#modelo-relacional)
  - [Casos de Uso](#casos-de-uso)
  - [Hecho Con](#hecho-con)
- [Primeros Pasos](#primeros-pasos)
  - [Requisitos Previos](#requisitos-previos)
  - [Pasos](#pasos)
- [Uso](#uso)
- [Hoja de Ruta](#hoja-de-ruta)
- [Licencia](#licencia)
- [Autores](#autores)

<!-- SOBRE EL PROYECTO -->

## Sobre el Proyecto

![Hero](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/main-mockup.jpg)

<details>
	<summary align="center">Más capturas de pantalla</summary>

![Author detail](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/author-detail.png)
![Book detail](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/book-detail.png)
![Book read](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/book-read.png)
![Genre detail](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/genre-detail.png)
![Main](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/main.png)
![Modal add content](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/modal-add-content.png)
![Profile edit](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/profile-edit.png)
![Users index](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/screenshots/users-index.png)
</details>

**The Wordsmith's Collection** consiste en un sitio web con un modelo de negocio por suscripción (SaaS) que permite a los usuarios acceder a una biblioteca selecta con las obras literarias más importantes de la historia. Podrán leer los libros en el sitio, así como buscar y filtrar por género y autor. Cada libro y autor tendrán una descripción para conocer mejor su bibliografía y sinopsis, respectivamente.

Para acceder al servicio, los usuarios deben crear una cuenta e introducir una tarjeta de crédito para efectuar el pago. Hay que tener en cuenta que, en realidad, no se realiza ningún pago, ya que solo se verifica que la tarjeta de crédito sea válida. Para utilizar realmente esta función, se debería implementar una pasarela de pago como Redsys o Stripe.

Hay dos modalidades de suscripción:

- Básica: El usuario no podrá acceder a libros con la etiqueta "PREMIUM".
- Premium: El usuario podrá acceder a toda la biblioteca disponible.

Y tres tipos de usuarios:

- **Visitante**: Un usuario que visita la página. No puede leer libros, pero puede ver el catálogo de libros disponible y las reviews.
- **Suscriptor**: Usuario que paga la cuota mensual/anual para leer libros. Puede ser **Básico** o **Premium**.
- **Administrador**: Usuario ya creado que podrá, además de realizar las mismas operaciones que un cliente, añadir, editar y eliminar libros a su antojo.

<!-- Hecho Con -->

### Hecho Con

- [Laravel](https://github.com/laravel/laravel): PHP framework.
- [TailwindCSS](https://tailwindcss.com/docs/guides/laravel): CSS framework.
- [Vue.js 3](https://vuejs.org/): JavaScript framework.
- [Inertia.js](https://inertiajs.com/): Permite crear aplicaciones de una sola página totalmente renderizadas del lado del cliente sin la complejidad de las SPA modernas.
- [Wikipedia API](https://en.wikipedia.org/api/rest_v1/#): Para obtener las descripciones de los autores y las sinopsis de los libros.

<!-- MODELO ENTIDAD RELACIÓN -->

### Modelo Entidad Relación

<div align="center">
	<picture>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/light/entity-relationship-diagram.svg"
			media="(prefers-color-scheme: light)"
		/>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/dark/entity-relationship-diagram.svg"
			media="(prefers-color-scheme: dark)"
		/>
		<img 
			src="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/light/entity-relationship-diagram.svg"
			alt="Entity Relationship Model"
		>
	</picture>
</div>
<!-- MODELO RELACIONAL -->

### Modelo Relacional

<div align="center">
	<picture>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/common/light/relational-model.svg"
			media="(prefers-color-scheme: light)"
		/>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/common/dark/relational-model.svg"
			media="(prefers-color-scheme: dark)"
		/>
		<img 
			src="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/common/light/relational-model.svg"
			alt="Relational Model"
		>
	</picture>
</div>

<!-- CASOS DE USO -->

### Casos de Uso

<div align="center">
	<picture>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/light/use-cases.svg"
			media="(prefers-color-scheme: light)"
		/>
		<source 
			srcset="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/dark/use-cases.svg"
			media="(prefers-color-scheme: dark)"
		/>
		<img 
			src="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/light/use-cases.svg"
			alt="Use Cases"
		>
	</picture>
</div>

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- PRIMEROS PASOS -->

## Primeros Pasos

### Requisitos Previos

Asegúrate de que tienes PHP, Git, Composer, npm y Laravel instalados en tu máquina local. Si no es así, puedes descargarlos e instalarlos desde los sitios web oficiales:

- [PHP](https://www.php.net/downloads.php)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)
- [npm](https://www.npmjs.com/package/download)
- [Laravel](https://laravel.com/docs/9.x/installation) (instalar globalmente usando Composer)

### Pasos

1. Utiliza `git` para clonar el repositorio del proyecto Laravel en tu máquina local. Abre la terminal o símbolo del sistema y ejecuta:
   ```shell
   git clone https://github.com/HenestrosaConH/the-wordsmiths-collection.git
   ```
2. Navega al directorio del proyecto utilizando el comando `cd`. Por ejemplo:
   ```shell
   cd /path/to/the-wordsmiths-collection`
   ```
3. Instala las dependencias de Composer ejecutando el siguiente comando:
   ```shell
   composer install
   ```
4. Instala las dependencias de npm ejecutando el siguiente comando:
   ```shell
   npm install
   ```
5. Crea un archivo `.env`, ya que Laravel utiliza variables de entorno almacenadas en un archivo `.env` para la configuración. Duplica el archivo `.env.example` proporcionado con el proyecto y renómbralo a `.env`:
   ```shell
   cp .env.example .env
   ```
   Si es necesario, puedes configurarlo estableciendo la configuración correcta para la base de datos.<br>
   <br>
6. Genera una clave de aplicación, necesaria para la seguridad, utilizando Artisan:
   ```shell
   php artisan key:generate
   ```
7. Ejecuta migraciones de base de datos para establecer las tablas de la base de datos:
   ```shell
   php artisan migrate
   ```
8. Inicia el servidor de desarrollo ejecutando este comando:
   ```shell
   php artisan serve
   ```

Puedes habilitar hot refresh con Vite ejecutando el comando `npm run dev`. Ten en cuenta que necesitarás abrir la URL proporcionada por Artisan para disfrutar de esta característica, no la proporcionada por Vite.

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- USO -->

## Uso

[Credit card generator](https://www.creditcardvalidator.org/generator)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- AUTORES -->

## Autores

- José Carlos López Henestrosa ([HenestrosaDev](https://github.com/HenestrosaDev))

<!-- LICENCIA -->

## Licencia

Distribuido bajo la licencia MIT. Revisa [`LICENSE`](https://github.com/HenestrosaConH/the-wordsmiths-collection/blob/main/.github/LICENSE) para más información.

<p align="right">(<a href="#top">back to top</a>)</p>
