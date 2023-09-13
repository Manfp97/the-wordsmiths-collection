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
    <img src="public/favicon.svg" alt="Logo" width="156" height="156">
    <h1 align="center">The Wordsmith's Collection</h1>
    <p align="center">A website featuring a curated selection of the most important literary works in history.</p>
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
        <a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/issues/new/choose">Report Issue</a> · <a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/issues/new/choose">Request Feature</a> · <a href="https://github.com/HenestrosaConH/the-wordsmiths-collection/discussions">Ask Question</a>
    </p>
</div>

## README Translations

- ![es](https://raw.githubusercontent.com/gosquared/flags/master/flags/flags/shiny/24/Spain.png) [Español](docs/README-es.md)

<!-- TABLE OF CONTENTS -->

## Table of Contents

- [About the Project](#about-the-project)
  - [Project Structure](#project-structure)
  - [Built With](#built-with)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites) 
  - [Steps](#steps)
- [Usage](#usage)
- [Roadmap](#roadmap)
- [License](#license)
- [Authors](#authors)
- [Acknowledgments](#acknowledgments)

<!-- ABOUT THE PROJECT -->

## About the Project

**The Wordsmith's Collection** is my final [DAW](https://github.com/HenestrosaConH/2-daw) project, which consists of a website with a subscription system that allows users to access a curated library of the most important literary works in history. They will be able to read the books on the site, as well as search and filter by category and author. Each book and author will have a description to get more insight into their bibliography and synopsis, respectively.

The site also has a user administrator role that can upload new content and modify existing content.

<!-- PROJECT STRUCTURE -->

### Project Structure

<details>
  <summary>ASCII folder structure</summary>

```
│	.editorconfig
│	.env.example
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
│   │   │       strings.xml
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
│       	.gitignore
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
│   │   	UserFactory.php
│   │
│   ├───migrations
│   │   	2014_10_12_000000_create_users_table.php
│   │		2014_10_12_100000_create_password_reset_tokens_table.php
│   │		2019_08_19_000000_create_failed_jobs_table.php
│   │		2019_12_14_000001_create_personal_access_tokens_table.php
│   │
│   └───seeders
│       	DatabaseSeeder.php
│
├───public
│       .htaccess
│       favicon.svg
│       index.php
│       robots.php
│
├───resources
│   ├───css
│   │   	app.css
│   │
│   ├───js
│   │   	app.css
│   │   	bootstrap.css
│   │
│   └───views
│       	welcome.blade.php
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
│   │   		.gitignore
│   │
│   ├───framework
│   │   │   .gitignore
│   │   │
│   │	├───cache
│   │	│	│	.gitignore
│   │	│	│
|   │   │   └───data
|   │   │			.gitignore
│   │   │
│   │	├───sessions
|   │   │		.gitignore
│   │   │
│   │	├───testing
|   │   │		.gitignore
│   │   │
│   │   └───views
│   │   		.gitignore
│   │
│   └───logs
│       	welcome.blade.php
│
└───tests
	│	CreatesApplication.php
	│	TestCase.php
    │
    ├───Feature
	│		ExampleTest.php
	│
	└───Unit
			ExampleTest.php
```
</details>

<!-- BUILT WITH -->

### Built With

- [Laravel](https://github.com/laravel/laravel): PHP framework.

<!-- GETTING STARTED -->

## Getting Started

### Prerequisites

Ensure you have PHP, Git, Composer, npm, and Laravel installed on your local machine. If not, you can download and install them from the official websites:
- [PHP](https://www.php.net/downloads.php)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)
- [npm](https://www.npmjs.com/package/download)
- [Laravel](https://laravel.com/docs/9.x/installation) (installed globally using Composer)

### Steps

1. Use git to clone the Laravel project repository to your local machine. Open your terminal or command prompt and run:
	```shell
	git clone https://github.com/HenestrosaConH/the-wordsmiths-collection.git
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
	Configure it if needed by setting the right configuration for the database.
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

To do

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- ROADMAP -->

## Roadmap

- [ ] To do

You can propose a new feature creating an [issue](https://github.com/HenestrosaConH/the-wordsmiths-collection/new/choose).

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- LICENSE -->

## License

Distributed under the MIT License. See [`LICENSE`](https://github.com/HenestrosaConH/the-wordsmiths-collection/blob/main/.github/LICENSE) for more information.

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- AUTHORS -->

## Authors

- HenestrosaConH <henestrosaconh@gmail.com> (José Carlos López Henestrosa)

<p align="right">(<a href="#top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->

## Acknowledgments

I have made use of the following resources to make this project:

- [Best-README-Template](https://github.com/othneildrew/Best-README-Template/)
- [Img Shields](https://shields.io)
- [How to create a Python package](https://mathspp.com/blog/how-to-create-a-python-package-in-2022#how-to-create-a-python-package)
- [Icon created by Midjourney](https://www.midjourney.com/app/)

<p align="right">(<a href="#top">back to top</a>)</p>

