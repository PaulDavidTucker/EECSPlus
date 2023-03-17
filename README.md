# EECSPlus
Prototype project for group 26. Software engineering project.

node_Modules is added to gitignore - Whenever you start working on the live server for this project, do npm install to update all packages

NPM is used as a package mangager to run a live development server. All changes made are live.

**1. Clone into repository using URL**

```sh
https://github.com/PaulDavidTucker/EECSPlus.git
```

**2. Install the dependencies :**

```sh
npm install
```

## Development Workflow


**3. Start a live-reload development server :**

```sh
npm run dev
```

> This is a full web server. Any time you make changes within the `src` directory, it will rebuild and refresh your browser.


**4. Start local production server with [server](https://github.com/tapio/live-server):**

```sh
npm start
```

> This simply runs the contents of node_modules. If you use this, the localhost port your server is running on will refresh, and you'll also need to restart it to see any changes you've made to the code in `src`.

Running on port 8000 by default, but any number lower than 1024 requires admin privs on windows, unsure about linux installs
