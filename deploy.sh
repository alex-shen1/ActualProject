cd Angular
ng build --prod
gcloud app deploy --quiet
cd ../PHP
gcloud app deploy --quiet