# EECSPlus
Prototype project for group 26. Software engineering project.

node_Modules is added to gitignore - Whenever you start working on the live server for this project, do npm install to update all packages

 Install the dependencies :**

```sh
npm install
```

## Development Workflow


**4. Start a live-reload development server :**

```sh
npm run dev
```

> This is a full web server. Any time you make changes within the `src` directory, it will rebuild and refresh your browser.


**5. Generate a production build in `./build` :**

```sh
npm run build
```

**6. Start local production server with [serve](https://github.com/zeit/serve):**

```sh
npm start
```

> This simply serves up the contents of `./build`. If you use this, the localhost port your server is running on will refresh, and you'll also need to restart it to see any changes you've made to the code in `src`.
