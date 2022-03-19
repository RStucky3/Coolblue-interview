 # Coolblue interview assignment

Welcome to the Coolblue interview assignment. 
Before you appears a small codebase, whose simple purpose it is to retrieve shopping cart information from a database and display it to the browser. As you can undoubtedly see this codebase has various issues:

* Incorrect separation of concerns
* Various SOLID-principles are not (correctly) adhered to
* No test coverage
* Not using external dependencies like a DI container, template engine, etcetera
* Relies on an older version of PHP

It's generally just not a very nice codebase, and we'd like to see it improved.

## The assignment

Your job in this assignment is to take some time and improve this codebase. You can do this in any way you like, and you can take it as far as you'd like. Rewrite chunks, unit test it first, use composer components, change the MySQL schema completely, or even use a framework and migrate it to that.

There's only 1 sure thing that we'd like to see you change: Currently there's a hard dependency in MySQL in the repository. We would like the possibility in the future to swap out the data store easily. You don't have to write a new adapter yet, just make it possible for us to easily swap implementations.

What we're mostly looking for is to see is what you chose to tackle and how you went about it. We'd appreciate it if you can make regular git commits during you working on the project, and to zip the .git folder with your handed in assignment, so we get a feel for the way in which you've worked and how you went about changing the application.

The aim is to spend approximately 2 hours on this assignment. If you didn't get to something in that time you'd still like to have tackled, feel free to add a readme file like this to your project with the next steps you would have done, given more time.

## Running the application
To get you started easily the codebase comes with a docker-compose setup. Provided you have docker installed, start the app with `docker-compose up`, after which you can access the "application" via `http://localhost:8080`. Alternatively you can run your own basic PHP server. All dependencies like PHP version and required extensions are specified in the composer.json file.

## Good luck!
