# The app is a PHP Laravel app with React frontend, made as a test assignment for Opus Online.

---

## Software requirements to run:
PHP ^7.2.5
Composer installed

## To run the app:
1. download git repo
1. run composer install
1. make a copy of .env.example and name it .env
1. to generate app key, run php artisan key:generate
1. change values in .env to make them match your setup
1. to generate database, run php artisan migrate
1. to start the app, run php artisan serve


## Parts of the requirements I was not able to do:
- Authentication and requiring it with react
- Unit tests
- API routes are vulnerable to csrf (was not explicitly mentioned in the requirements, but disabled it, which is not the safest or the intended use)


## Timeconsumption
- Total: ~13h
    - Laravel + DB setup: ~1.5h
    - Initial saving to DB and setting up anagram comparison: ~1.75h
    - Saving to DB (now over over file upload) finished: ~1.75h
    - Applying and making app work with react front end: ~5h
    - Trying to figure out auth with react (unsucessful in the end): ~1.5h
    - Trying to figure out unit testing (unsucessful in the end): ~1.5h