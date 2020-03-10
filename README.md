# Genesis Boilerplate

**Note:** This is currently under heavy development. Please checkout the [master](https://github.com/webdevsuperfast/genesis-boilerplate/tree/master) branch to use the latest stable version.

## Introduction

Genesis Boilerplate is a child theme for the Genesis Framework built on top of [Tailwind CSS](https://tailwindcss.com).

## Installation Instructions

1. Upload the `Genesis Boilerplate` theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the `Genesis Boilerplate` theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Building from Source

1. Install [Git](https://git-scm.com/).
2. Clone the repository to your local machine.
3. Install [Node](https://nodejs.org/en/).
4. Install [Yarn](https://yarnpkg.org/).
5. Install [Gulp](https://gulpjs.com/) globally.
6. Run `yarn install` to install dependencies through terminal/CLI program.
6. Replace proxy url in line `81` of `gulpfile.js` to your local development URL(e.g. http://bootstrap.test).
7. Run `gulp` through your favorite CLI program.

**Note:** I suggest using package manager to install Git, Node and Yarn. You can use [Homebrew](httsp://brew.sh) if you're on a Mac or Linux/WSL, [Scoop](https://scoop.sh) or [Chocolatey](https://chocolatey.org/) if you're on Windows.

## Todos

- [ ] Integrate Genesis Theme Setup API
- [ ] Integrate Genesis Configuration API
- [ ] Integrate AMP Support
- [ ] Gutenberg Support
- [ ] Code cleanup and bug fixes

## Credits

* [Genesis Framework](http://my.studiopress.com/themes/genesis/)
* [Tailwind CSS](https://tailwindcss.com)
* [Gulp](http://gulpjs.com/)