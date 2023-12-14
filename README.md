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
    <p align="center">A website featuring a curated selection of the most important literary works in history.</p>
    <p>
      <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/stargazers">
        <img alt="GitHub Contributors" src="https://img.shields.io/github/stars/HenestrosaDev/the-wordsmiths-collection" />
      </a>
      <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/graphs/contributors">
        <img alt="GitHub Contributors" src="https://img.shields.io/github/contributors/HenestrosaDev/the-wordsmiths-collection" />
      </a>
      <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/issues">
        <img alt="Issues" src="https://img.shields.io/github/issues/HenestrosaDev/the-wordsmiths-collection" />
      </a>
      <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/pulls">
        <img alt="GitHub pull requests" src="https://img.shields.io/github/issues-pr/HenestrosaDev/the-wordsmiths-collection" />
      </a>
      <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/LICENSE">
        <img alt="GitHub pull requests" src="https://img.shields.io/github/license/HenestrosaDev/the-wordsmiths-collection" />
      </a>
    </p>
	<p>
    <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/issues/new/choose">Report Issue</a> · <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/issues/new/choose">Request Feature</a> · <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/discussions">Ask Question</a>
  </p>
  <p>
    English | <a href="https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/docs/es/README.md/">Español</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->

## Table of Contents

- [About the Project](#about-the-project)
  - [Project Structure](#project-structure)
  - [Entity Relationship Model](#entity-relationship-model)
  - [Relational Model](#relational-model)
  - [Use Cases](#use-cases)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites) 
  - [Steps](#steps)
- [Usage](#usage)
- [Roadmap](#roadmap)
- [Authors](#authors)
- [License](#license)

<!-- ABOUT THE PROJECT -->

## About the Project

**The Wordsmith's Collection** consists of a website with a subscription model (SaaS) that allows users to access a curated library of the most important literary works in history. They will be able to read the books on the site, as well as search and filter by category and author. Each book and author will have a description to get more insight into their bibliography and synopsis, respectively.

In order to access the service, users must register and enter a credit card for payment. Note that no payments are actually made, as the site only verifies that the credit card is valid. To actually use this feature, you should implement a payment gateway provider such as Redsys or Stripe.

There are two types of subscription:
- **Basic**: The subscriber can read all books except those marked **PREMIUM**.
- **Premium**: The subscriber can read the entire available library, including **PREMIUM** books.

The website has three types of users:
- **Visitor**: A user who visits the site. Cannot read books, but can see the available library and reviews.
- **Subscriber**: Registered user who pays a monthly/annual fee to read books. Can be **Basic** or **Premium**.
- **Administrator**: An existing user who, in addition to performing the same operations as a subscriber, can add, edit, and delete books at will.

<!-- PROJECT STRUCTURE -->

### Project Structure

<details>
  <summary>ASCII folder structure</summary>

```
│   .editorconfig
│   .env.example
│   .gitattributes
│   .gitignore
│   artisan
│   composer.json
│   composer.lock
│   LICENSE
│   package-lock.json
│   package.json
│   phpunit.xml
│   README.md
│   tailwind.config.js
│   vite.config.js
│
├───app
│   ├───Console
│   │       Kernel.php
│   │
│   ├───Exceptions
│   │       Handler.php
│   │
│   ├───Http
│   │   │   Kernel.php
│   │   │
│   │   ├───Controllers
│   │   │       Controller.php
│   │   │
│   │   └───Middleware
│   │           Authenticate.php
│   │           EncryptCookies.php
│   │           PreventRequestsDuringMaintenance.php
│   │           RedirectlfAuthenticated.php
│   │           TrimStrings.php
│   │           TrustHosts.php
│   │           TrustProxies.php
│   │           ValidateSignature.php
│   │           VerifyCsrfToken.php
│   │
│   ├───Models
│   │       User.php
│   │
│   └───Providers
│           AppServiceProvider.php
│           AuthServiceProvider.php
│           BroadcastServiceProvider.php
│           EventServiceProvider.php
│           RouteServiceProvider.php
│
├───bootstrap
│   │   app.php
│   │   
│   └───cache
│           .gitignore
│
├───config
│       app.php
│       auth.php
│       broadcasting.php
│       cache.php
│       cors.php
│       database.php
│       filesystems.php
│       hashing.php
│       logging.php
│       mail.php
│       queue.php
│       sanctum.php
│       services.php
│       sessions.php
│       view.php
│   
├───databases
│   │   .gitignore
│   │   
│   ├───factories
│   │       UserFactory.php
│   │
│   ├───migrations
│   │       2014_10_12_000000_create_users_table.php
│   │       2014_10_12_100000_create_password_reset_tokens_table.php
│   │       2019_08_19_000000_create_failed_jobs_table.php
│   │       2019_12_14_000001_create_personal_access_tokens_table.php
│   │
│   └───seeders
│           DatabaseSeeder.php
│
├───public
│       .htaccess
│       favicon.svg
│       index.php
│       robots.php
│
├───resources
│   ├───css
│   │       app.css
│   │
│   ├───js
│   │       app.css
│   │       bootstrap.css
│   │
│   └───views
│           welcome.blade.php
│
├───routes
│       api.php
│       channels.php
│       console.php
│       web.php
│
├───storage
│   ├───app
│   │   │   .gitignore
│   │   │
│   │   └───public
│   │           .gitignore
│   │
│   ├───framework
│   │   │   .gitignore
│   │   │
│   │   ├───cache
│   │   │   │   .gitignore
│   │   │   │
|   │   │   └───data
|   │   │           .gitignore
│   │   │
│   │   ├───sessions
|   │   │       .gitignore
│   │   │
│   │   ├───testing
|   │   │       .gitignore
│   │   │
│   │   └───views
│   │           .gitignore
│   │
│   └───logs
│           welcome.blade.php
│
└───tests
    │   CreatesApplication.php
    │   TestCase.php
    │
    ├───Feature
    │       ExampleTest.php
    │
    └───Unit
            ExampleTest.php
```
</details>

<!-- BUILT WITH -->

### Built With

- [Laravel](https://github.com/laravel/laravel): PHP framework.
- [TailwindCSS](https://tailwindcss.com/docs/guides/laravel): CSS framework.
- [Vue.js 3](https://vuejs.org/): JavaScript framework.
- [Inertia.js](https://inertiajs.com/): Enables the creation of fully client-side rendered, single-page applications without the complexity of modern SPAs.
- [Wikipedia API](https://en.wikipedia.org/api/rest_v1/#): Used to retrieve descriptions of authors and books.

<!-- ENTITY RELATIONSHIP MODEL -->

### Entity Relationship Model

<picture>
	<source 
		srcset="docs/en/dark/entity-relationship-diagram.png"
		media="(prefers-color-scheme: light)"
	/>
	<source 
		srcset="docs/en/light/entity-relationship-diagram.png"
		media="(prefers-color-scheme: dark)"
	/>
	<img 
		src="docs/en/dark/entity-relationship-diagram.png"
		alt="Entity Relationship Model"
	>
</picture>

<!-- RELATIONAL MODEL -->

### Relational Model

<picture>
	<source 
		srcset="docs/common/dark/relational-model.png"
		media="(prefers-color-scheme: light)"
	/>
	<source 
		srcset="docs/common/light/relational-model.png"
		media="(prefers-color-scheme: dark)"
	/>
	<img 
		src="docs/common/light/relational-model.png"
		alt="Relational Model"
	>
</picture>

<!-- USE CASES -->

### Use Cases

<picture>
	<source 
		srcset="docs/en/dark/use-cases.png"
		media="(prefers-color-scheme: light)"
	/>
	<source 
		srcset="docs/en/light/use-cases.png"
		media="(prefers-color-scheme: dark)"
	/>
	<img 
		src="docs/en/dark/use-cases.png"
		alt="Use Cases"
	>
</picture>

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- GETTING STARTED -->

## Getting Started

### Prerequisites

Ensure you have PHP, Git, Composer, npm, and Laravel installed on your local machine. If not, you can download and install them from the official websites:
- [PHP](https://www.php.net/downloads.php)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)
- [npm](https://www.npmjs.com/package/download)
- [Laravel](https://laravel.com/docs/9.x/installation) (install globally using Composer)

### Steps

1. Use `git` to clone the Laravel project repository to your local machine. Open your terminal or command prompt and run:
	```shell
	git clone https://github.com/HenestrosaDev/the-wordsmiths-collection.git
	```
2. Navigate to the project directory using the `cd` command. For example: 
	```shell
	cd /path/to/the-wordsmiths-collection`
	```
3. Install Composer dependencies running the following command:
	```shell
	composer install
	```
3. Install npm dependencies running the following command:
	```shell
	npm install
	```
4. Create a `.env` file, as Laravel uses environment variables stored in a `.env` file for configuration. Duplicate the `.env.example` file provided with the project and rename it to `.env`:
	```shell
	cp .env.example .env
	```
	If necessary, you can configure it by setting the correct configuration for the database.<br>
	<br>
5. Generate an application key, required for security. Generate it using Artisan:
	```shell
	php artisan key:generate
	```
6. Run database migrations to set up the database tables:
	```shell
	php artisan migrate
	```
7. Start the development server by running this command:
	```shell
	php artisan serve
	```

You can enable hot refresh with Vite by running the command `npm run dev`. Note that you'll need to open the URL provided by Artisan to enjoy this feature, not the one provided by Vite.

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- USAGE -->

## Usage

[Credit card generator](https://www.creditcardvalidator.org/generator)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

- [ ] To do

You can propose a new feature creating an [issue](https://github.com/HenestrosaDev/the-wordsmiths-collection/new/choose).

<!-- AUTHORS -->

## Authors

- José Carlos López Henestrosa ([HenestrosaDev](https://github.com/HenestrosaDev))

<!-- LICENSE -->

## License

Distributed under the MIT License. See [`LICENSE`](https://github.com/HenestrosaDev/the-wordsmiths-collection/blob/main/.github/LICENSE) for more information.

<p align="right">(<a href="#top">back to top</a>)</p>
