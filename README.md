# RUN PROJECT ON DEVELOMENT

## BACK

- On php MyAdmin, create a new database : g5_db
- Go to /back
- Copy the .env.example to .env
- on .env file, update the database name
  DB_DATABASE=g5_db
- Launch composer install
- Launch php artisan migrate
- Create default admin => php artisan db:seed
- Launch php artisan serve

## FRONT

- Go to /front
- Launch npm install
- Run npm run serve to launch on developpment mode

# RUN PROJECT ON PRODUCTION

## First time :

    - Clone project

    - On php MyAdmin, create a  new database :  (name of database it's up to you)

    - Go to /back
    - Copy the .env.example to .env
    - on  .env file, update the database name
    	DB_DATABASE=(The database name that you create on php MyAdmin)

    - Launch  composer install
    - Launch  npm install
    - Launch php artisan migrate

    - Go to /front
    - Launch  npm install

## Other times :

    - git pull

    - Go to /front
    - Run npm run build
